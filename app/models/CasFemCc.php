<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFemCc
{
    // -- attributes -- //
    private $attCasFemCod;
    private $attCasFemCcDca;
    private $attCasFemCcDmd;
    private $attCasFemCcMai;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasFemCc';

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
    public function getCasFemCcDca()
    {
        return $this->attCasFemCcDca;
    }
    public function getCasFemCcDmd()
    {
        return $this->attCasFemCcDmd;
    }
    public function getCasFemCcMai()
    {
        return $this->attCasFemCcMai;
    }

    // -- set -- //
    public function setCasFemCod($inCasFemCod)
    {
        $this->attCasFemCod = $inCasFemCod;
    }
    public function setCasFemCcDca($inCasFemCcDca)
    {
        $this->attCasFemCcDca = $inCasFemCcDca;
    }
    public function setCasFemCcDmd($inCasFemCcDmd)
    {
        $this->attCasFemCcDmd = $inCasFemCcDmd;
    }
    public function setCasFemCcMai($inCasFemCcMai)
    {
        $this->attCasFemCcMai = $inCasFemCcMai;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFemCod,
            CasFemCcDca,
            CasFemCcDmd,
            CasFemCcMai
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
            CasFemCcDca,
            CasFemCcDmd,
            CasFemCcMai
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemCcMai = :CasFemCcMai
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemCcMai" => $this->attCasFemCcMai
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
            CasFemCcDca,
            CasFemCcDmd,
            CasFemCcMai
        )
        VALUES
        (
            :CasFemCod,
            :CasFemCcDca,
            :CasFemCcDmd,
            :CasFemCcMai
        )
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemCcDca' => $this->attCasFemCcDca,
            ':CasFemCcDmd' => $this->attCasFemCcDmd,
            ':CasFemCcMai' => $this->attCasFemCcMai
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
            CasFemCcDmd = :CasFemCcDmd
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemCcMai = :CasFemCcMai
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemCcDmd' => $this->attCasFemCcDmd,
            ':CasFemCcMai' => $this->attCasFemCcMai
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
        AND CasFemCcMai = :CasFemCcMai
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemCcMai' => $this->attCasFemCcMai
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
        AND CasFemCcMai = :CasFemCcMai
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemCcMai" => $this->attCasFemCcMai
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
