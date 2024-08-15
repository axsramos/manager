<?php

use app\core\Controller;

class CasApf extends Controller
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
                    $this->methodDelete('','','');
                default:
                    # code...
                    break;
            }
        }
    }

    public function id($id = null, $usr = null, $prg = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $usr == null || $prg == null) {
                $csCasApf = $this->model('CasApf');
                $data = $csCasApf->readAllLines();
            } else {
                $csCasApf = $this->model('CasApf');
                $csCasApf->setCasPfiCod($id);
                $csCasApf->setCasUsrCod($usr);
                $csCasApf->setCasPrgCod($prg);
                $data = $csCasApf->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $usr, $prg);
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

        $csCasApf = $this->model('CasApf');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasApf->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasUsrCod)) {
            $csCasApf->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasApf->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasApfDca)) {
            $csCasApf->setCasApfDca($this->data_content->CasApfDca);
        }
        if (isset($this->data_content->CasApfDmd)) {
            $csCasApf->setCasApfDmd($this->data_content->CasApfDmd);
        }

        if ($csCasApf->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasApf->messages)> 0) {
                foreach ($csCasApf->messages as $message_item) {
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

        $csCasApf = $this->model('CasApf');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasApf->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasUsrCod)) {
            $csCasApf->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasApf->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasApfDca)) {
            $csCasApf->setCasApfDca($this->data_content->CasApfDca);
        }
        if (isset($this->data_content->CasApfDmd)) {
            $csCasApf->setCasApfDmd($this->data_content->CasApfDmd);
        }

        if ($csCasApf->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasApf->messages)> 0) {
                foreach ($csCasApf->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $usr, $prg)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasApf = $this->model('CasApf');
        $csCasApf->setCasPfiCod($id);
        $csCasApf->setCasUsrCod($usr);
        $csCasApf->setCasPrgCod($prg);

        if ($csCasApf->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasApf->messages)> 0) {
                foreach ($csCasApf->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
