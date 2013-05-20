<?php

function update_json() {
  
  $current_datetime = new DateTime();
  $json_web = json_decode( @file_get_contents( $GLOBALS['json_url'] ));

  // Have to test local json file was found ok
  if (isset( $json_web->query ))
  {
    $temp_f = 0;
    $temp_c = 0;
    if (isset( $json_web->query->results->channel->wind->chill ))
    {
      $temp_f = intval($json_web->query->results->channel->wind->chill);
      $temp_c = round(($temp_f-32) * (5/9));
    }
    
    $status = ($temp_f > $GLOBALS['taps_temp'] ) ? 'aff' : 'oan';

    $json_local = json_encode (
                    array (
                      'temp_f'   => $temp_f,
                      'temp_c'   => $temp_c,
                      'taps'     => $status,
                      'datetime' => $current_datetime->format('Y-m-d H:i:s'),
                      'lifespan' => $GLOBALS['json_lifespan']
                    ));

    @file_put_contents( $GLOBALS['json_local'], $json_local );

    // Need to return as an object rather than an array.
    // Doing foreach would be quicker, but this is neater.
    return json_decode( $json_local );
  } else return -1; // error - couldn't query internet

}

function retrieve_taps_status() {

  $json_local = json_decode( @file_get_contents( $GLOBALS['json_local'] )); 

  if (isset( $json_local ))
  {
    $local_datetime = new DateTime($json_local->datetime);
    $local_datetime->modify($GLOBALS['json_lifespan']); // This is the time the local copy is valid until
    $current_datetime = new DateTime();
    
    if ( $current_datetime < $local_datetime )
         $json_ret = $json_local; // local copy is valid
    else $json_ret = update_json(); // local copy needs updated


  } else $json_ret = update_json(); // local copy needs updated

  // if json_ret is not an Object then somethings gone wrong
  if (is_int($json_ret))
  {
    if ( isset( $json_local ) )
      return $json_ret = $json_local; // if possible return local copy, even if outdated
    else $json_ret = json_encode ( array ( 'taps' => 'error' )); // otherwise return error
  }

  return $json_ret;
}

function _index() {
  $data['status']=retrieve_taps_status();
  $data['body'][]=View::do_fetch(VIEW_PATH.'taps/index.php',$data);
  $data['facebook'][]=View::do_fetch(VIEW_PATH.'facebook/index.php');
  $data['moreinfo'][]=View::do_fetch(VIEW_PATH.'facebook/moreinfo.php');
  View::do_dump(VIEW_PATH.'taps-layout.php',$data);	  
}

