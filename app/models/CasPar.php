<?php

namespace app\models;

use app\core\Database;
use PDO;


class CasPar
{
    // -- attributes -- //
    private $attCasParCod;
    private $attCasParDca;
    private $attCasParDmd;
    private $attCasParDsc;
    private $attCasParBlq;
    private $attCasParSeq;
    private $attCasParInt;
    private $attCasParDec;
    private $attCasParSep;
    private	$attCasParVch;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasPar';

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- set -- //
    public function setCasParCod($inCasParCod)
    {
        $this->attCasParCod = $inCasParCod;
    }
    public function setCasParDca($inCasParDca)
    {
        $this->attCasParDca = $inCasParDca;
    }
    public function setCasParDmd($inCasParDmd)
    {
        $this->attCasParDmd = $inCasParDmd;
    }
    public function setCasParDsc($inCasParDsc)
    {
        $this->attCasParDsc = $inCasParDsc;
    }
    public function setCasParBlq($inCasParBlq)
    {
        $this->attCasParBlq = $inCasParBlq;
    }
    public function setCasParSeq($inCasParSeq)
    {
        $this->attCasParSeq = $inCasParSeq;
    }
    public function setCasParInt($inCasParInt)
    {
        $this->attCasParInt = $inCasParInt;
    }
    public function setCasParDec($inCasParDec)
    {
        $this->attCasParDec = $inCasParDec;
    }
    public function setCasParSep($inCasParSep)
    {
        $this->attCasParSep = $inCasParSep;
    }
    public function setCasParVch($inCasParVch)
    {
        $this->attCasParVch = $inCasParVch;
    }

    // -- get -- //
    public function getCasParCod()
    {
        return $this->attCasParCod;
    }
    public function getCasParDca()
    {
        return $this->attCasParDca;
    }
    public function getCasParDmd()
    {
        return $this->attCasParDmd;
    }
    public function getCasParDsc()
    {
        return $this->attCasParDsc;
    }
    public function getCasParBlq()
    {
        return $this->attCasParBlq;
    }
    public function getCasParSeq()
    {
        return $this->attCasParSeq;
    }
    public function getCasParInt()
    {
        return $this->attCasParInt;
    }
    public function getCasParDec()
    {
        return $this->attCasParDec;
    }
    public function getCasParSep()
    {
        return $this->attCasParSep;
    }
    public function getCasParVch()
    {
        return $this->attCasParVch;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasParCod,
            CasParDca,
            CasParDmd,
            CasParDsc,
            CasParBlq,
            CasParSeq,
            CasParInt,
            CasParDec,
            CasParSep,
            CasParVch

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
            CasParCod,
            CasParDca,
            CasParDmd,
            CasParDsc,
            CasParBlq,
            CasParSeq,
            CasParInt,
            CasParDec,
            CasParSep,
            CasParVch

        FROM
        " . $this->tbl . "
        WHERE
            CasParCod = :CasParCod
        ";

        $parameters = array(
            ":CasParCod" => $this->attCasParCod
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
            CasParCod,
            CasParDca,
            CasParDmd,
            CasParDsc,
            CasParBlq,
            CasParSeq,
            CasParInt,
            CasParDec,
            CasParSep,
            CasParVch
        )
        VALUES
        (
            :CasParCod,
            :CasParDca,
            :CasParDmd,
            :CasParDsc,
            :CasParBlq,
            :CasParSeq,
            :CasParInt,
            :CasParDec,
            :CasParSep,
            :CasParVch
        )
        ";

        $parameters = array(
            ':CasParCod' => $this->attCasParCod,
            ':CasParDca' => $this->attCasParDca,
            ':CasParDmd' => $this->attCasParDmd,
            ':CasParDsc' => $this->attCasParDsc,
            ':CasParBlq' => $this->attCasParBlq,
            ':CasParSeq' => $this->attCasParSeq,
            ':CasParInt' => $this->attCasParInt,
            ':CasParDec' => $this->attCasParDec,
            ':CasParSep' => $this->attCasParSep,
            ':CasParVch' => $this->attCasParVch
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
            CasParDmd = :CasParDmd,
            CasParDsc = :CasParDsc,
            CasParBlq = :CasParBlq,
            CasParSeq = :CasParSeq,
            CasParInt = :CasParInt,
            CasParDec = :CasParDec,
            CasParSep = :CasParSep,
            CasParVch = :CasParVch
        WHERE
            CasParCod = :CasParCod
        ";

        $parameters = array(
            ':CasParCod' => $this->attCasParCod,
            ':CasParDmd' => $this->attCasParDmd,
            ':CasParDsc' => $this->attCasParDsc,
            ':CasParBlq' => $this->attCasParBlq,
            ':CasParSeq' => $this->attCasParSeq,
            ':CasParInt' => $this->attCasParInt,
            ':CasParDec' => $this->attCasParDec,
            ':CasParSep' => $this->attCasParSep,
            ':CasParVch' => $this->attCasParVch
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
            CasParCod = :CasParCod
        ";

        $parameters = array(
            ':CasParCod' => $this->attCasParCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }

    // -- other -- //
    public function newToken()
    {
        $vCasParSeq = uniqid();
        $this->setCasParSeq($vCasParSeq);

        $vCasParInt = date("Y-m-d H:i:s");
        $this->setCasParInt($vCasParInt);

        $qry = "
        UPDATE
        " . $this->tbl . "
        SET
            CasParSeq = :CasParSeq,
            CasParInt = :CasParInt
        WHERE
            CasParCod = :CasParCod
        ";

        $parameters = array(
            ":CasParCod" => $this->attCasParCod,
            ":CasParSeq" => $this->attCasParSeq,
            ":CasParInt" => $this->attCasParInt
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            CasParCod
        FROM
        " . $this->tbl . "
        WHERE
            CasParCod = :CasParCod
        ";

        $parameters = array(
            ":CasParCod" => $this->attCasParCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        
        return !boolval($rows);
    }

    private function check_referencial_key()
    {
        $rows = 0;
        return !boolval($rows);
    }
}
