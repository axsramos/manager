<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasPfi
{
    // -- attributes -- //
    private $attCasPfiCod;
    private $attCasPfiDca;
    private $attCasPfiDmd;
    private $attCasPfiDsc;
    private $attCasPfiBlq;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasPfi';

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
    public function getCasPfiDca()
    {
        return $this->attCasPfiDca;
    }
    public function getCasPfiDmd()
    {
        return $this->attCasPfiDmd;
    }
    public function getCasPfiDsc()
    {
        return $this->attCasPfiDsc;
    }
    public function getCasPfiBlq()
    {
        return $this->attCasPfiBlq;
    }

    // -- set -- //
    public function setCasPfiCod($inCasPfiCod)
    {
        $this->attCasPfiCod = $inCasPfiCod;
    }
    public function setCasPfiDca($inCasPfiDca)
    {
        $this->attCasPfiDca = $inCasPfiDca;
    }
    public function setCasPfiDmd($inCasPfiDmd)
    {
        $this->attCasPfiDmd = $inCasPfiDmd;
    }
    public function setCasPfiDsc($inCasPfiDsc)
    {
        $this->attCasPfiDsc = $inCasPfiDsc;
    }
    public function setCasPfiBlq($inCasPfiBlq)
    {
        $this->attCasPfiBlq = $inCasPfiBlq;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasPfiCod,
            CasPfiDca,
            CasPfiDmd,
            CasPfiDsc,
            CasPfiBlq
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
            CasPfiDca,
            CasPfiDmd,
            CasPfiDsc,
            CasPfiBlq
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod
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
            CasPfiDca,
            CasPfiDmd,
            CasPfiDsc,
            CasPfiBlq
        )
        VALUES
        (
            :CasPfiCod,
            :CasPfiDca,
            :CasPfiDmd,
            :CasPfiDsc,
            :CasPfiBlq
        )
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasPfiDca' => $this->attCasPfiDca,
            ':CasPfiDmd' => $this->attCasPfiDmd,
            ':CasPfiDsc' => $this->attCasPfiDsc,
            ':CasPfiBlq' => $this->attCasPfiBlq
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
            CasPfiDmd = :CasPfiDmd,
            CasPfiDsc = :CasPfiDsc,
            CasPfiBlq = :CasPfiBlq
        WHERE
            CasPfiCod = :CasPfiCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasPfiDmd' => $this->attCasPfiDmd,
            ':CasPfiDsc' => $this->attCasPfiDsc,
            ':CasPfiBlq' => $this->attCasPfiBlq
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
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod
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
            CasPfiCod
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod
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
