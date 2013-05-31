<?php
require('kissmvc_core.php');

//===============================================================
// Controller
//===============================================================

class Controller extends KISS_Controller {

  //This function parses the HTTP request to get the controller name, action name and parameter array.
  function parse_http_request() {
    //you can define custom routes using PHP code
    $this->params = array();
    $p = $this->request_uri_parts;

    if(isset($p[0])){
      $this->controller='taps';
      $this->action='index';
      $this->params=array_slice($p,0);
    }
    else
      parent::parse_http_request(); //doesn't match any custom routes, so parse it as per normal
    return $this;
  }

}

//===============================================================
// View
//===============================================================

class View extends KISS_View {
}

//===============================================================
// Model/ORM
//===============================================================

class Model extends KISS_Model  {
}
