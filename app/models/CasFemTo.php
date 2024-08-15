<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFemTo
{
    // -- attributes -- //
    private $attCasFemCod;
    private $attCasFemToDca;
    private $attCasFemToDmd;
    private $attCasFemToMai;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasFemTo';

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
    public function getCasFemToDca()
    {
        return $this->attCasFemToDca;
    }
    public function getCasFemToDmd()
    {
        return $this->attCasFemToDmd;
    }
    public function getCasFemToMai()
    {
        return $this->attCasFemToMai;
    }

    // -- set -- //
    public function setCasFemCod($inCasFemCod)
    {
        $this->attCasFemCod = $inCasFemCod;
    }
    public function setCasFemToDca($inCasFemToDca)
    {
        $this->attCasFemToDca = $inCasFemToDca;
    }
    public function setCasFemToDmd($inCasFemToDmd)
    {
        $this->attCasFemToDmd = $inCasFemToDmd;
    }
    public function setCasFemToMai($inCasFemToMai)
    {
        $this->attCasFemToMai = $inCasFemToMai;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFemCod,
            CasFemToDca,
            CasFemToDmd,
            CasFemToMai
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
            CasFemToDca,
            CasFemToDmd,
            CasFemToMai
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemToMai = :CasFemToMai
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemToMai" => $this->attCasFemToMai
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
            CasFemToDca,
            CasFemToDmd,
            CasFemToMai
        )
        VALUES
        (
            :CasFemCod,
            :CasFemToDca,
            :CasFemToDmd,
            :CasFemToMai
        )
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemToDca' => $this->attCasFemToDca,
            ':CasFemToDmd' => $this->attCasFemToDmd,
            ':CasFemToMai' => $this->attCasFemToMai
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
            CasFemToDmd = :CasFemToDmd
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemToMai = :CasFemToMai
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemToDmd' => $this->attCasFemToDmd,
            ':CasFemToMai' => $this->attCasFemToMai
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
        AND CasFemToMai = :CasFemToMai
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemToMai' => $this->attCasFemToMai
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
        AND CasFemToMai = :CasFemToMai
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemToMai" => $this->attCasFemToMai
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
