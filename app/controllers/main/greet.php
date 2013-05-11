<?php
function _greet($param='') {
  $name = 'Guest';
  if (isset($_GET['name']))
    $name = strip_tags($_GET['name']);
  elseif ($param)
    $name = strip_tags(rawurldecode($param));
  elseif (isset($_SESSION['name']))
    $name = $_SESSION['name'];
  $_SESSION['name'] = $name;

  $data['datetime']=date('Y-m-d H:i:s');
  $data['body'][]="<h2>Hello $name!</h2>";
  $data['body'][]='<p>Try changing your name by adding your name as a parameter to the URL or using the querystring!</p>';
  $data['body'][]='<p>eg.<br />
<a href="/kissmvc_simple/main/greet/Anonymous User">http://demo.kissmvc.com/kissmvc_simple/main/greet/Anonymous User</a><br />
<a href="/kissmvc_simple/main/greet/?name=Anonymous%20User%20Too">http://demo.kissmvc.com/kissmvc_simple/main/greet/?name=Anonymous%20User%20Too</a><br />
</p>
<p>In this demo, a custom URI route is coded (inside kissmvc.php) so that <b>/welcome</b> => <b>/main/greet</b><br />
eg.<br />
<a href="/kissmvc_simple/welcome/Anonymous User 3">http://demo.kissmvc.com/kissmvc_simple/welcome/Anonymous User 3</a><br />
<a href="/kissmvc_simple/welcome/?name=Anonymous%20User%204">http://demo.kissmvc.com/kissmvc_simple/welcome/?name=Anonymous%20User%204</a><br />
</p>';
  View::do_dump(VIEW_PATH.'page-layout.php',$data);
}