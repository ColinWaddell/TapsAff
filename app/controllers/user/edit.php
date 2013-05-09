<?php
function _edit() {
  $name=isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
  $data['name']=$name;
  $data['body'][]=View::do_fetch(VIEW_PATH.'user/edit.php',$data);
  View::do_dump(VIEW_PATH.'layout.php',$data);	  
}