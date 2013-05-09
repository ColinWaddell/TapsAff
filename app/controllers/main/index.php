<?php
function _index() {
  $data['body'][]=View::do_fetch(VIEW_PATH.'main/index.php');
  View::do_dump(VIEW_PATH.'layout.php',$data);
}