<?php
function _clear() {
  $_SESSION = array();
  if (isset($_COOKIE[session_name()]))
    setcookie(session_name(), '', time()-42000, '/');
  session_destroy();
  $data['body'][]="<h2>Sessions and Cookies Cleared!</h2>";
  View::do_dump(VIEW_PATH.'page-layout.php',$data);
}