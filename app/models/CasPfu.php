<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasPfu
{
    // -- attributes -- //
    private $attCasPfiCod;
    private $attCasUsrCod;
    private $attCasPfuDca;
    private $attCasPfuDmd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasPfu';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasPfiCod()
    {
        return $this->attCasPfiCod;
    }
    public function getCasUsrCod()
    {
        return $this->attCasUsrCod;
    }
    public function getCasPfuDca()
    {
        return $this->attCasPfuDca;
    }
    public function getCasPfuDmd()
    {
        return $this->attCasPfuDmd;
    }

    // -- set -- //
    public function setCasPfiCod($inCasPfiCod)
    {
        $this->attCasPfiCod = $inCasPfiCod;
    }
    public function setCasUsrCod($inCasUsrCod)
    {
        $this->attCasUsrCod = $inCasUsrCod;
    }
    public function setCasPfuDca($inCasPfuDca)
    {
        $this->attCasPfuDca = $inCasPfuDca;
    }
    public function setCasPfuDmd($inCasPfuDmd)
    {
        $this->attCasPfuDmd = $inCasPfuDmd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasPfiCod,
            CasUsrCod,
            CasPfuDca,
            CasPfuDmd
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
            CasPfiCod,
            CasUsrCod,
            CasPfuDca,
            CasPfuDmd
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod,
            ":CasUsrCod" => $this->attCasUsrCod
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
            CasPfiCod,
            CasUsrCod,
            CasPfuDca,
            CasPfuDmd
        )
        VALUES
        (
            :CasPfiCod,
            :CasUsrCod,
            :CasPfuDca,
            :CasPfuDmd
        )
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPfuDca' => $this->attCasPfuDca,
            ':CasPfuDmd' => $this->attCasPfuDmd
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
            CasPfuDmd = :CasPfuDmd
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPfuDmd' => $this->attCasPfuDmd
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
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod
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
            CasPfiCod,
            CasUsrCod
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod,
            ":CasUsrCod" => $this->attCasUsrCod
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
