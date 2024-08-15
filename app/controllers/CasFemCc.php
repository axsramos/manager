<?php

use app\core\Controller;

class CasFemCc extends Controller
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
                $csCasFemCc = $this->model('CasFemCc');
                $data = $csCasFemCc->readAllLines();
            } else {
                $csCasFemCc = $this->model('CasFemCc');
                $csCasFemCc->setCasFemCod($id);
                $csCasFemCc->setCasFemCcMai($eml);
                $data = $csCasFemCc->readLine();
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

        $csCasFemCc = $this->model('CasFemCc');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemCc->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemCcMai)) {
            $csCasFemCc->setCasFemCcMai($this->data_content->CasFemCcMai);
        }
        if (isset($this->data_content->CasFemCcDca)) {
            $csCasFemCc->setCasFemCcDca($this->data_content->CasFemCcDca);
        }
        if (isset($this->data_content->CasFemCcDmd)) {
            $csCasFemCc->setCasFemCcDmd($this->data_content->CasFemCcDmd);
        }

        if ($csCasFemCc->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemCc->messages)> 0) {
                foreach ($csCasFemCc->messages as $message_item) {
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

        $csCasFemCc = $this->model('CasFemCc');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemCc->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemCcMai)) {
            $csCasFemCc->setCasFemCcMai($this->data_content->CasFemCcMai);
        }
        if (isset($this->data_content->CasFemCcDca)) {
            $csCasFemCc->setCasFemCcDca($this->data_content->CasFemCcDca);
        }
        if (isset($this->data_content->CasFemCcDmd)) {
            $csCasFemCc->setCasFemCcDmd($this->data_content->CasFemCcDmd);
        }

        if ($csCasFemCc->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemCc->messages)> 0) {
                foreach ($csCasFemCc->messages as $message_item) {
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

        $csCasFemCc = $this->model('CasFemCc');
        $csCasFemCc->setCasFemCod($id);
        $csCasFemCc->setCasFemCcMai($eml);

        if ($csCasFemCc->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFemCc->messages)> 0) {
                foreach ($csCasFemCc->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
