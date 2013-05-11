<?php

function retrieve_taps_status() {

  $json_local = json_decode( file_get_contents( $GLOBALS['json_local'] )); 
  $local_datetime = new DateTime($json_local->datetime);
  $local_datetime->modify('+1 hour'); // This is the time the local copy is valid until
  $current_datetime = new DateTime();
  
  if ( $current_datetime < $local_datetime )
  {
    //json time is valid
    return $json_local;

  } else {
    //need to do new pull from web
    $json_web = json_decode( file_get_contents( $GLOBALS['json_url'] ));
    
    $temp_f = 0;
    $temp_c = 0;
    if (isset( $json_web->query->results->channel->wind->chill ))
    {
      $temp_f = intval($json_web->query->results->channel->wind->chill);
      $temp_c = round(($temp_f-32) * (5/9));
    }
    
    $status = ($temp_f > $GLOBALS['taps_temp'] ) ? 'aff' : 'oan';

    $json_local = array (
          'temp_f'   => $temp_f,
          'temp_c'   => $temp_c,
          'taps'     => $status,
          'datetime' => $current_datetime->format('Y-m-d H:i:s')
         );

    file_put_contents( $GLOBALS['json_local'],
                       json_encode( $json_local ));

    return $json_local;
  }

}

function _index() {
  $data['status']=retrieve_taps_status();
  $data['body'][]=View::do_fetch(VIEW_PATH.'taps/index.php',$data);
  $data['body'][]=View::do_fetch(VIEW_PATH.'facebook/index.php');

  View::do_dump(VIEW_PATH.'taps-layout.php',$data);	  
}
