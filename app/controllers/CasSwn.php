<?php

use app\core\Controller;

class CasSwn extends Controller
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

    public function id($id = null, $nvg = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $nvg == null) {
                $csCasSwn = $this->model('CasSwn');
                $data = $csCasSwn->readAllLines();
            } else {
                $csCasSwn = $this->model('CasSwn');
                $csCasSwn->setCasSwbCod($id);
                $csCasSwn->setCasSwnCod($nvg);
                $data = $csCasSwn->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $nvg);
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

        $csCasSwn = $this->model('CasSwn');

        if (isset($this->data_content->CasSwbCod)) {
            $csCasSwn->setCasSwbCod($this->data_content->CasSwbCod);
        }
        if (isset($this->data_content->CasSwnCod)) {
            $csCasSwn->setCasSwnCod($this->data_content->CasSwnCod);
        }
        if (isset($this->data_content->CasSwnDca)) {
            $csCasSwn->setCasSwnDca($this->data_content->CasSwnDca);
        }
        if (isset($this->data_content->CasSwnDmd)) {
            $csCasSwn->setCasSwnDmd($this->data_content->CasSwnDmd);
        }

        if ($csCasSwn->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasSwn->messages)> 0) {
                foreach ($csCasSwn->messages as $message_item) {
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

        $csCasSwn = $this->model('CasSwn');

        if (isset($this->data_content->CasSwbCod)) {
            $csCasSwn->setCasSwbCod($this->data_content->CasSwbCod);
        }
        if (isset($this->data_content->CasSwnCod)) {
            $csCasSwn->setCasSwnCod($this->data_content->CasSwnCod);
        }
        if (isset($this->data_content->CasSwnDca)) {
            $csCasSwn->setCasSwnDca($this->data_content->CasSwnDca);
        }
        if (isset($this->data_content->CasSwnDmd)) {
            $csCasSwn->setCasSwnDmd($this->data_content->CasSwnDmd);
        }

        if ($csCasSwn->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasSwn->messages)> 0) {
                foreach ($csCasSwn->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $nvg)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasSwn = $this->model('CasSwn');
        $csCasSwn->setCasSwbCod($id);
        $csCasSwn->setCasSwnCod($nvg);

        if ($csCasSwn->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasSwn->messages)> 0) {
                foreach ($csCasSwn->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
