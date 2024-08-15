<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasPrg
{
    // -- attributes -- //
    private $attCasPrgCod;
    private $attCasPrgDca;
    private $attCasPrgDmd;
    private $attCasPrgDsc;
    private $attCasPrgBlq;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasPrg';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasPrgCod()
    {
        return $this->attCasPrgCod;
    }
    public function getCasPrgDca()
    {
        return $this->attCasPrgDca;
    }
    public function getCasPrgDmd()
    {
        return $this->attCasPrgDmd;
    }
    public function getCasPrgDsc()
    {
        return $this->attCasPrgDsc;
    }
    public function getCasPrgBlq()
    {
        return $this->attCasPrgBlq;
    }

    // -- set -- //
    public function setCasPrgCod($inCasPrgCod)
    {
        $this->attCasPrgCod = $inCasPrgCod;
    }
    public function setCasPrgDca($inCasPrgDca)
    {
        $this->attCasPrgDca = $inCasPrgDca;
    }
    public function setCasPrgDmd($inCasPrgDmd)
    {
        $this->attCasPrgDmd = $inCasPrgDmd;
    }
    public function setCasPrgDsc($inCasPrgDsc)
    {
        $this->attCasPrgDsc = $inCasPrgDsc;
    }
    public function setCasPrgBlq($inCasPrgBlq)
    {
        $this->attCasPrgBlq = $inCasPrgBlq;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasPrgCod,
            CasPrgDca,
            CasPrgDmd,
            CasPrgDsc,
            CasPrgBlq
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
            CasPrgCod,
            CasPrgDca,
            CasPrgDmd,
            CasPrgDsc,
            CasPrgBlq
        FROM
        " . $this->tbl . "
        WHERE
            CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
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
            CasPrgCod,
            CasPrgDca,
            CasPrgDmd,
            CasPrgDsc,
            CasPrgBlq
        )
        VALUES
        (
            :CasPrgCod,
            :CasPrgDca,
            :CasPrgDmd,
            :CasPrgDsc,
            :CasPrgBlq
        )
        ";

        $parameters = array(
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasPrgDca' => $this->attCasPrgDca,
            ':CasPrgDmd' => $this->attCasPrgDmd,
            ':CasPrgDsc' => $this->attCasPrgDsc,
            ':CasPrgBlq' => $this->attCasPrgBlq
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
            CasPrgDmd = :CasPrgDmd,
            CasPrgDsc = :CasPrgDsc,
            CasPrgBlq = :CasPrgBlq
        WHERE
            CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasPrgDmd' => $this->attCasPrgDmd,
            ':CasPrgDsc' => $this->attCasPrgDsc,
            ':CasPrgBlq' => $this->attCasPrgBlq
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
            CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
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
            CasPrgCod
        FROM
        " . $this->tbl . "
        WHERE
            CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
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
