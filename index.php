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
$GLOBALS['taps_temp'] = 62; //should be 62
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
  "Mental", //  0 - tornado
  "Mental", //  1 - tropical storm
  "Mental", //  2 - hurricane
  "Radge", //  3 - severe thunderstorms
  "Radge", //  4 - thunderstorms
  "Boggin'", //  5 - mixed rain and snow
  "Boggin'", //  6 - mixed rain and sleet
  "Boggin'", //  7 - mixed snow and sleet
  "Dreich", //  8 - freezing drizzle
  "Pish", //  9 - drizzle
  "Dreich", // 10 - freezing rain
  "Pish", // 11 - showers
  "Pish", // 12 - showers
  "Baltic", // 13 - snow flurries
  "Baltic", // 14 - light snow showers
  "Baltic", // 15 - blowing snow
  "Baltic", // 16 - snow
  "Boggin'", // 17 - hail
  "Boggin'", // 18 - sleet
  "Stoory", // 19 - dust
  "Misty", // 20 - foggy
  "Misty", // 21 - haze
  "Misty", // 22 - smoky
  "Blawy", // 23 - blustery
  "Mental", // 24 - windy
  "Baltic", // 25 - cold
  "Awright", // 26 - cloudy
  "Awright", // 27 - mostly cloudy (night)
  "Awright", // 28 - mostly cloudy (day)
  "Awright", // 29 - partly cloudy (night)
  "Awright", // 30 - partly cloudy (day)
  "Awright", // 31 - clear (night)
  "Braw", // 32 - sunny
  "Awright", // 33 - fair (night)
  "Awright", // 34 - fair (day)
  "Mental", // 35 - mixed rain and hail
  "Sweltrin'", // 36 - hot
  "Hackit", // 37 - isolated thunderstorms
  "Hackit", // 38 - scattered thunderstorms
  "Pish", // 39 - scattered showers
  "Pish", // 40 - scattered showers
  "Baltic", // 41 - heavy snow
  "Baltic", // 42 - scattered snow showers
  "Baltic'", // 43 - heavy snow
  "Awright", // 44 - partly cloudy
  "Boggin'", // 45 - thundershowers
  "Baltic'", // 46 - snow showers
  "Pish'"  // 47 - isolated thundershowers
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
