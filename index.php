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

// define('WEB_DOMAIN','http://localhost'); //with http:// and NO trailing slash pls
// define('WEB_FOLDER','/tapsaff/'); //with trailing slash pls

define('WEB_DOMAIN','http://www.taps-aff.co.uk'); //with http:// and NO trailing slash pls
define('WEB_FOLDER','/'); //with trailing slash pls

define('VIEW_PATH','app/views/'); //with trailing slash pls

date_default_timezone_set('Europe/London'); //Sorts out daylight savings

//===============================================
// Includes
//===============================================
require('kissmvc.php');
require('lib/getjson_cache.php');

//===============================================
// SSL Hack
//===============================================
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);

//===============================================
// Session
//===============================================
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
session_start();

//===============================================
// Globals
//===============================================
$GLOBALS['sitename']='Taps-Aff or Taps-Oan?';
$GLOBALS['json_local']=getcwd().'/taps.json';
$GLOBALS['json_url']= 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22LOCATION%2Cuk%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';
$GLOBALS['json_cache_window']='-5 minutes';
$GLOBALS['taps_temp'] = 65; //should be 62
$GLOBALS['json_lifespan'] = '+15 minutes';
$GLOBALS['default_location'] = 'Glasgow';
$GLOBALS['sslContextOptions'] = array(
                                  "ssl"=>array(
                                      "verify_peer"=>false,
                                      "verify_peer_name"=>false,
                                  ),
                                );

// List of codes of non-aff weather
$GLOBALS['terrible_weather'] = array(
  0,   // tornado
  1,   // tropical storm
  2,   // hurricane
  3,   // severe thunderstorms
  4,   // thunderstorms
  5,   // mixed rain and snow
  6,   // mixed rain and sleet
  7,   // mixed snow and sleet
  8,   // freezing drizzle
  9,   // drizzle
  10,  // freezing rain
  11,  // showers
  12,  // showers
  13,  // snow flurries
  14,  // light snow showers
  15,  // blowing snow
  16,  // snow
  17,  // hail
  18,  // sleet
  19,  // dust
  20,  // foggy
  21,  // haze
  22,  // smoky
  25,  // cold
  35,  // mixed rain and hail
  36,  // hot
  37,  // isolated thunderstorms
  38,  // scattered thunderstorms
  39,  // scattered thunderstorms
  40,  // scattered showers
  41,  // heavy snow
  42,  // scattered snow showers
  43,  // heavy snow
  45,  // thundershowers
  46,  // snow showers
  47  // isolated thundershowers
);

$GLOBALS['weather_description'] = array(
  "mental", //tornado
  "mental", //tropical storm
  "mental", //hurricane
  "radge", //severe thunderstorms
  "radge", //thunderstorms
  "boggin'", //mixed rain and snow
  "boggin'", //mixed rain and sleet
  "boggin'", //mixed snow and sleet
  "dreich", //freezing drizzle
  "pish", //drizzle
  "dreich", //freezing rain
  "pishin' it", //showers
  "pishin' it", //showers
  "baltic", //snow flurries
  "baltic", //light snow showers
  "baltic", //blowing snow
  "baltic", //snow
  "baws", //hail
  "bowfin", //sleet
  "stoory", //dust
  "misty", //foggy
  "misty", //haze
  "misty", //smoky
  "blawin'", //blustery
  "mental", //windy
  "baltic", //cold
  "awright", //cloudy
  "awright", //mostly cloudy (night)
  "awright", //mostly cloudy (day)
  "awright", //partly cloudy (night)
  "awright", //partly cloudy (day)
  "awright", //clear (night)
  "braw", //sunny
  "awright", //fair (night)
  "awright", //fair (day)
  "mental", //mixed rain and hail
  "sweltrin'", //hot
  "hackit", //isolated thunderstorms
  "hackit", //scattered thunderstorms
  "hackit", //scattered thunderstorms
  "pish", //scattered showers
  "baltic", //heavy snow
  "baltic", //scattered snow showers
  "mingin'", //heavy snow
  "awright", //partly cloudy
  "boggin'", //thundershowers
  "mingin'", //snow showers
  "mingin'"  //isolated thundershowers
);

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
