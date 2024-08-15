<?php

use app\core\Controller;

class CasPfi extends Controller
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
                $csCasPfi = $this->model('CasPfi');
                $data = $csCasPfi->readAllLines();
            } else {
                $csCasPfi = $this->model('CasPfi');
                $csCasPfi->setCasPfiCod($id);
                $data = $csCasPfi->readLine();
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

        $csCasPfi = $this->model('CasPfi');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasPfi->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasPfiDca)) {
            $csCasPfi->setCasPfiDca($this->data_content->CasPfiDca);
        }
        if (isset($this->data_content->CasPfiDmd)) {
            $csCasPfi->setCasPfiDmd($this->data_content->CasPfiDmd);
        }
        if (isset($this->data_content->CasPfiDsc)) {
            $csCasPfi->setCasPfiDsc($this->data_content->CasPfiDsc);
        }
        if (isset($this->data_content->CasPfiBlq)) {
            $csCasPfi->setCasPfiBlq($this->data_content->CasPfiBlq);
        }

        if ($csCasPfi->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPfi->messages)> 0) {
                foreach ($csCasPfi->messages as $message_item) {
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

        $csCasPfi = $this->model('CasPfi');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasPfi->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasPfiDca)) {
            $csCasPfi->setCasPfiDca($this->data_content->CasPfiDca);
        }
        if (isset($this->data_content->CasPfiDmd)) {
            $csCasPfi->setCasPfiDmd($this->data_content->CasPfiDmd);
        }
        if (isset($this->data_content->CasPfiDsc)) {
            $csCasPfi->setCasPfiDsc($this->data_content->CasPfiDsc);
        }
        if (isset($this->data_content->CasPfiBlq)) {
            $csCasPfi->setCasPfiBlq($this->data_content->CasPfiBlq);
        }

        if ($csCasPfi->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPfi->messages)> 0) {
                foreach ($csCasPfi->messages as $message_item) {
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

        $csCasPfi = $this->model('CasPfi');
        $csCasPfi->setCasPfiCod($id);

        if ($csCasPfi->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasPfi->messages)> 0) {
                foreach ($csCasPfi->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
