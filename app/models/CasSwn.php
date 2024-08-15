<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasSwn
{
    // -- attributes -- //
    private $attCasSwbCod;
    private $attCasSwnCod;
    private $attCasSwnDca;
    private $attCasSwnDmd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasSwn';

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
    public function getCasSwnCod()
    {
        return $this->attCasSwnCod;
    }
    public function getCasSwnDca()
    {
        return $this->attCasSwnDca;
    }
    public function getCasSwnDmd()
    {
        return $this->attCasSwnDmd;
    }

    // -- set -- //
    public function setCasSwbCod($inCasSwbCod)
    {
        $this->attCasSwbCod = $inCasSwbCod;
    }
    public function setCasSwnCod($inCasSwnCod)
    {
        $this->attCasSwnCod = $inCasSwnCod;
    }
    public function setCasSwnDca($inCasSwnDca)
    {
        $this->attCasSwnDca = $inCasSwnDca;
    }
    public function setCasSwnDmd($inCasSwnDmd)
    {
        $this->attCasSwnDmd = $inCasSwnDmd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasSwbCod,    
            CasSwnCod,
            CasSwnDca,
            CasSwnDmd
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
            CasSwnCod,
            CasSwnDca,
            CasSwnDmd
        FROM
        " . $this->tbl . "
        WHERE
            CasSwbCod = :CasSwbCod
        AND CasSwnCod = :CasSwnCod
        ";

        $parameters = array(
            ":CasSwnCod" => $this->attCasSwnCod,
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
            CasSwnCod,
            CasSwnDca,
            CasSwnDmd
        )
        VALUES
        (
            :CasSwbCod,    
            :CasSwnCod,
            :CasSwnDca,
            :CasSwnDmd
        )
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasSwnCod' => $this->attCasSwnCod,
            ':CasSwnDca' => $this->attCasSwnDca,
            ':CasSwnDmd' => $this->attCasSwnDmd
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
            CasSwnDmd = :CasSwnDmd
        WHERE
            CasSwbCod = :CasSwbCod
        AND CasSwnCod = :CasSwnCod
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasSwnCod' => $this->attCasSwnCod,
            ':CasSwnDmd' => $this->attCasSwnDmd
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
        AND CasSwnCod = :CasSwnCod
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasSwnCod' => $this->attCasSwnCod
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
            CasSwnCod
        FROM
        " . $this->tbl . "
        WHERE
            CasSwbCod = :CasSwbCod
        AND CasSwnCod = :CasSwnCod
        ";

        $parameters = array(
            ":CasSwnCod" => $this->attCasSwnCod,
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
