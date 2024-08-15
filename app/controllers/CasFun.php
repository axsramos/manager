<?php

use app\core\Controller;

class CasFun extends Controller
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
                $csCasFun = $this->model('CasFun');
                $data = $csCasFun->readAllLines();
            } else {
                $csCasFun = $this->model('CasFun');
                $csCasFun->setCasFunCod($id);
                $data = $csCasFun->readLine();
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

        $csCasFun = $this->model('CasFun');

        if (isset($this->data_content->CasFunCod)) {
            $csCasFun->setCasFunCod($this->data_content->CasFunCod);
        }
        if (isset($this->data_content->CasFunDca)) {
            $csCasFun->setCasFunDca($this->data_content->CasFunDca);
        }
        if (isset($this->data_content->CasFunDmd)) {
            $csCasFun->setCasFunDmd($this->data_content->CasFunDmd);
        }
        if (isset($this->data_content->CasFunDsc)) {
            $csCasFun->setCasFunDsc($this->data_content->CasFunDsc);
        }
        if (isset($this->data_content->CasFunBlq)) {
            $csCasFun->setCasFunBlq($this->data_content->CasFunBlq);
        }

        if ($csCasFun->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFun->messages)> 0) {
                foreach ($csCasFun->messages as $message_item) {
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

        $csCasFun = $this->model('CasFun');

        if (isset($this->data_content->CasFunCod)) {
            $csCasFun->setCasFunCod($this->data_content->CasFunCod);
        }
        if (isset($this->data_content->CasFunDca)) {
            $csCasFun->setCasFunDca($this->data_content->CasFunDca);
        }
        if (isset($this->data_content->CasFunDmd)) {
            $csCasFun->setCasFunDmd($this->data_content->CasFunDmd);
        }
        if (isset($this->data_content->CasFunDsc)) {
            $csCasFun->setCasFunDsc($this->data_content->CasFunDsc);
        }
        if (isset($this->data_content->CasFunBlq)) {
            $csCasFun->setCasFunBlq($this->data_content->CasFunBlq);
        }

        if ($csCasFun->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFun->messages)> 0) {
                foreach ($csCasFun->messages as $message_item) {
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

        $csCasFun = $this->model('CasFun');
        $csCasFun->setCasFunCod($id);

        if ($csCasFun->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFun->messages)> 0) {
                foreach ($csCasFun->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
