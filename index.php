<?php
//===============================================
// Debug
//===============================================
ini_set('display_errors','On');
error_reporting(E_ALL);

//===============================================
// mod_rewrite
//===============================================
//Please configure via .htaccess or httpd.conf

//===============================================
// KISSMVC Settings (please configure)
//===============================================
define('APP_PATH','app/'); //with trailing slash pls
define('WEB_DOMAIN','http://colinwaddell-mbp.local'); //with http:// and NO trailing slash pls
define('WEB_FOLDER','/tapsaff/'); //with trailing slash pls
//define('WEB_FOLDER','/kissmvc_simple/index.php/'); //use this if you do not have mod_rewrite enabled
define('VIEW_PATH','app/views/'); //with trailing slash pls

//===============================================
// Includes
//===============================================
require('kissmvc.php');

//===============================================
// Session
//===============================================
session_start();

//===============================================
// Globals
//===============================================
$GLOBALS['sitename']='Glasgow, Taps-Aff or Taps-Oan?';
$GLOBALS['json_local']=getcwd().'/taps.json';
$GLOBALS['json_url']='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20location%3D%22UKXX0061%22&format=json';
$GLOBALS['taps_temp'] = 63;
$GLOBALS['json_lifespan'] = '+30 minutes';

//===============================================
// Functions
//===============================================
function myUrl($url='',$fullurl=false) {
  $s=$fullurl ? WEB_DOMAIN : '';
  $s.=WEB_FOLDER.$url;
  return $s;
}

//==============================================
// Start the controller
//===============================================
$controller = new Controller(APP_PATH.'controllers/',WEB_FOLDER,'taps','index');
