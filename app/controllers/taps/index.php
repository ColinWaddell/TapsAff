<?php


function build_query($location){
  return str_replace('LOCATION', urlencode($location), $GLOBALS['json_url']);
}

function get_weather_description($weather_code){
  if($weather_code >= 0 &&
      $weather_code < sizeof($GLOBALS['weather_description'])){
    return $GLOBALS['weather_description'][$weather_code];
  }
  else{
    return '';
  }
}

function get_taps_status($temp_f, $weather_code){
  $message = '';
  $status = '';

  if (in_array($weather_code, $GLOBALS['terrible_weather'])){
    $status = 'oan';
  }
  else if ($temp_f > $GLOBALS['taps_temp']){
    $status = 'aff';
  }
  else if ($temp_f > $GLOBALS['taps_temp'] - 5){
    $status = 'oan';
    $message = '...but only by a bawhair!';
  }
  else{
    $status = 'oan';
  }

  return array(
      'status'  => $status,
      'message' => $message
  );
}

function build_forecast($forecast){
  $f = [];
  if(is_array($forecast)){
    foreach ($forecast as $daycast){
      $code = intval($daycast->code);
      $weather_description = get_weather_description($code);
      $datetime = date("Y-m-d",strtotime($daycast->date));
      $temp_high_f = intval($daycast->high);
      $temp_low_f = intval($daycast->low);
      $temp_high_c = f_to_c($temp_high_f);
      $temp_low_c = f_to_c($temp_low_f);
      $taps_status = get_taps_status($temp_high_f, $code);

      array_push ($f, array(
        'code'        => $code,
        'temp_high_f' => $temp_high_f,
        'temp_high_c' => $temp_high_c,
        'temp_low_f'  => $temp_low_f,
        'temp_low_c'  => $temp_low_c,
        'taps'        => $taps_status['status'],
        'message'     => $taps_status['message'],
        'description' => $weather_description,
        'datetime'    => $datetime
      ));
    }
  }

  return $f;
}

function f_to_c($temp_f){
  return round(($temp_f-32) * (5/9));
}

function retrieve_taps_status($location){

  $current_datetime = new DateTime();
  $current_datetime->setTimezone(new DateTimeZone('Europe/London'));
  $json_web = getJson_cache(build_query($location));

  $location = urldecode($location);
  if (isset( $json_web->query ) ){

    if ($json_web->query->count == 0)
    {
      // Is this a failed api request? If so update location and return error
      // otherwise attempt to load the last loaded location or default location
      // via stashed cookie.
      if(strpos($location,'?api') !== false){
        $location = str_replace('?api&location=', '', $location);
        $place_error = $location;
      }
      else{
        $place_error = 'Location \''.$location.'\' unknown.';
        $location = isset($_SESSION['location']) ? $_SESSION['location'] : $GLOBALS['default_location'];
        $json_web = json_decode( @file_get_contents( build_query($location) ));
      }
    }
  }

  // Have to test json file was found ok
  if (isset( $json_web->query) && !is_null($json_web->query->results))
  {
    $temp_f = 0;
    $temp_c = 0;

    if ( is_array($json_web->query->results->channel) )
      $data = $json_web->query->results->channel[0];
    else
      $data = $json_web->query->results->channel;

    if (isset( $data->wind->chill ))
    {
      $temp_f = intval($data->wind->chill);
      $temp_c = f_to_c($temp_f);
    }

    // Generally the value of $location returned here is formatted nicer.
    $location = $data->location->city;
    $weather_code = intval($data->item->condition->code);
    $weather_description = get_weather_description($weather_code);

    // Is it daytime
    $daytime =  time() < strtotime($data->astronomy->sunset) &&
                time() > strtotime($data->astronomy->sunrise);

    // Forecast
    $forecast = [];
    if (isset($data->item->forecast))
    {
      $forecast = build_forecast($data->item->forecast);
    }

    // The money-shot
    $taps_status = get_taps_status($temp_f, $weather_code);

    $json_local = json_encode (
                    array (
                      'temp_f'      => $temp_f,
                      'temp_c'      => $temp_c,
                      'taps'        => $taps_status['status'],
                      'message'     => $taps_status['message'],
                      'description' => $weather_description,
                      'datetime'    => $current_datetime->format('Y-m-d H:i:s'),
                      'location'    => $location,
                      'daytime'     => $daytime,
                      'place_error' => (isset($place_error) ? $place_error : ''),
                      'forecast'    => $forecast
                    ));

    // Need to return as an object rather than an array.
    // Doing for would be quicker, but this is neater.
    return json_decode( $json_local );
  } else return json_decode (
                  json_encode (
                    array (
                      'temp_f'      => 0,
                      'temp_c'      => 0,
                      'taps'        => 'error',
                      'message'     => '',
                      'description' => '',
                      'datetime'    => $current_datetime->format('Y-m-d H:i:s'),
                      'location'    => $GLOBALS['default_location'],
                      'place_error' => (isset($place_error)
                                        ? $place_error : 'Can\'t find location'),
                      'forecast'    => []
                    ))); // error - couldn't query internet
}


function _index($location='') {
  if (strpos($location,'?location=') !== false)
  {
    $data['location'] = str_replace('?location=', '', $location);
    View::do_dump(VIEW_PATH.'taps-redirect.php',$data);
  }
  else
  {
    if (isset($_SESSION['location']) && ($location=='') )
      $location = $_SESSION['location'];
    elseif ($location=='')
      $location = $GLOBALS['default_location'];

    $location = str_replace(" ","+",$location);
    $location = ucwords($location);

    $data['status']=retrieve_taps_status($location);
    $_SESSION['location'] = $data['status']->location;
    $data['location'] = $data['status']->location;

    $data['body'][]=View::do_fetch(VIEW_PATH.'taps/index.php',$data);
    $data['facebook'][]=View::do_fetch(VIEW_PATH.'facebook/index.php');
    $data['search'][]=View::do_fetch(VIEW_PATH.'search/index.php',$data);
    $data['moreinfo'][]=View::do_fetch(VIEW_PATH.'moreinfo/index.php', $data);
    $data['socialmedia'][]=View::do_fetch(VIEW_PATH.'socialmedia/index.php');
    if (strpos($location,'?api') !== false){
      View::do_dump(VIEW_PATH.'taps-api.php',$data);
    }
    else{
      View::do_dump(VIEW_PATH.'taps-layout.php',$data);
    }
  }

}
