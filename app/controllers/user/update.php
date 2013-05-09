<?php
function _update() {
  $name=isset($_POST['name']) ? strip_tags($_POST['name']) : 'Guest';
  $_SESSION['name']=$name;
  header('Location: '.myUrl('main/greet'));
}