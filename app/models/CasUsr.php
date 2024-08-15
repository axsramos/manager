<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasUsr
{
    // -- attributes -- //
    private $attCasUsrCod;
    private $attCasUsrDca;
    private $attCasUsrDmd;
    private $attCasUsrDsc;
    private $attCasUsrBlq;
    private $attCasUsrDmn;
    private $attCasUsrLgn;
    private $attCasUsrPwd;
    private $attCasUsrChv;


    // -- database -- //
    private $cnx;
    private $tbl = 'CasUsr';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasUsrCod()
    {
        return $this->attCasUsrCod;
    }
    public function getCasUsrDca()
    {
        return $this->attCasUsrDca;
    }
    public function getCasUsrDmd()
    {
        return $this->attCasUsrDmd;
    }
    public function getCasUsrDsc()
    {
        return $this->attCasUsrDsc;
    }
    public function getCasUsrBlq()
    {
        return $this->attCasUsrBlq;
    }
    public function getCasUsrDmn()
    {
        return $this->attCasUsrDmn;
    }
    public function getCasUsrLgn()
    {
        return $this->attCasUsrLgn;
    }
    public function getCasUsrPwd()
    {
        return $this->attCasUsrPwd;
    }
    public function getCasUsrChv()
    {
        return $this->attCasUsrChv;
    }


    // -- set -- //
    public function setCasUsrCod($inCasUsrCod)
    {
        $this->attCasUsrCod = $inCasUsrCod;
    }
    public function setCasUsrDca($inCasUsrDca)
    {
        $this->attCasUsrDca = $inCasUsrDca;
    }
    public function setCasUsrDmd($inCasUsrDmd)
    {
        $this->attCasUsrDmd = $inCasUsrDmd;
    }
    public function setCasUsrDsc($inCasUsrDsc)
    {
        $this->attCasUsrDsc = $inCasUsrDsc;
    }
    public function setCasUsrBlq($inCasUsrBlq)
    {
        $this->attCasUsrBlq = $inCasUsrBlq;
    }
    public function setCasUsrDmn($inCasUsrDmn)
    {
        $this->attCasUsrDmn = $inCasUsrDmn;
    }
    public function setCasUsrLgn($inCasUsrLgn)
    {
        $this->attCasUsrLgn = $inCasUsrLgn;
    }
    public function setCasUsrPwd($inCasUsrPwd)
    {
        $this->attCasUsrPwd = $inCasUsrPwd;
    }
    public function setCasUsrChv($inCasUsrChv)
    {
        $this->attCasUsrChv = $inCasUsrChv;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasUsrCod,
            CasUsrDca,
            CasUsrDmd,
            CasUsrDsc,
            CasUsrBlq,
            CasUsrDmn,
            CasUsrLgn,
            CasUsrPwd,
            CasUsrChv

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
            CasUsrCod,
            CasUsrDca,
            CasUsrDmd,
            CasUsrDsc,
            CasUsrBlq,
            CasUsrDmn,
            CasUsrLgn,
            CasUsrPwd,
            CasUsrChv
        FROM
        " . $this->tbl . "
        WHERE
            CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
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
            CasUsrCod,
            CasUsrDca,
            CasUsrDmd,
            CasUsrDsc,
            CasUsrBlq,
            CasUsrDmn,
            CasUsrLgn,
            CasUsrPwd,
            CasUsrChv
        )
        VALUES
        (
            :CasUsrCod,
            :CasUsrDca,
            :CasUsrDmd,
            :CasUsrDsc,
            :CasUsrBlq,
            :CasUsrDmn,
            :CasUsrLgn,
            :CasUsrPwd,
            :CasUsrChv
        )
        ";

        $parameters = array(
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasUsrDca' => $this->attCasUsrDca,
            ':CasUsrDmd' => $this->attCasUsrDmd,
            ':CasUsrDsc' => $this->attCasUsrDsc,
            ':CasUsrBlq' => $this->attCasUsrBlq,
            ':CasUsrDmn' => $this->attCasUsrDmn,
            ':CasUsrLgn' => $this->attCasUsrLgn,
            ':CasUsrPwd' => $this->attCasUsrPwd,
            ':CasUsrChv' => $this->attCasUsrChv
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
            CasUsrDmd = :CasUsrDmd,
            CasUsrDsc = :CasUsrDsc,
            CasUsrBlq = :CasUsrBlq,
            CasUsrDmn = :CasUsrDmn,
            CasUsrLgn = :CasUsrLgn,
            CasUsrPwd = :CasUsrPwd,
            CasUsrChv = :CasUsrChv
        WHERE
            CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasUsrDmd' => $this->attCasUsrDmd,
            ':CasUsrDsc' => $this->attCasUsrDsc,
            ':CasUsrBlq' => $this->attCasUsrBlq,
            ':CasUsrDmn' => $this->attCasUsrDmn,
            ':CasUsrLgn' => $this->attCasUsrLgn,
            ':CasUsrPwd' => $this->attCasUsrPwd,
            ':CasUsrChv' => $this->attCasUsrChv
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
            CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
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
            CasUsrCod
        FROM
        " . $this->tbl . "
        WHERE
            CasUsrCod = :CasUsrCod
        ";

        $parameters = array(
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
