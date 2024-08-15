<?php

use app\core\Controller;

class CasUsr extends Controller
{
    private $data_content = [];

    public function index()
    {
        $message  = new MessageDictionary;
        $messages = array();
        $methods  = array('GET', 'POST', 'PUT', 'DELETE');

        if ($this->checkMethod($message, $methods)) {

            $this->data_content = json_decode(file_get_contents('php://input'));

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->id();
                    break;
                case 'POST':
                    $this->methodPost();
                    break;
                case 'PUT':
                    $this->methodPut();
                    break;
                case 'DELETE':
                    $this->methodDelete('');
                default:
                    # code...
                    break;
            }
        }
    }

    public function id($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null) {
                $csCasUsr = $this->model('CasUsr');
                $data = $csCasUsr->readAllLines();
            } else {
                $csCasUsr = $this->model('CasUsr');
                $csCasUsr->setCasUsrCod($id);
                $data = $csCasUsr->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id);
        } else {
            if ($data == FALSE) {
                $this->noContent();
            } else {
                http_response_code(200);
                $this->view('json_result', array("results" => $data));
            }
        }
    }

    private function methodPost()
    {
        $message  = new MessageDictionary;
        $messages = array();

        $csCasUsr = $this->model('CasUsr');

        if (isset($this->data_content->CasUsrCod)) {
            $csCasUsr->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasUsrDca)) {
            $csCasUsr->setCasUsrDca($this->data_content->CasUsrDca);
        }
        if (isset($this->data_content->CasUsrDmd)) {
            $csCasUsr->setCasUsrDmd($this->data_content->CasUsrDmd);
        }
        if (isset($this->data_content->CasUsrDsc)) {
            $csCasUsr->setCasUsrDsc($this->data_content->CasUsrDsc);
        }
        if (isset($this->data_content->CasUsrBlq)) {
            $csCasUsr->setCasUsrBlq($this->data_content->CasUsrBlq);
        }
        if (isset($this->data_content->CasUsrDmn)) {
            $csCasUsr->setCasUsrDmn($this->data_content->CasUsrDmn);
        }
        if (isset($this->data_content->CasUsrLgn)) {
            $csCasUsr->setCasUsrLgn($this->data_content->CasUsrLgn);
        }
        if (isset($this->data_content->CasUsrPwd)) {
            $csCasUsr->setCasUsrPwd($this->data_content->CasUsrPwd);
        }
        if (isset($this->data_content->CasUsrChv)) {
            $csCasUsr->setCasUsrChv($this->data_content->CasUsrChv);
        }


        if ($csCasUsr->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasUsr->messages) > 0) {
                foreach ($csCasUsr->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodPut()
    {
        $message  = new MessageDictionary;
        $messages = array();

        $csCasUsr = $this->model('CasUsr');

        if (isset($this->data_content->CasUsrCod)) {
            $csCasUsr->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasUsrDca)) {
            $csCasUsr->setCasUsrDca($this->data_content->CasUsrDca);
        }
        if (isset($this->data_content->CasUsrDmd)) {
            $csCasUsr->setCasUsrDmd($this->data_content->CasUsrDmd);
        }
        if (isset($this->data_content->CasUsrDsc)) {
            $csCasUsr->setCasUsrDsc($this->data_content->CasUsrDsc);
        }
        if (isset($this->data_content->CasUsrBlq)) {
            $csCasUsr->setCasUsrBlq($this->data_content->CasUsrBlq);
        }
        if (isset($this->data_content->CasUsrDmn)) {
            $csCasUsr->setCasUsrDmn($this->data_content->CasUsrDmn);
        }
        if (isset($this->data_content->CasUsrLgn)) {
            $csCasUsr->setCasUsrLgn($this->data_content->CasUsrLgn);
        }
        if (isset($this->data_content->CasUsrPwd)) {
            $csCasUsr->setCasUsrPwd($this->data_content->CasUsrPwd);
        }
        if (isset($this->data_content->CasUsrChv)) {
            $csCasUsr->setCasUsrChv($this->data_content->CasUsrChv);
        }

        if ($csCasUsr->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasUsr->messages) > 0) {
                foreach ($csCasUsr->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasUsr = $this->model('CasUsr');
        $csCasUsr->setCasUsrCod($id);

        if ($csCasUsr->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasUsr->messages) > 0) {
                foreach ($csCasUsr->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
