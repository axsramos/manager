<?php

use app\core\Controller;

class CasMpr extends Controller
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
                $csCasMpr = $this->model('CasMpr');
                $data = $csCasMpr->readAllLines();
            } else {
                $csCasMpr = $this->model('CasMpr');
                $csCasMpr->setCasMdlCod($id);
                $csCasMpr->setCasPrgCod($prg);
                $data = $csCasMpr->readLine();
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

        $csCasMpr = $this->model('CasMpr');

        if (isset($this->data_content->CasMdlCod)) {
            $csCasMpr->setCasMdlCod($this->data_content->CasMdlCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasMpr->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasMprDca)) {
            $csCasMpr->setCasMprDca($this->data_content->CasMprDca);
        }
        if (isset($this->data_content->CasMprDmd)) {
            $csCasMpr->setCasMprDmd($this->data_content->CasMprDmd);
        }

        if ($csCasMpr->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMpr->messages)> 0) {
                foreach ($csCasMpr->messages as $message_item) {
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

        $csCasMpr = $this->model('CasMpr');

        if (isset($this->data_content->CasMdlCod)) {
            $csCasMpr->setCasMdlCod($this->data_content->CasMdlCod);
        }
        if (isset($this->data_content->CasPrgCod)) {
            $csCasMpr->setCasPrgCod($this->data_content->CasPrgCod);
        }
        if (isset($this->data_content->CasMprDca)) {
            $csCasMpr->setCasMprDca($this->data_content->CasMprDca);
        }
        if (isset($this->data_content->CasMprDmd)) {
            $csCasMpr->setCasMprDmd($this->data_content->CasMprDmd);
        }

        if ($csCasMpr->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMpr->messages)> 0) {
                foreach ($csCasMpr->messages as $message_item) {
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

        $csCasMpr = $this->model('CasMpr');
        $csCasMpr->setCasMdlCod($id);
        $csCasMpr->setCasPrgCod($prg);

        if ($csCasMpr->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasMpr->messages)> 0) {
                foreach ($csCasMpr->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
