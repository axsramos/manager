<?php

use app\core\Controller;

class CasFpr extends Controller
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

    public function id($id = null, $prg = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $prg == null) {
                $csCasFpr = $this->model('CasFpr');
                $data = $csCasFpr->readAllLines();
            } else {
                $csCasFpr = $this->model('CasFpr');
                $csCasFpr->setCasFunCod($id);
                $csCasFpr->setCasPrgCod($prg);
                $data = $csCasFpr->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $prg);
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

        $csCasFpr = $this->model('CasFpr');

        if (isset($this->data_content->CasFunCod)) {
            $csCasFpr->setCasFunCod($this->data_content->CasFunCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasFpr->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasFprDca)) {
            $csCasFpr->setCasFprDca($this->data_content->CasFprDca);
        }
        if (isset($this->data_content->CasFprDmd)) {
            $csCasFpr->setCasFprDmd($this->data_content->CasFprDmd);
        }

        if ($csCasFpr->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFpr->messages)> 0) {
                foreach ($csCasFpr->messages as $message_item) {
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

        $csCasFpr = $this->model('CasFpr');

        if (isset($this->data_content->CasFunCod)) {
            $csCasFpr->setCasFunCod($this->data_content->CasFunCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasFpr->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasFprDca)) {
            $csCasFpr->setCasFprDca($this->data_content->CasFprDca);
        }
        if (isset($this->data_content->CasFprDmd)) {
            $csCasFpr->setCasFprDmd($this->data_content->CasFprDmd);
        }

        if ($csCasFpr->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFpr->messages)> 0) {
                foreach ($csCasFpr->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $prg)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasFpr = $this->model('CasFpr');
        $csCasFpr->setCasFunCod($id);
        $csCasFpr->setCasPrgCod($prg);

        if ($csCasFpr->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFpr->messages)> 0) {
                foreach ($csCasFpr->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
