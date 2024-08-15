<?php

use app\core\Controller;

class CasMnu extends Controller
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
                $csCasMnu = $this->model('CasMnu');
                $data = $csCasMnu->readAllLines();
            } else {
                $csCasMnu = $this->model('CasMnu');
                $csCasMnu->setCasMnuCod($id);
                $data = $csCasMnu->readLine();
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

        $csCasMnu = $this->model('CasMnu');

        if (isset($this->data_content->CasMnuCod)) {
            $csCasMnu->setCasMnuCod($this->data_content->CasMnuCod);
        }
        if (isset($this->data_content->CasMnuDca)) {
            $csCasMnu->setCasMnuDca($this->data_content->CasMnuDca);
        }
        if (isset($this->data_content->CasMnuDmd)) {
            $csCasMnu->setCasMnuDmd($this->data_content->CasMnuDmd);
        }
        if (isset($this->data_content->CasMnuDsc)) {
            $csCasMnu->setCasMnuDsc($this->data_content->CasMnuDsc);
        }
        if (isset($this->data_content->CasMnuBlq)) {
            $csCasMnu->setCasMnuBlq($this->data_content->CasMnuBlq);
        }
        if (isset($this->data_content->CasMnuVch)) {
            $csCasMnu->setCasMnuVch($this->data_content->CasMnuVch);
        }
        if (isset($this->data_content->CasMnuOrd)) {
            $csCasMnu->setCasMnuOrd($this->data_content->CasMnuOrd);
        }

        if ($csCasMnu->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMnu->messages) > 0) {
                foreach ($csCasMnu->messages as $message_item) {
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

        $csCasMnu = $this->model('CasMnu');

        if (isset($this->data_content->CasMnuCod)) {
            $csCasMnu->setCasMnuCod($this->data_content->CasMnuCod);
        }
        if (isset($this->data_content->CasMnuDca)) {
            $csCasMnu->setCasMnuDca($this->data_content->CasMnuDca);
        }
        if (isset($this->data_content->CasMnuDmd)) {
            $csCasMnu->setCasMnuDmd($this->data_content->CasMnuDmd);
        }
        if (isset($this->data_content->CasMnuDsc)) {
            $csCasMnu->setCasMnuDsc($this->data_content->CasMnuDsc);
        }
        if (isset($this->data_content->CasMnuBlq)) {
            $csCasMnu->setCasMnuBlq($this->data_content->CasMnuBlq);
        }
        if (isset($this->data_content->CasMnuVch)) {
            $csCasMnu->setCasMnuVch($this->data_content->CasMnuVch);
        }
        if (isset($this->data_content->CasMnuOrd)) {
            $csCasMnu->setCasMnuOrd($this->data_content->CasMnuOrd);
        }

        if ($csCasMnu->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            if (count($csCasMnu->messages) > 0) {
                foreach ($csCasMnu->messages as $message_item) {
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

        $csCasMnu = $this->model('CasMnu');
        $csCasMnu->setCasMnuCod($id);

        if ($csCasMnu->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            if (count($csCasMnu->messages) > 0) {
                foreach ($csCasMnu->messages as $message_item) {
                    array_push($messages, $message_item);
                }
            } else {
                array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
            }
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
