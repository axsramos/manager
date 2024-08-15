<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasWks
{
    // -- attributes -- //
    private $attCasWksCod;
    private $attCasWksDca;
    private $attCasWksDmd;
    private $attCasWksDsc;
    private $attCasWksBlq;
    private $attCasWksMac;
    private $attCasWksEip;
    private $attCasWksChv;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasWks';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasWksCod()
    {
        return $this->attCasWksCod;
    }
    public function getCasWksDca()
    {
        return $this->attCasWksDca;
    }
    public function getCasWksDmd()
    {
        return $this->attCasWksDmd;
    }
    public function getCasWksDsc()
    {
        return $this->attCasWksDsc;
    }
    public function getCasWksBlq()
    {
        return $this->attCasWksBlq;
    }
    public function getCasWksMac()
    {
        return $this->attCasWksMac;
    }
    public function getCasWksEip()
    {
        return $this->attCasWksEip;
    }
    public function getCasWksChv()
    {
        return $this->attCasWksChv;
    }

    // -- set -- //
    public function setCasWksCod($inCasWksCod)
    {
        $this->attCasWksCod = $inCasWksCod;
    }
    public function setCasWksDca($inCasWksDca)
    {
        $this->attCasWksDca = $inCasWksDca;
    }
    public function setCasWksDmd($inCasWksDmd)
    {
        $this->attCasWksDmd = $inCasWksDmd;
    }
    public function setCasWksDsc($inCasWksDsc)
    {
        $this->attCasWksDsc = $inCasWksDsc;
    }
    public function setCasWksBlq($inCasWksBlq)
    {
        $this->attCasWksBlq = $inCasWksBlq;
    }
    public function setCasWksMac($inCasWksMac)
    {
        $this->attCasWksMac = $inCasWksMac;
    }
    public function setCasWksEip($inCasWksEip)
    {
        $this->attCasWksEip = $inCasWksEip;
    }
    public function setCasWksChv($inCasWksChv)
    {
        $this->attCasWksChv = $inCasWksChv;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasWksCod,
            CasWksDca,
            CasWksDmd,
            CasWksDsc,
            CasWksBlq,
            CasWksMac,
            CasWksEip,
            CasWksChv
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
            CasWksCod,
            CasWksDca,
            CasWksDmd,
            CasWksDsc,
            CasWksBlq,
            CasWksMac,
            CasWksEip,
            CasWksChv
        FROM
        " . $this->tbl . "
        WHERE
            CasWksCod = :CasWksCod
        ";

        $parameters = array(
            ":CasWksCod" => $this->attCasWksCod
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
            CasWksCod,
            CasWksDca,
            CasWksDmd,
            CasWksDsc,
            CasWksBlq,
            CasWksMac,
            CasWksEip,
            CasWksChv
        )
        VALUES
        (
            :CasWksCod,
            :CasWksDca,
            :CasWksDmd,
            :CasWksDsc,
            :CasWksBlq,
            :CasWksMac,
            :CasWksEip,
            :CasWksChv
        )
        ";

        $parameters = array(
            ':CasWksCod' => $this->attCasWksCod,
            ':CasWksDca' => $this->attCasWksDca,
            ':CasWksDmd' => $this->attCasWksDmd,
            ':CasWksDsc' => $this->attCasWksDsc,
            ':CasWksBlq' => $this->attCasWksBlq,
            ':CasWksMac' => $this->attCasWksMac,
            ':CasWksEip' => $this->attCasWksEip,
            ':CasWksChv' => $this->attCasWksChv
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
            CasWksDmd = :CasWksDmd,
            CasWksDsc = :CasWksDsc,
            CasWksBlq = :CasWksBlq,
            CasWksMac = :CasWksMac,
            CasWksEip = :CasWksEip,
            CasWksChv = :CasWksChv
        WHERE
            CasWksCod = :CasWksCod
        ";

        $parameters = array(
            ':CasWksCod' => $this->attCasWksCod,
            ':CasWksDmd' => $this->attCasWksDmd,
            ':CasWksDsc' => $this->attCasWksDsc,
            ':CasWksBlq' => $this->attCasWksBlq,
            ':CasWksMac' => $this->attCasWksMac,
            ':CasWksEip' => $this->attCasWksEip,
            ':CasWksChv' => $this->attCasWksChv
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
            CasWksCod = :CasWksCod
        ";

        $parameters = array(
            ':CasWksCod' => $this->attCasWksCod
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
            CasWksCod
        FROM
        " . $this->tbl . "
        WHERE
            CasWksCod = :CasWksCod
        ";

        $parameters = array(
            ":CasWksCod" => $this->attCasWksCod
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
