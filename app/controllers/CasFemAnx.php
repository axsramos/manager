<?php

use app\core\Controller;

class CasFemAnx extends Controller
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

    public function id($id = null, $anx = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $anx == null) {
                $csCasFemAnx = $this->model('CasFemAnx');
                $data = $csCasFemAnx->readAllLines();
            } else {
                $csCasFemAnx = $this->model('CasFemAnx');
                $csCasFemAnx->setCasFemCod($id);
                $csCasFemAnx->setCasFemAnxCod($anx);
                $data = $csCasFemAnx->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $anx);
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

        $csCasFemAnx = $this->model('CasFemAnx');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemAnx->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemAnxCod)) {
            $csCasFemAnx->setCasFemAnxCod($this->data_content->CasFemAnxCod);
        }
        if (isset($this->data_content->CasFemAnxDca)) {
            $csCasFemAnx->setCasFemAnxDca($this->data_content->CasFemAnxDca);
        }
        if (isset($this->data_content->CasFemAnxDmd)) {
            $csCasFemAnx->setCasFemAnxDmd($this->data_content->CasFemAnxDmd);
        }
        if (isset($this->data_content->CasFemAnxDsc)) {
            $csCasFemAnx->setCasFemAnxDsc($this->data_content->CasFemAnxDsc);
        }
        if (isset($this->data_content->CasFemAnxDir)) {
            $csCasFemAnx->setCasFemAnxDir($this->data_content->CasFemAnxDir);
        }
        if (isset($this->data_content->CasFemAnxNme)) {
            $csCasFemAnx->setCasFemAnxNme($this->data_content->CasFemAnxNme);
        }
        if (isset($this->data_content->CasFemAnxExt)) {
            $csCasFemAnx->setCasFemAnxExt($this->data_content->CasFemAnxExt);
        }
        if (isset($this->data_content->CasFemAnxSze)) {
            $csCasFemAnx->setCasFemAnxSze($this->data_content->CasFemAnxSze);
        }

        if ($csCasFemAnx->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemAnx->messages) > 0) {
                foreach ($csCasFemAnx->messages as $message_item) {
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

        $csCasFemAnx = $this->model('CasFemAnx');

        if (isset($this->data_content->CasFemCod)) {
            $csCasFemAnx->setCasFemCod($this->data_content->CasFemCod);
        }
        if (isset($this->data_content->CasFemAnxCod)) {
            $csCasFemAnx->setCasFemAnxCod($this->data_content->CasFemAnxCod);
        }
        if (isset($this->data_content->CasFemAnxDca)) {
            $csCasFemAnx->setCasFemAnxDca($this->data_content->CasFemAnxDca);
        }
        if (isset($this->data_content->CasFemAnxDmd)) {
            $csCasFemAnx->setCasFemAnxDmd($this->data_content->CasFemAnxDmd);
        }
        if (isset($this->data_content->CasFemAnxDsc)) {
            $csCasFemAnx->setCasFemAnxDsc($this->data_content->CasFemAnxDsc);
        }
        if (isset($this->data_content->CasFemAnxDir)) {
            $csCasFemAnx->setCasFemAnxDir($this->data_content->CasFemAnxDir);
        }
        if (isset($this->data_content->CasFemAnxNme)) {
            $csCasFemAnx->setCasFemAnxNme($this->data_content->CasFemAnxNme);
        }
        if (isset($this->data_content->CasFemAnxExt)) {
            $csCasFemAnx->setCasFemAnxExt($this->data_content->CasFemAnxExt);
        }
        if (isset($this->data_content->CasFemAnxSze)) {
            $csCasFemAnx->setCasFemAnxSze($this->data_content->CasFemAnxSze);
        }

        if ($csCasFemAnx->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasFemAnx->messages) > 0) {
                foreach ($csCasFemAnx->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $anx)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasFemAnx = $this->model('CasFemAnx');
        $csCasFemAnx->setCasFemCod($id);
        $csCasFemAnx->setCasFemAnxCod($anx);

        if ($csCasFemAnx->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasFemAnx->messages) > 0) {
                foreach ($csCasFemAnx->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
