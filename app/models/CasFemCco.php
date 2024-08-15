<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFemCco
{
    // -- attributes -- //
    private $attCasFemCod;
    private $attCasFemCcoDca;
    private $attCasFemCcoDmd;
    private $attCasFemCcoMai;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasFemCco';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasFemCod()
    {
        return $this->attCasFemCod;
    }
    public function getCasFemCcoDca()
    {
        return $this->attCasFemCcoDca;
    }
    public function getCasFemCcoDmd()
    {
        return $this->attCasFemCcoDmd;
    }
    public function getCasFemCcoMai()
    {
        return $this->attCasFemCcoMai;
    }

    // -- set -- //
    public function setCasFemCod($inCasFemCod)
    {
        $this->attCasFemCod = $inCasFemCod;
    }
    public function setCasFemCcoDca($inCasFemCcoDca)
    {
        $this->attCasFemCcoDca = $inCasFemCcoDca;
    }
    public function setCasFemCcoDmd($inCasFemCcoDmd)
    {
        $this->attCasFemCcoDmd = $inCasFemCcoDmd;
    }
    public function setCasFemCcoMai($inCasFemCcoMai)
    {
        $this->attCasFemCcoMai = $inCasFemCcoMai;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFemCod,
            CasFemCcoDca,
            CasFemCcoDmd,
            CasFemCcoMai
        FROM
        " . $this->tbl . "
        WHERE
            1 = 1
        ";
        
        $stmt = $this->cnx->executeQuery($qry);
        $rows = array();
        
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        array_push($rows, $row);
        
        if ($stmt->rowCount() > 0) {
            return $rows;
        } else {
            return FALSE;
        }
    }
    public function readLine()
    {
        $qry = "
        SELECT
            CasFemCod,
            CasFemCcoDca,
            CasFemCcoDmd,
            CasFemCcoMai
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemCcoMai = :CasFemCcoMai
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemCcoMai" => $this->attCasFemCcoMai
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        $row = FALSE;

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $row;
    }
    public function insertLine()
    {
        if (!$this->check_duplicate_key()) {
            return FALSE;
        }
        
        $qry = "
        INSERT INTO
        " . $this->tbl . "
        (
            CasFemCod,
            CasFemCcoDca,
            CasFemCcoDmd,
            CasFemCcoMai
        )
        VALUES
        (
            :CasFemCod,
            :CasFemCcoDca,
            :CasFemCcoDmd,
            :CasFemCcoMai
        )
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemCcoDca' => $this->attCasFemCcoDca,
            ':CasFemCcoDmd' => $this->attCasFemCcoDmd,
            ':CasFemCcoMai' => $this->attCasFemCcoMai
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }
    public function updateLine()
    {
        $qry = "
        UPDATE 
        " . $this->tbl . "
        SET
            CasFemCcoDmd = :CasFemCcoDmd
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemCcoMai = :CasFemCcoMai
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemCcoDmd' => $this->attCasFemCcoDmd,
            ':CasFemCcoMai' => $this->attCasFemCcoMai
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }
    public function deleteLine()
    {
        if (!$this->check_referencial_key()) {
            return FALSE;
        }

        $qry = "
        DELETE FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemCcoMai = :CasFemCcoMai
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemCcoMai' => $this->attCasFemCcoMai
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }

    // -- other -- //
    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            CasFemCod
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemCcoMai = :CasFemCcoMai
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemCcoMai" => $this->attCasFemCcoMai
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        
        if ($rows > 0) {
            $message  = new MessageDictionary;
            array_push($this->messages, $message->getDictionaryError(1, "Messages", "Duplicate Key."));
        }

        return !boolval($rows);
    }

    private function check_referencial_key()
    {
        $rows = 0;

        if ($rows > 0) {
            $message  = new MessageDictionary;
            array_push($this->messages, $message->getDictionaryError(1, "Messages", "Referential integrity error."));
        }

        return !boolval($rows);
    }
}
