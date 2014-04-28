<?php

function build_query($location){
  return str_replace('LOCATION', urlencode($location), $GLOBALS['json_url']);
}

function retrieve_taps_status($location){
  
  $current_datetime = new DateTime();
  $current_datetime->setTimezone(new DateTimeZone('Europe/London'));
  $json_web = json_decode( @file_get_contents( build_query($location) ));

  
  $location = urldecode($location);

  if (isset( $json_web->query ) ){
    if ($json_web->query->count == 0)
    {
      $place_error = 'Location \''.$location.'\' unknown.';
      $location = isset($_SESSION['location']) ? $_SESSION['location'] : $GLOBALS['default_location']; 
      $json_web = json_decode( @file_get_contents( build_query($location) ));
    }
  }

  // Have to test json file was found ok
  if (isset( $json_web->query ))
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
      $temp_c = round(($temp_f-32) * (5/9));
    }
    
    $status = '';
    $message = '';

$temp_f = $GLOBALS['taps_temp']  -3 ;

    if ($temp_f > $GLOBALS['taps_temp']){
      $status = 'aff';
    }
    else if ($temp_f > $GLOBALS['taps_temp'] - 5){
      $status = 'oan';
      $message = "...but only by a bawhair!";
    }
    else{
      $status = 'oan';
    }

    $json_local = json_encode (
                    array (
                      'temp_f'   => $temp_f,
                      'temp_c'   => $temp_c,
                      'taps'     => $status,
                      'message'  => $message,
                      'datetime' => $current_datetime->format('Y-m-d H:i:s'),
                      'lifespan' => $GLOBALS['json_lifespan'],
                      'location' => $location,
                      'place_error' => (isset($place_error) ? $place_error : '')
                    ));

    // Need to return as an object rather than an array.
    // Doing foreach would be quicker, but this is neater.
    return json_decode( $json_local );
  } else return json_decode (
                  json_encode ( 
                    array ( 
                      'temp_f'   => 0,
                      'temp_c'   => 0,
                      'taps' => 'error', 
                      'message'  => '',
                      'datetime' => $current_datetime->format('Y-m-d H:i:s'),
                      'lifespan' => $GLOBALS['json_lifespan'],
                      'location' => $GLOBALS['default_location'],
                      'place_error' => 'Can\'t find location'
                    ))); // error - couldn't query internet

}


function _index($location='') {

  if (strpos($location,'?location=') !== false)
  {
    $data['location'] = str_replace('?location=', '', $location);;
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

    $data['location'] = $location;
    $data['status']=retrieve_taps_status($location);
    $_SESSION['location'] = $data['status']->location;

    $data['body'][]=View::do_fetch(VIEW_PATH.'taps/index.php',$data);
    $data['facebook'][]=View::do_fetch(VIEW_PATH.'facebook/index.php');
    $data['search'][]=View::do_fetch(VIEW_PATH.'search/index.php',$data);
    $data['moreinfo'][]=View::do_fetch(VIEW_PATH.'moreinfo/index.php', $data);
    $data['socialmedia'][]=View::do_fetch(VIEW_PATH.'socialmedia/index.php');
    View::do_dump(VIEW_PATH.'taps-layout.php',$data);	  
  }

}

