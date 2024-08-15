<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasSwp
{
    // -- attributes -- //
    private $attCasSwbCod;
    private $attCasPrgCod;
    private $attCasSwpDca;
    private $attCasSwpDmd;
    private $attCasSwpVch;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasSwp';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasSwbCod()
    {
        return $this->attCasSwbCod;
    }
    public function getCasPrgCod()
    {
        return $this->attCasPrgCod;
    }
    public function getCasSwpDca()
    {
        return $this->attCasSwpDca;
    }
    public function getCasSwpDmd()
    {
        return $this->attCasSwpDmd;
    }
    public function getCasSwpVch() {
        return $this->attCasSwpVch;
    }

    // -- set -- //
    public function setCasSwbCod($inCasSwbCod)
    {
        $this->attCasSwbCod = $inCasSwbCod;
    }
    public function setCasPrgCod($inCasPrgCod)
    {
        $this->attCasPrgCod = $inCasPrgCod;
    }
    public function setCasSwpDca($inCasSwpDca)
    {
        $this->attCasSwpDca = $inCasSwpDca;
    }
    public function setCasSwpDmd($inCasSwpDmd)
    {
        $this->attCasSwpDmd = $inCasSwpDmd;
    }
    public function setCasSwpVch($inCasSwpVch) {
        $this->attCasSwpVch = $inCasSwpVch;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasSwbCod,    
            CasPrgCod,
            CasSwpDca,
            CasSwpDmd,
            CasSwpVch
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
            CasSwbCod,    
            CasPrgCod,
            CasSwpDca,
            CasSwpDmd,
            CasSwpVch
        FROM
        " . $this->tbl . "
        WHERE
            CasSwbCod = :CasSwbCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasPrgCod" => $this->attCasPrgCod,
            ":CasSwbCod" => $this->attCasSwbCod
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
            CasSwbCod,    
            CasPrgCod,
            CasSwpDca,
            CasSwpDmd,
            CasSwpVch
        )
        VALUES
        (
            :CasSwbCod,    
            :CasPrgCod,
            :CasSwpDca,
            :CasSwpDmd,
            :CasSwpVch
        )
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasSwpDca' => $this->attCasSwpDca,
            ':CasSwpDmd' => $this->attCasSwpDmd,
            ':CasSwpVch' => $this->attCasSwpVch
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
            CasSwpDmd = :CasSwpDmd,
            CasSwpVch = :CasSwpVch
        WHERE
            CasSwbCod = :CasSwbCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasSwpDmd' => $this->attCasSwpDmd,
            ':CasSwpVch' => $this->attCasSwpVch
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
            CasSwbCod = :CasSwbCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
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
            CasSwbCod,    
            CasPrgCod
        FROM
        " . $this->tbl . "
        WHERE
            CasSwbCod = :CasSwbCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasPrgCod" => $this->attCasPrgCod,
            ":CasSwbCod" => $this->attCasSwbCod
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
