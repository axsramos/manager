<?php

use app\core\Controller;

class CasFem extends Controller
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
                $csCasFem = $this->model('CasFem');
                $data = $csCasFem->readAllLines();
            } else {
                $csCasFem = $this->model('CasFem');
                $csCasFem->setCasFemCod($id);
                $data = $csCasFem->readLine();
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

        $csCasFem = $this->model('CasFem');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFem->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemDca)) {
            $csCasFem->setCasFemDca($this->data_content->CasFemDca);
        }
        if (isset($this->data_content->CasFemDmd)) {
            $csCasFem->setCasFemDmd($this->data_content->CasFemDmd);
        }
        if (isset($this->data_content->CasFemDsc)) {
            $csCasFem->setCasFemDsc($this->data_content->CasFemDsc);
        }
        if (isset($this->data_content->CasFemBlq)) {
            $csCasFem->setCasFemBlq($this->data_content->CasFemBlq);
        }
        if (isset($this->data_content->CasFemGerFlg)) {
            $csCasFem->setCasFemGerFlg($this->data_content->CasFemGerFlg);
        }
        if (isset($this->data_content->CasFemGerDtt)) {
            $csCasFem->setCasFemGerDtt($this->data_content->CasFemGerDtt);
        }
        if (isset($this->data_content->CasFemEnvFlg)) {
            $csCasFem->setCasFemEnvFlg($this->data_content->CasFemEnvFlg);
        }
        if (isset($this->data_content->CasFemEnvDtt)) {
            $csCasFem->setCasFemEnvDtt($this->data_content->CasFemEnvDtt);
        }
        if (isset($this->data_content->CasFemPar)) {
            $csCasFem->setCasFemPar($this->data_content->CasFemPar);
        }

        if ($csCasFem->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFem->messages) > 0) {
                foreach ($csCasFem->messages as $message_item) {
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

        $csCasFem = $this->model('CasFem');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFem->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemDca)) {
            $csCasFem->setCasFemDca($this->data_content->CasFemDca);
        }
        if (isset($this->data_content->CasFemDmd)) {
            $csCasFem->setCasFemDmd($this->data_content->CasFemDmd);
        }
        if (isset($this->data_content->CasFemDsc)) {
            $csCasFem->setCasFemDsc($this->data_content->CasFemDsc);
        }
        if (isset($this->data_content->CasFemBlq)) {
            $csCasFem->setCasFemBlq($this->data_content->CasFemBlq);
        }
        if (isset($this->data_content->CasFemGerFlg)) {
            $csCasFem->setCasFemGerFlg($this->data_content->CasFemGerFlg);
        }
        if (isset($this->data_content->CasFemGerDtt)) {
            $csCasFem->setCasFemGerDtt($this->data_content->CasFemGerDtt);
        }
        if (isset($this->data_content->CasFemEnvFlg)) {
            $csCasFem->setCasFemEnvFlg($this->data_content->CasFemEnvFlg);
        }
        if (isset($this->data_content->CasFemEnvDtt)) {
            $csCasFem->setCasFemEnvDtt($this->data_content->CasFemEnvDtt);
        }
        if (isset($this->data_content->CasFemPar)) {
            $csCasFem->setCasFemPar($this->data_content->CasFemPar);
        }

        if ($csCasFem->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFem->messages) > 0) {
                foreach ($csCasFem->messages as $message_item) {
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

        $csCasFem = $this->model('CasFem');
        $csCasFem->setCasFemCod($id);

        if ($csCasFem->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFem->messages) > 0) {
                foreach ($csCasFem->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
