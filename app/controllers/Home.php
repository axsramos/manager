<?php

use app\core\Controller;

class Home extends Controller {

  public function index() {
    $message  = new MessageDictionary;
    $messages = array();
    $methods  = array('GET','POST');

    if($this->checkMethod($message, $methods)) {
      http_response_code(200);
      array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

      if($GLOBALS['Identity'] != '') {
        array_push($messages, $message->getDictionaryError(0, "Identity", $GLOBALS['Identity']));
      } else {
        array_push($messages, $message->getDictionaryError(1, "Identity", ''));
      }
      
      $data = array("Messages" => $messages);

      $this->view('json_result', $data);
    }

  }

}
