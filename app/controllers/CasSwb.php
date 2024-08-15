<?php

use app\core\Controller;

class CasSwb extends Controller
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
                $csCasSwb = $this->model('CasSwb');
                $data = $csCasSwb->readAllLines();
            } else {
                $csCasSwb = $this->model('CasSwb');
                $csCasSwb->setCasSwbCod($id);
                $data = $csCasSwb->readLine();
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

        $csCasSwb = $this->model('CasSwb');

        if (isset($this->data_content->CasSwbCod)) {
            $csCasSwb->setCasSwbCod($this->data_content->CasSwbCod);
        }
        if (isset($this->data_content->CasSwbDca)) {
            $csCasSwb->setCasSwbDca($this->data_content->CasSwbDca);
        }
        if (isset($this->data_content->CasSwbDmd)) {
            $csCasSwb->setCasSwbDmd($this->data_content->CasSwbDmd);
        }
        if (isset($this->data_content->CasSwbIdy)) {
            $csCasSwb->setCasSwbIdy($this->data_content->CasSwbIdy);
        }
        if (isset($this->data_content->CasSwbBlq)) {
            $csCasSwb->setCasSwbBlq($this->data_content->CasSwbBlq);
        }
        if (isset($this->data_content->CasSwbWks)) {
            $csCasSwb->setCasSwbWks($this->data_content->CasSwbWks);
        }
        if (isset($this->data_content->CasSwbUsu)) {
            $csCasSwb->setCasSwbUsu($this->data_content->CasSwbUsu);
        }
        if (isset($this->data_content->CasSwbBrw)) {
            $csCasSwb->setCasSwbBrw($this->data_content->CasSwbBrw);
        }
        if (isset($this->data_content->CasSwbIni)) {
            $csCasSwb->setCasSwbIni($this->data_content->CasSwbIni);
        }
        if (isset($this->data_content->CasSwbFin)) {
            $csCasSwb->setCasSwbFin($this->data_content->CasSwbFin);
        }
        if (isset($this->data_content->CasSwbUsrCod)) {
            $csCasSwb->setCasSwbUsrCod($this->data_content->CasSwbUsrCod);
        }
        if (isset($this->data_content->CasSwbWksCod)) {
            $csCasSwb->setCasSwbWksCod($this->data_content->CasSwbWksCod);
        }


        if ($csCasSwb->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasSwb->messages) > 0) {
                foreach ($csCasSwb->messages as $message_item) {
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

        $csCasSwb = $this->model('CasSwb');

        if (isset($this->data_content->CasSwbCod)) {
            $csCasSwb->setCasSwbCod($this->data_content->CasSwbCod);
        }
        if (isset($this->data_content->CasSwbDca)) {
            $csCasSwb->setCasSwbDca($this->data_content->CasSwbDca);
        }
        if (isset($this->data_content->CasSwbDmd)) {
            $csCasSwb->setCasSwbDmd($this->data_content->CasSwbDmd);
        }
        if (isset($this->data_content->CasSwbIdy)) {
            $csCasSwb->setCasSwbIdy($this->data_content->CasSwbIdy);
        }
        if (isset($this->data_content->CasSwbBlq)) {
            $csCasSwb->setCasSwbBlq($this->data_content->CasSwbBlq);
        }
        if (isset($this->data_content->CasSwbWks)) {
            $csCasSwb->setCasSwbWks($this->data_content->CasSwbWks);
        }
        if (isset($this->data_content->CasSwbUsu)) {
            $csCasSwb->setCasSwbUsu($this->data_content->CasSwbUsu);
        }
        if (isset($this->data_content->CasSwbBrw)) {
            $csCasSwb->setCasSwbBrw($this->data_content->CasSwbBrw);
        }
        if (isset($this->data_content->CasSwbIni)) {
            $csCasSwb->setCasSwbIni($this->data_content->CasSwbIni);
        }
        if (isset($this->data_content->CasSwbFin)) {
            $csCasSwb->setCasSwbFin($this->data_content->CasSwbFin);
        }
        if (isset($this->data_content->CasSwbUsrCod)) {
            $csCasSwb->setCasSwbUsrCod($this->data_content->CasSwbUsrCod);
        }
        if (isset($this->data_content->CasSwbWksCod)) {
            $csCasSwb->setCasSwbWksCod($this->data_content->CasSwbWksCod);
        }

        if ($csCasSwb->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasSwb->messages) > 0) {
                foreach ($csCasSwb->messages as $message_item) {
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

        $csCasSwb = $this->model('CasSwb');
        $csCasSwb->setCasSwbCod($id);

        if ($csCasSwb->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasSwb->messages) > 0) {
                foreach ($csCasSwb->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
