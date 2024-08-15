<?php

use app\core\Controller;

class CasFemCco extends Controller
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
                $csCasFemCco = $this->model('CasFemCco');
                $data = $csCasFemCco->readAllLines();
            } else {
                $csCasFemCco = $this->model('CasFemCco');
                $csCasFemCco->setCasFemCod($id);
                $csCasFemCco->setCasFemCcoMai($eml);
                $data = $csCasFemCco->readLine();
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

        $csCasFemCco = $this->model('CasFemCco');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemCco->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemCcoMai)) {
            $csCasFemCco->setCasFemCcoMai($this->data_content->CasFemCcoMai);
        }
        if (isset($this->data_content->CasFemCcoDca)) {
            $csCasFemCco->setCasFemCcoDca($this->data_content->CasFemCcoDca);
        }
        if (isset($this->data_content->CasFemCcoDmd)) {
            $csCasFemCco->setCasFemCcoDmd($this->data_content->CasFemCcoDmd);
        }

        if ($csCasFemCco->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemCco->messages)> 0) {
                foreach ($csCasFemCco->messages as $message_item) {
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

        $csCasFemCco = $this->model('CasFemCco');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemCco->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemCcoMai)) {
            $csCasFemCco->setCasFemCcoMai($this->data_content->CasFemCcoMai);
        }
        if (isset($this->data_content->CasFemCcoDca)) {
            $csCasFemCco->setCasFemCcoDca($this->data_content->CasFemCcoDca);
        }
        if (isset($this->data_content->CasFemCcoDmd)) {
            $csCasFemCco->setCasFemCcoDmd($this->data_content->CasFemCcoDmd);
        }

        if ($csCasFemCco->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemCco->messages)> 0) {
                foreach ($csCasFemCco->messages as $message_item) {
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

        $csCasFemCco = $this->model('CasFemCco');
        $csCasFemCco->setCasFemCod($id);
        $csCasFemCco->setCasFemCcoMai($eml);

        if ($csCasFemCco->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFemCco->messages)> 0) {
                foreach ($csCasFemCco->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
