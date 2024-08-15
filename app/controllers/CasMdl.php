<?php

use app\core\Controller;

class CasMdl extends Controller
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
                $csCasMdl = $this->model('CasMdl');
                $data = $csCasMdl->readAllLines();
            } else {
                $csCasMdl = $this->model('CasMdl');
                $csCasMdl->setCasMdlCod($id);
                $data = $csCasMdl->readLine();
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

        $csCasMdl = $this->model('CasMdl');

        if (isset($this->data_content->CasMdlCod)) {
            $csCasMdl->setCasMdlCod($this->data_content->CasMdlCod);
        }
        if (isset($this->data_content->CasMdlDca)) {
            $csCasMdl->setCasMdlDca($this->data_content->CasMdlDca);
        }
        if (isset($this->data_content->CasMdlDmd)) {
            $csCasMdl->setCasMdlDmd($this->data_content->CasMdlDmd);
        }
        if (isset($this->data_content->CasMdlDsc)) {
            $csCasMdl->setCasMdlDsc($this->data_content->CasMdlDsc);
        }
        if (isset($this->data_content->CasMdlBlq)) {
            $csCasMdl->setCasMdlBlq($this->data_content->CasMdlBlq);
        }

        if ($csCasMdl->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMdl->messages)> 0) {
                foreach ($csCasMdl->messages as $message_item) {
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

        $csCasMdl = $this->model('CasMdl');

        if (isset($this->data_content->CasMdlCod)) {
            $csCasMdl->setCasMdlCod($this->data_content->CasMdlCod);
        }
        if (isset($this->data_content->CasMdlDca)) {
            $csCasMdl->setCasMdlDca($this->data_content->CasMdlDca);
        }
        if (isset($this->data_content->CasMdlDmd)) {
            $csCasMdl->setCasMdlDmd($this->data_content->CasMdlDmd);
        }
        if (isset($this->data_content->CasMdlDsc)) {
            $csCasMdl->setCasMdlDsc($this->data_content->CasMdlDsc);
        }
        if (isset($this->data_content->CasMdlBlq)) {
            $csCasMdl->setCasMdlBlq($this->data_content->CasMdlBlq);
        }

        if ($csCasMdl->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMdl->messages)> 0) {
                foreach ($csCasMdl->messages as $message_item) {
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

        $csCasMdl = $this->model('CasMdl');
        $csCasMdl->setCasMdlCod($id);

        if ($csCasMdl->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasMdl->messages)> 0) {
                foreach ($csCasMdl->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
