<?php

use app\core\Controller;

class CasPrg extends Controller
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
                $csCasPrg = $this->model('CasPrg');
                $data = $csCasPrg->readAllLines();
            } else {
                $csCasPrg = $this->model('CasPrg');
                $csCasPrg->setCasPrgCod($id);
                $data = $csCasPrg->readLine();
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

        $csCasPrg = $this->model('CasPrg');

        if (isset($this->data_content->CasPrgCod)) {
            $csCasPrg->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasPrgDca)) {
            $csCasPrg->setCasPrgDca($this->data_content->CasPrgDca);
        }
        if (isset($this->data_content->CasPrgDmd)) {
            $csCasPrg->setCasPrgDmd($this->data_content->CasPrgDmd);
        }
        if (isset($this->data_content->CasPrgDsc)) {
            $csCasPrg->setCasPrgDsc($this->data_content->CasPrgDsc);
        }
        if (isset($this->data_content->CasPrgBlq)) {
            $csCasPrg->setCasPrgBlq($this->data_content->CasPrgBlq);
        }

        if ($csCasPrg->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPrg->messages)> 0) {
                foreach ($csCasPrg->messages as $message_item) {
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

        $csCasPrg = $this->model('CasPrg');

        if (isset($this->data_content->CasPrgCod)) {
            $csCasPrg->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasPrgDca)) {
            $csCasPrg->setCasPrgDca($this->data_content->CasPrgDca);
        }
        if (isset($this->data_content->CasPrgDmd)) {
            $csCasPrg->setCasPrgDmd($this->data_content->CasPrgDmd);
        }
        if (isset($this->data_content->CasPrgDsc)) {
            $csCasPrg->setCasPrgDsc($this->data_content->CasPrgDsc);
        }
        if (isset($this->data_content->CasPrgBlq)) {
            $csCasPrg->setCasPrgBlq($this->data_content->CasPrgBlq);
        }

        if ($csCasPrg->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPrg->messages)> 0) {
                foreach ($csCasPrg->messages as $message_item) {
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

        $csCasPrg = $this->model('CasPrg');
        $csCasPrg->setCasPrgCod($id);

        if ($csCasPrg->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasPrg->messages)> 0) {
                foreach ($csCasPrg->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
