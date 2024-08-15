<?php

use app\core\Controller;

class CasMna extends Controller
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

    public function id($id = null, $mna = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($id == null || $mna == null) {
                $csCasMna = $this->model('CasMna');
                $data = $csCasMna->readAllLines();
            } else {
                $csCasMna = $this->model('CasMna');
                $csCasMna->setCasMnuCod($id);
                $csCasMna->setCasMnaCod($mna);
                $data = $csCasMna->readLine();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id, $mna);
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

        $csCasMna = $this->model('CasMna');

        if (isset($this->data_content->CasMnuCod)) {
            $csCasMna->setCasMnuCod($this->data_content->CasMnuCod);
        }
        if (isset($this->data_content->CasMnaCod)) {
            $csCasMna->setCasMnaCod($this->data_content->CasMnaCod);
        }
        if (isset($this->data_content->CasMnaDca)) {
            $csCasMna->setCasMnaDca($this->data_content->CasMnaDca);
        }
        if (isset($this->data_content->CasMnaDmd)) {
            $csCasMna->setCasMnaDmd($this->data_content->CasMnaDmd);
        }
        if (isset($this->data_content->CasMnaDsc)) {
            $csCasMna->setCasMnaDsc($this->data_content->CasMnaDsc);
        }
        if (isset($this->data_content->CasMnaBlq)) {
            $csCasMna->setCasMnaBlq($this->data_content->CasMnaBlq);
        }
        if (isset($this->data_content->CasMnaLnk)) {
            $csCasMna->setCasMnaLnk($this->data_content->CasMnaLnk);
        }
        if (isset($this->data_content->CasMnaOrd)) {
            $csCasMna->setCasMnaOrd($this->data_content->CasMnaOrd);
        }
        if (isset($this->data_content->CasMnaGrp)) {
            $csCasMna->setCasMnaGrp($this->data_content->CasMnaGrp);
        }

        if ($csCasMna->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMna->messages) > 0) {
                foreach ($csCasMna->messages as $message_item) {
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

        $csCasMna = $this->model('CasMna');

        if (isset($this->data_content->CasMnuCod)) {
            $csCasMna->setCasMnuCod($this->data_content->CasMnuCod);
        }
        if (isset($this->data_content->CasMnaCod)) {
            $csCasMna->setCasMnaCod($this->data_content->CasMnaCod);
        }
        if (isset($this->data_content->CasMnaDca)) {
            $csCasMna->setCasMnaDca($this->data_content->CasMnaDca);
        }
        if (isset($this->data_content->CasMnaDmd)) {
            $csCasMna->setCasMnaDmd($this->data_content->CasMnaDmd);
        }
        if (isset($this->data_content->CasMnaDsc)) {
            $csCasMna->setCasMnaDsc($this->data_content->CasMnaDsc);
        }
        if (isset($this->data_content->CasMnaBlq)) {
            $csCasMna->setCasMnaBlq($this->data_content->CasMnaBlq);
        }
        if (isset($this->data_content->CasMnaLnk)) {
            $csCasMna->setCasMnaLnk($this->data_content->CasMnaLnk);
        }
        if (isset($this->data_content->CasMnaOrd)) {
            $csCasMna->setCasMnaOrd($this->data_content->CasMnaOrd);
        }
        if (isset($this->data_content->CasMnaGrp)) {
            $csCasMna->setCasMnaGrp($this->data_content->CasMnaGrp);
        }

        if ($csCasMna->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMna->messages) > 0) {
                foreach ($csCasMna->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id, $mna)
    {
        $message  = new MessageDictionary;
        $messages = array();

        http_response_code(200);

        $csCasMna = $this->model('CasMna');
        $csCasMna->setCasMnuCod($id);
        $csCasMna->setCasMnaCod($mna);

        if ($csCasMna->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasMna->messages) > 0) {
                foreach ($csCasMna->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
