<?php

use app\core\Controller;
use app\models\CasIdy;

class Token extends Controller {

  public function index() {
    $message  = new MessageDictionary;
    $messages = array();
    $methods  = array('POST');
    
    if($this->checkMethod($message, $methods)) {
      $identity = '';
      
      if(isset(getallheaders()['Identity'])) {
        $identity = getallheaders()['Identity'];
      }

      if($identity == '') {
        http_response_code(401);
        array_push($messages, $message->getDictionaryError(1, "Messages", "Identity is required."));

        $data  = array("messages" => $messages );
      } else {
        $isOk = FALSE;
        $csCasIdy = new CasIdy();
        $csCasIdy->setCasIdyCod($identity);

        if($csCasIdy->validateIdentity()) {
            if($csCasIdy->getCasIdyLck() == 'N') {
              $isOk = TRUE;
              $GLOBALS['Identity'] = $csCasIdy->getCasIdyCod();
            } else {
              http_response_code(401);
              array_push($messages, $message->getDictionaryError(1, "Messages", "Identity is bloqued."));
            }
        } else {
          http_response_code(401);
          array_push($messages, $message->getDictionaryError(1, "Messages", "Identity is not valid."));
        }

        if($isOk) {
          http_response_code(200);

          $csCasIdy = new CasIdy();
        
          $csCasIdy->setCasIdyCod($GLOBALS['Identity']);

          $csCasIdy->newToken();

          $token = $csCasIdy->getCasIdyTkn();

          $data  = array('token' => $token);
        } else {
          $data  = array("messages" => $messages );
        }
      }

      $this->view('json_result', $data);
    }
  }

}
