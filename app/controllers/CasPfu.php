<?php

use app\core\Controller;

class CasPfu extends Controller
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
                    $this->methodDelete('','');
                default:
                    # code...
                    break;
            }
        }
    }

    public function id($id = null, $usr = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $usr == null) {
                $csCasPfu = $this->model('CasPfu');
                $data = $csCasPfu->readAllLines();
            } else {
                $csCasPfu = $this->model('CasPfu');
                $csCasPfu->setCasPfiCod($id);
                $csCasPfu->setCasUsrCod($usr);
                $data = $csCasPfu->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $usr);
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

        $csCasPfu = $this->model('CasPfu');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasPfu->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasUsrCod)) {
            $csCasPfu->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasPfuDca)) {
            $csCasPfu->setCasPfuDca($this->data_content->CasPfuDca);
        }
        if (isset($this->data_content->CasPfuDmd)) {
            $csCasPfu->setCasPfuDmd($this->data_content->CasPfuDmd);
        }

        if ($csCasPfu->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPfu->messages)> 0) {
                foreach ($csCasPfu->messages as $message_item) {
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

        $csCasPfu = $this->model('CasPfu');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasPfu->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasUsrCod)) {
            $csCasPfu->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasPfuDca)) {
            $csCasPfu->setCasPfuDca($this->data_content->CasPfuDca);
        }
        if (isset($this->data_content->CasPfuDmd)) {
            $csCasPfu->setCasPfuDmd($this->data_content->CasPfuDmd);
        }

        if ($csCasPfu->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPfu->messages)> 0) {
                foreach ($csCasPfu->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $usr)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasPfu = $this->model('CasPfu');
        $csCasPfu->setCasPfiCod($id);
        $csCasPfu->setCasUsrCod($usr);

        if ($csCasPfu->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasPfu->messages)> 0) {
                foreach ($csCasPfu->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
