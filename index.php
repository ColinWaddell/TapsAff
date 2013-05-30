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

//define('WEB_DOMAIN','http://www.taps-aff.co.uk'); //with http:// and NO trailing slash pls
//define('WEB_FOLDER','/'); //with trailing slash pls

define('VIEW_PATH','app/views/'); //with trailing slash pls

date_default_timezone_set('Europe/London'); //Sorts out daylight savings

//===============================================
// Includes
//===============================================
require('kissmvc.php');

//===============================================
// Session
//===============================================
//===============================================
// Session
//===============================================
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
session_start();

//===============================================
// Globals
//===============================================
$GLOBALS['sitename']='Glasgow, Taps-Aff or Taps-Oan?';
$GLOBALS['json_local']=getcwd().'/taps.json';
$GLOBALS['json_url']='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20location%20in%0A%20%20%20(select%20id%20from%20xml%20where%0A%20%20%20%20url%3D%22http%3A%2F%2Fxoap.weather.com%2Fsearch%2Fsearch%3Fwhere%3DLOCATION%2520UK%22%0A%20%20%20%20and%20itemPath%3D%22search.loc%22)%0A&diagnostics=true&format=json';
$GLOBALS['taps_temp'] = 63;
$GLOBALS['json_lifespan'] = '+15 minutes';
$GLOBALS['default_location'] = 'Glasgow';

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
