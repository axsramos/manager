<?php

use app\core\Controller;

class CasAfu extends Controller
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
                    $this->methodDelete('','','','');
                default:
                    # code...
                    break;
            }
        }
    }

    public function id($id = null, $usr = null, $prg = null, $fun = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $usr == null || $prg == null || $fun == null) {
                $csCasAfu = $this->model('CasAfu');
                $data = $csCasAfu->readAllLines();
            } else {
                $csCasAfu = $this->model('CasAfu');
                $csCasAfu->setCasPfiCod($id);
                $csCasAfu->setCasUsrCod($usr);
                $csCasAfu->setCasPrgCod($prg);
                $csCasAfu->setCasFunCod($fun);
                $data = $csCasAfu->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $usr, $prg, $fun);
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

        $csCasAfu = $this->model('CasAfu');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasAfu->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasUsrCod)) {
            $csCasAfu->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasAfu->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasFunCod)) {
            $csCasAfu->setCasFunCod($this->data_content->CasFunCod);
        }
        if (isset($this->data_content->CasAfuDca)) {
            $csCasAfu->setCasAfuDca($this->data_content->CasAfuDca);
        }
        if (isset($this->data_content->CasAfuDmd)) {
            $csCasAfu->setCasAfuDmd($this->data_content->CasAfuDmd);
        }

        if ($csCasAfu->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasAfu->messages)> 0) {
                foreach ($csCasAfu->messages as $message_item) {
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

        $csCasAfu = $this->model('CasAfu');

        if (isset($this->data_content->CasPfiCod)) {
            $csCasAfu->setCasPfiCod($this->data_content->CasPfiCod);
        }
        if (isset($this->data_content->CasUsrCod)) {
            $csCasAfu->setCasUsrCod($this->data_content->CasUsrCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasAfu->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasFunCod)) {
            $csCasAfu->setCasFunCod($this->data_content->CasFunCod);
        }
        if (isset($this->data_content->CasAfuDca)) {
            $csCasAfu->setCasAfuDca($this->data_content->CasAfuDca);
        }
        if (isset($this->data_content->CasAfuDmd)) {
            $csCasAfu->setCasAfuDmd($this->data_content->CasAfuDmd);
        }

        if ($csCasAfu->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasAfu->messages)> 0) {
                foreach ($csCasAfu->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $usr, $prg, $fun)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasAfu = $this->model('CasAfu');
        $csCasAfu->setCasPfiCod($id);
        $csCasAfu->setCasUsrCod($usr);
        $csCasAfu->setCasPrgCod($prg);
        $csCasAfu->setCasFunCod($fun);

        if ($csCasAfu->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasAfu->messages)> 0) {
                foreach ($csCasAfu->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
