<?php

use app\core\Controller;

class CasCvt extends Controller
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
                $csCasCvt = $this->model('CasCvt');
                $data = $csCasCvt->readAllLines();
            } else {
                $csCasCvt = $this->model('CasCvt');
                $csCasCvt->setCasCvtCod($id);
                $data = $csCasCvt->readLine();
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

        $csCasCvt = $this->model('CasCvt');

        if (isset($this->data_content->CasCvtCod)) {
            $csCasCvt->setCasCvtCod($this->data_content->CasCvtCod);
        }
        if (isset($this->data_content->CasCvtDca)) {
            $csCasCvt->setCasCvtDca($this->data_content->CasCvtDca);
        }
        if (isset($this->data_content->CasCvtDmd)) {
            $csCasCvt->setCasCvtDmd($this->data_content->CasCvtDmd);
        }
        if (isset($this->data_content->CasCvtNme)) {
            $csCasCvt->setCasCvtNme($this->data_content->CasCvtNme);
        }
        if (isset($this->data_content->CasCvtLgn)) {
            $csCasCvt->setCasCvtLgn($this->data_content->CasCvtLgn);
        }
        if (isset($this->data_content->CasCvtPar)) {
            $csCasCvt->setCasCvtPar($this->data_content->CasCvtPar);
        }
        if (isset($this->data_content->CasCvtLnk)) {
            $csCasCvt->setCasCvtLnk($this->data_content->CasCvtLnk);
        }
        if (isset($this->data_content->CasCvtBlq)) {
            $csCasCvt->setCasCvtBlq($this->data_content->CasCvtBlq);
        }
        if (isset($this->data_content->CasCvtBlqDtt)) {
            $csCasCvt->setCasCvtBlqDtt($this->data_content->CasCvtBlqDtt);
        }
        if (isset($this->data_content->CasCvtEnv)) {
            $csCasCvt->setCasCvtEnv($this->data_content->CasCvtEnv);
        }
        if (isset($this->data_content->CasCvtEnvDtt)) {
            $csCasCvt->setCasCvtEnvDtt($this->data_content->CasCvtEnvDtt);
        }
        if (isset($this->data_content->CasCvtCnf)) {
            $csCasCvt->setCasCvtCnf($this->data_content->CasCvtCnf);
        }
        if (isset($this->data_content->CasCvtCnfDtt)) {
            $csCasCvt->setCasCvtCnfDtt($this->data_content->CasCvtCnfDtt);
        }
        if (isset($this->data_content->CasCvtChv)) {
            $csCasCvt->setCasCvtChv($this->data_content->CasCvtChv);
        }

        if ($csCasCvt->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasCvt->messages) > 0) {
                foreach ($csCasCvt->messages as $message_item) {
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

        $csCasCvt = $this->model('CasCvt');

        if (isset($this->data_content->CasCvtCod)) {
            $csCasCvt->setCasCvtCod($this->data_content->CasCvtCod);
        }
        if (isset($this->data_content->CasCvtDca)) {
            $csCasCvt->setCasCvtDca($this->data_content->CasCvtDca);
        }
        if (isset($this->data_content->CasCvtDmd)) {
            $csCasCvt->setCasCvtDmd($this->data_content->CasCvtDmd);
        }
        if (isset($this->data_content->CasCvtNme)) {
            $csCasCvt->setCasCvtNme($this->data_content->CasCvtNme);
        }
        if (isset($this->data_content->CasCvtLgn)) {
            $csCasCvt->setCasCvtLgn($this->data_content->CasCvtLgn);
        }
        if (isset($this->data_content->CasCvtPar)) {
            $csCasCvt->setCasCvtPar($this->data_content->CasCvtPar);
        }
        if (isset($this->data_content->CasCvtLnk)) {
            $csCasCvt->setCasCvtLnk($this->data_content->CasCvtLnk);
        }
        if (isset($this->data_content->CasCvtBlq)) {
            $csCasCvt->setCasCvtBlq($this->data_content->CasCvtBlq);
        }
        if (isset($this->data_content->CasCvtBlqDtt)) {
            $csCasCvt->setCasCvtBlqDtt($this->data_content->CasCvtBlqDtt);
        }
        if (isset($this->data_content->CasCvtEnv)) {
            $csCasCvt->setCasCvtEnv($this->data_content->CasCvtEnv);
        }
        if (isset($this->data_content->CasCvtEnvDtt)) {
            $csCasCvt->setCasCvtEnvDtt($this->data_content->CasCvtEnvDtt);
        }
        if (isset($this->data_content->CasCvtCnf)) {
            $csCasCvt->setCasCvtCnf($this->data_content->CasCvtCnf);
        }
        if (isset($this->data_content->CasCvtCnfDtt)) {
            $csCasCvt->setCasCvtCnfDtt($this->data_content->CasCvtCnfDtt);
        }
        if (isset($this->data_content->CasCvtChv)) {
            $csCasCvt->setCasCvtChv($this->data_content->CasCvtChv);
        }

        if ($csCasCvt->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasCvt->messages) > 0) {
                foreach ($csCasCvt->messages as $message_item) {
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

        $csCasCvt = $this->model('CasCvt');
        $csCasCvt->setCasCvtCod($id);

        if ($csCasCvt->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasCvt->messages) > 0) {
                foreach ($csCasCvt->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
