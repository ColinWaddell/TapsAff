<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<base href="<?php echo myUrl('',true)?>" />
<title><?php echo $GLOBALS['sitename']?></title>
<style type="text/css">
ul {
  margin:0;
  padding:0;
  list-style-type:none;
}
li {
  display:inline;
  margin:0;
  padding:0;
}
</style>
</head>
<body>
<div>
  <ul>
    <li><a href="<?php echo myUrl('')?>">Main</a></li>
    <li><a href="<?php echo myUrl('user/edit')?>">Your Profile</a></li>
    <li><a href="<?php echo myUrl('main/greet')?>">Greetings</a></li>
    <li><a href="<?php echo myUrl('main/clear')?>">Clear Session</a></li>
  </ul>
</div>
<hr />
<div>
<?php
if (isset($body) && is_array($body))
  foreach ($body as $html)
    echo "$html\n";
if (isset($datetime))
  echo '<p>The time now is '.$datetime.'</p>';
?>
</div>
</body>
</html>