<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFpr
{
    // -- attributes -- //
    private $attCasFunCod;
    private $attCasPrgCod;
    private $attCasFprDca;
    private $attCasFprDmd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasFpr';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasFunCod()
    {
        return $this->attCasFunCod;
    }
    public function getCasPrgCod()
    {
        return $this->attCasPrgCod;
    }
    public function getCasFprDca()
    {
        return $this->attCasFprDca;
    }
    public function getCasFprDmd()
    {
        return $this->attCasFprDmd;
    }

    // -- set -- //
    public function setCasFunCod($inCasFunCod)
    {
        $this->attCasFunCod = $inCasFunCod;
    }
    public function setCasPrgCod($inCasPrgCod)
    {
        $this->attCasPrgCod = $inCasPrgCod;
    }
    public function setCasFprDca($inCasFprDca)
    {
        $this->attCasFprDca = $inCasFprDca;
    }
    public function setCasFprDmd($inCasFprDmd)
    {
        $this->attCasFprDmd = $inCasFprDmd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFunCod,
            CasPrgCod,
            CasFprDca,
            CasFprDmd
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
            CasFunCod,
            CasPrgCod,
            CasFprDca,
            CasFprDmd
        FROM
        " . $this->tbl . "
        WHERE
            CasFunCod = :CasFunCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasFunCod" => $this->attCasFunCod,
            ":CasPrgCod" => $this->attCasPrgCod
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
            CasFunCod,
            CasPrgCod,
            CasFprDca,
            CasFprDmd
        )
        VALUES
        (
            :CasFunCod,
            :CasPrgCod,
            :CasFprDca,
            :CasFprDmd
        )
        ";

        $parameters = array(
            ':CasFunCod' => $this->attCasFunCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasFprDca' => $this->attCasFprDca,
            ':CasFprDmd' => $this->attCasFprDmd
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
            CasFprDmd = :CasFprDmd
        WHERE
            CasFunCod = :CasFunCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasFunCod' => $this->attCasFunCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasFprDmd' => $this->attCasFprDmd
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
            CasFunCod = :CasFunCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasFunCod' => $this->attCasFunCod,
            ':CasPrgCod' => $this->attCasPrgCod
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
            CasFunCod
        FROM
        " . $this->tbl . "
        WHERE
            CasFunCod = :CasFunCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasFunCod" => $this->attCasFunCod,
            ":CasPrgCod" => $this->attCasPrgCod
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
