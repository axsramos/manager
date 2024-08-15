<?php

use app\core\Controller;

class CasFemTo extends Controller
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

    public function id($id = null, $eml = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $eml == null) {
                $csCasFemTo = $this->model('CasFemTo');
                $data = $csCasFemTo->readAllLines();
            } else {
                $csCasFemTo = $this->model('CasFemTo');
                $csCasFemTo->setCasFemCod($id);
                $csCasFemTo->setCasFemToMai($eml);
                $data = $csCasFemTo->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $eml);
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

        $csCasFemTo = $this->model('CasFemTo');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemTo->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemToMai)) {
            $csCasFemTo->setCasFemToMai($this->data_content->CasFemToMai);
        }
        if (isset($this->data_content->CasFemToDca)) {
            $csCasFemTo->setCasFemToDca($this->data_content->CasFemToDca);
        }
        if (isset($this->data_content->CasFemToDmd)) {
            $csCasFemTo->setCasFemToDmd($this->data_content->CasFemToDmd);
        }

        if ($csCasFemTo->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemTo->messages)> 0) {
                foreach ($csCasFemTo->messages as $message_item) {
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

        $csCasFemTo = $this->model('CasFemTo');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemTo->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemToMai)) {
            $csCasFemTo->setCasFemToMai($this->data_content->CasFemToMai);
        }
        if (isset($this->data_content->CasFemToDca)) {
            $csCasFemTo->setCasFemToDca($this->data_content->CasFemToDca);
        }
        if (isset($this->data_content->CasFemToDmd)) {
            $csCasFemTo->setCasFemToDmd($this->data_content->CasFemToDmd);
        }

        if ($csCasFemTo->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemTo->messages)> 0) {
                foreach ($csCasFemTo->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $eml)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasFemTo = $this->model('CasFemTo');
        $csCasFemTo->setCasFemCod($id);
        $csCasFemTo->setCasFemToMai($eml);

        if ($csCasFemTo->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFemTo->messages)> 0) {
                foreach ($csCasFemTo->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
