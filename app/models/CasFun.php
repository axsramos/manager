<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFun
{
    // -- attributes -- //
    private $attCasFunCod;
    private $attCasFunDca;
    private $attCasFunDmd;
    private $attCasFunDsc;
    private $attCasFunBlq;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasFun';

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
    public function getCasFunDca()
    {
        return $this->attCasFunDca;
    }
    public function getCasFunDmd()
    {
        return $this->attCasFunDmd;
    }
    public function getCasFunDsc()
    {
        return $this->attCasFunDsc;
    }
    public function getCasFunBlq()
    {
        return $this->attCasFunBlq;
    }

    // -- set -- //
    public function setCasFunCod($inCasFunCod)
    {
        $this->attCasFunCod = $inCasFunCod;
    }
    public function setCasFunDca($inCasFunDca)
    {
        $this->attCasFunDca = $inCasFunDca;
    }
    public function setCasFunDmd($inCasFunDmd)
    {
        $this->attCasFunDmd = $inCasFunDmd;
    }
    public function setCasFunDsc($inCasFunDsc)
    {
        $this->attCasFunDsc = $inCasFunDsc;
    }
    public function setCasFunBlq($inCasFunBlq)
    {
        $this->attCasFunBlq = $inCasFunBlq;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFunCod,
            CasFunDca,
            CasFunDmd,
            CasFunDsc,
            CasFunBlq
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
            CasFunDca,
            CasFunDmd,
            CasFunDsc,
            CasFunBlq
        FROM
        " . $this->tbl . "
        WHERE
            CasFunCod = :CasFunCod
        ";

        $parameters = array(
            ":CasFunCod" => $this->attCasFunCod
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
            CasFunDca,
            CasFunDmd,
            CasFunDsc,
            CasFunBlq
        )
        VALUES
        (
            :CasFunCod,
            :CasFunDca,
            :CasFunDmd,
            :CasFunDsc,
            :CasFunBlq
        )
        ";

        $parameters = array(
            ':CasFunCod' => $this->attCasFunCod,
            ':CasFunDca' => $this->attCasFunDca,
            ':CasFunDmd' => $this->attCasFunDmd,
            ':CasFunDsc' => $this->attCasFunDsc,
            ':CasFunBlq' => $this->attCasFunBlq
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
            CasFunDmd = :CasFunDmd,
            CasFunDsc = :CasFunDsc,
            CasFunBlq = :CasFunBlq
        WHERE
            CasFunCod = :CasFunCod
        ";

        $parameters = array(
            ':CasFunCod' => $this->attCasFunCod,
            ':CasFunDmd' => $this->attCasFunDmd,
            ':CasFunDsc' => $this->attCasFunDsc,
            ':CasFunBlq' => $this->attCasFunBlq
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
        ";

        $parameters = array(
            ':CasFunCod' => $this->attCasFunCod
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
        ";

        $parameters = array(
            ":CasFunCod" => $this->attCasFunCod
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
