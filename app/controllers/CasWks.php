<?php

use app\core\Controller;

class CasWks extends Controller
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
                $csCasWks = $this->model('CasWks');
                $data = $csCasWks->readAllLines();
            } else {
                $csCasWks = $this->model('CasWks');
                $csCasWks->setCasWksCod($id);
                $data = $csCasWks->readLine();
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

        $csCasWks = $this->model('CasWks');

        if (isset($this->data_content->CasWksCod)) {
            $csCasWks->setCasWksCod($this->data_content->CasWksCod);
        }
        if (isset($this->data_content->CasWksDca)) {
            $csCasWks->setCasWksDca($this->data_content->CasWksDca);
        }
        if (isset($this->data_content->CasWksDmd)) {
            $csCasWks->setCasWksDmd($this->data_content->CasWksDmd);
        }
        if (isset($this->data_content->CasWksDsc)) {
            $csCasWks->setCasWksDsc($this->data_content->CasWksDsc);
        }
        if (isset($this->data_content->CasWksBlq)) {
            $csCasWks->setCasWksBlq($this->data_content->CasWksBlq);
        }
        if (isset($this->data_content->CasWksMac)) {
            $csCasWks->setCasWksMac($this->data_content->CasWksMac);
        }
        if (isset($this->data_content->CasWksEip)) {
            $csCasWks->setCasWksEip($this->data_content->CasWksEip);
        }
        if (isset($this->data_content->CasWksChv)) {
            $csCasWks->setCasWksChv($this->data_content->CasWksChv);
        }


        if ($csCasWks->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasWks->messages) > 0) {
                foreach ($csCasWks->messages as $message_item) {
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

        $csCasWks = $this->model('CasWks');

        if (isset($this->data_content->CasWksCod)) {
            $csCasWks->setCasWksCod($this->data_content->CasWksCod);
        }
        if (isset($this->data_content->CasWksDca)) {
            $csCasWks->setCasWksDca($this->data_content->CasWksDca);
        }
        if (isset($this->data_content->CasWksDmd)) {
            $csCasWks->setCasWksDmd($this->data_content->CasWksDmd);
        }
        if (isset($this->data_content->CasWksDsc)) {
            $csCasWks->setCasWksDsc($this->data_content->CasWksDsc);
        }
        if (isset($this->data_content->CasWksBlq)) {
            $csCasWks->setCasWksBlq($this->data_content->CasWksBlq);
        }
        if (isset($this->data_content->CasWksMac)) {
            $csCasWks->setCasWksMac($this->data_content->CasWksMac);
        }
        if (isset($this->data_content->CasWksEip)) {
            $csCasWks->setCasWksEip($this->data_content->CasWksEip);
        }
        if (isset($this->data_content->CasWksChv)) {
            $csCasWks->setCasWksChv($this->data_content->CasWksChv);
        }

        if ($csCasWks->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasWks->messages) > 0) {
                foreach ($csCasWks->messages as $message_item) {
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

        $csCasWks = $this->model('CasWks');
        $csCasWks->setCasWksCod($id);

        if ($csCasWks->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasWks->messages) > 0) {
                foreach ($csCasWks->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
