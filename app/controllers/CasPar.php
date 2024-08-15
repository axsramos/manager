<?php

use app\core\Controller;

class CasPar extends Controller
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
                $csCasPar = $this->model('CasPar');
                $data = $csCasPar->readAllLines();
            } else {
                $csCasPar = $this->model('CasPar');
                $csCasPar->setCasParCod($id);
                $data = $csCasPar->readLine();
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

        $csCasPar = $this->model('CasPar');

        if (isset($this->data_content->CasParCod)) {
            $csCasPar->setCasParCod($this->data_content->CasParCod);
        }
        if (isset($this->data_content->CasParDca)) {
            $csCasPar->setCasParDca($this->data_content->CasParDca);
        }
        if (isset($this->data_content->CasParDmd)) {
            $csCasPar->setCasParDmd($this->data_content->CasParDmd);
        }
        if (isset($this->data_content->CasParDsc)) {
            $csCasPar->setCasParDsc($this->data_content->CasParDsc);
        }
        if (isset($this->data_content->CasParBlq)) {
            $csCasPar->setCasParBlq($this->data_content->CasParBlq);
        }
        if (isset($this->data_content->CasParSeq)) {
            $csCasPar->setCasParSeq($this->data_content->CasParSeq);
        }
        if (isset($this->data_content->CasParInt)) {
            $csCasPar->setCasParInt($this->data_content->CasParInt);
        }
        if (isset($this->data_content->CasParDec)) {
            $csCasPar->setCasParDec($this->data_content->CasParDec);
        }
        if (isset($this->data_content->CasParSep)) {
            $csCasPar->setCasParSep($this->data_content->CasParSep);
        }
        if (isset($this->data_content->CasParVch)) {
            $csCasPar->setCasParVch($this->data_content->CasParVch);
        }

        if ($csCasPar->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPar->messages)> 0) {
                foreach ($csCasPar->messages as $message_item) {
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

        $csCasPar = $this->model('CasPar');

        if (isset($this->data_content->CasParCod)) {
            $csCasPar->setCasParCod($this->data_content->CasParCod);
        }
        if (isset($this->data_content->CasParDca)) {
            $csCasPar->setCasParDca($this->data_content->CasParDca);
        }
        if (isset($this->data_content->CasParDmd)) {
            $csCasPar->setCasParDmd($this->data_content->CasParDmd);
        }
        if (isset($this->data_content->CasParDsc)) {
            $csCasPar->setCasParDsc($this->data_content->CasParDsc);
        }
        if (isset($this->data_content->CasParBlq)) {
            $csCasPar->setCasParBlq($this->data_content->CasParBlq);
        }
        if (isset($this->data_content->CasParSeq)) {
            $csCasPar->setCasParSeq($this->data_content->CasParSeq);
        }
        if (isset($this->data_content->CasParInt)) {
            $csCasPar->setCasParInt($this->data_content->CasParInt);
        }
        if (isset($this->data_content->CasParDec)) {
            $csCasPar->setCasParDec($this->data_content->CasParDec);
        }
        if (isset($this->data_content->CasParSep)) {
            $csCasPar->setCasParSep($this->data_content->CasParSep);
        }
        if (isset($this->data_content->CasParVch)) {
            $csCasPar->setCasParVch($this->data_content->CasParVch);
        }

        if ($csCasPar->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasPar->messages)> 0) {
                foreach ($csCasPar->messages as $message_item) {
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

        $csCasPar = $this->model('CasPar');
        $csCasPar->setCasParCod($id);

        if ($csCasPar->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasPar->messages)> 0) {
                foreach ($csCasPar->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
