<?php

use app\core\Controller;

class CasSwp extends Controller
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
                $csCasSwp = $this->model('CasSwp');
                $data = $csCasSwp->readAllLines();
            } else {
                $csCasSwp = $this->model('CasSwp');
                $csCasSwp->setCasSwbCod($id);
                $csCasSwp->setCasPrgCod($prg);
                $data = $csCasSwp->readLine();
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

        $csCasSwp = $this->model('CasSwp');

        if (isset($this->data_content->CasSwbCod)) {
            $csCasSwp->setCasSwbCod($this->data_content->CasSwbCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasSwp->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasSwpDca)) {
            $csCasSwp->setCasSwpDca($this->data_content->CasSwpDca);
        }
        if (isset($this->data_content->CasSwpDmd)) {
            $csCasSwp->setCasSwpDmd($this->data_content->CasSwpDmd);
        }
        if (isset($this->data_content->CasSwpVch)) {
            $csCasSwp->setCasSwpVch($this->data_content->CasSwpVch);
        }

        if ($csCasSwp->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasSwp->messages)> 0) {
                foreach ($csCasSwp->messages as $message_item) {
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

        $csCasSwp = $this->model('CasSwp');

        if (isset($this->data_content->CasSwbCod)) {
            $csCasSwp->setCasSwbCod($this->data_content->CasSwbCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasSwp->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasSwpDca)) {
            $csCasSwp->setCasSwpDca($this->data_content->CasSwpDca);
        }
        if (isset($this->data_content->CasSwpDmd)) {
            $csCasSwp->setCasSwpDmd($this->data_content->CasSwpDmd);
        }
        if (isset($this->data_content->CasSwpVch)) {
            $csCasSwp->setCasSwpVch($this->data_content->CasSwpVch);
        }

        if ($csCasSwp->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasSwp->messages)> 0) {
                foreach ($csCasSwp->messages as $message_item) {
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

        $csCasSwp = $this->model('CasSwp');
        $csCasSwp->setCasSwbCod($id);
        $csCasSwp->setCasPrgCod($prg);

        if ($csCasSwp->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasSwp->messages)> 0) {
                foreach ($csCasSwp->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
