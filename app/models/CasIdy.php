<?php

namespace app\models;

use app\core\Database;
use PDO;


class CasIdy
{
    // -- attributes -- //
    private $attCasIdyCod;
    private $attCasIdyDca;
    private $attCasIdyDmd;
    private $attCasIdyDsc;
    private $attCasIdyLck;
    private $attCasIdyTkn;
    private $attCasIdyUpt;
    private $attCasIdyExp;
    private $attCasIdyAtz;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasIdy';

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- set -- //
    public function setCasIdyCod($inCasIdyCod)
    {
        $this->attCasIdyCod = $inCasIdyCod;
    }
    public function setCasIdyDca($inCasIdyDca)
    {
        $this->attCasIdyDca = $inCasIdyDca;
    }
    public function setCasIdyDmd($inCasIdyDmd)
    {
        $this->attCasIdyDmd = $inCasIdyDmd;
    }
    public function setCasIdyDsc($inCasIdyDsc)
    {
        $this->attCasIdyDsc = $inCasIdyDsc;
    }
    public function setCasIdyLck($inCasIdyLck)
    {
        $this->attCasIdyLck = $inCasIdyLck;
    }
    public function setCasIdyTkn($inCasIdyTkn)
    {
        $this->attCasIdyTkn = $inCasIdyTkn;
    }
    public function setCasIdyUpt($inCasIdyUpt)
    {
        $this->attCasIdyUpt = $inCasIdyUpt;
    }
    public function setCasIdyExp($inCasIdyExp)
    {
        $this->attCasIdyExp = $inCasIdyExp;
    }
    public function setCasIdyAtz($inCasIdyAtz)
    {
        $this->attCasIdyAtz = $inCasIdyAtz;
    }

    // -- get -- //
    public function getCasIdyCod()
    {
        return $this->attCasIdyCod;
    }
    public function getCasIdyDca()
    {
        return $this->attCasIdyDca;
    }
    public function getCasIdyDmd()
    {
        return $this->attCasIdyDmd;
    }
    public function getCasIdyDsc()
    {
        return $this->attCasIdyDsc;
    }
    public function getCasIdyLck()
    {
        return $this->attCasIdyLck;
    }
    public function getCasIdyTkn()
    {
        return $this->attCasIdyTkn;
    }
    public function getCasIdyUpt()
    {
        return $this->attCasIdyUpt;
    }
    public function getCasIdyExp()
    {
        return $this->attCasIdyExp;
    }
    public function getCasIdyAtz()
    {
        return $this->attCasIdyAtz;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasIdyCod,
            CasIdyDca,
            CasIdyDmd,
            CasIdyDsc,
            CasIdyLck,
            CasIdyTkn,
            CasIdyUpt,
            CasIdyExp,
            CasIdyAtz

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
            CasIdyCod,
            CasIdyDca,
            CasIdyDmd,
            CasIdyDsc,
            CasIdyLck,
            CasIdyTkn,
            CasIdyUpt,
            CasIdyExp,
            CasIdyAtz

        FROM
        " . $this->tbl . "
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ":CasIdyCod" => $this->attCasIdyCod
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
            CasIdyCod,
            CasIdyDca,
            CasIdyDmd,
            CasIdyDsc,
            CasIdyLck,
            CasIdyTkn,
            CasIdyUpt,
            CasIdyExp,
            CasIdyAtz
        )
        VALUES
        (
            :CasIdyCod,
            :CasIdyDca,
            :CasIdyDmd,
            :CasIdyDsc,
            :CasIdyLck,
            :CasIdyTkn,
            :CasIdyUpt,
            :CasIdyExp,
            :CasIdyAtz
        )
        ";

        $parameters = array(
            ':CasIdyCod' => $this->attCasIdyCod,
            ':CasIdyDca' => $this->attCasIdyDca,
            ':CasIdyDmd' => $this->attCasIdyDmd,
            ':CasIdyDsc' => $this->attCasIdyDsc,
            ':CasIdyLck' => $this->attCasIdyLck,
            ':CasIdyTkn' => $this->attCasIdyTkn,
            ':CasIdyUpt' => $this->attCasIdyUpt,
            ':CasIdyExp' => $this->attCasIdyExp,
            ':CasIdyAtz' => $this->attCasIdyAtz
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
            CasIdyCod = :CasIdyCod,
            CasIdyDca = :CasIdyDca,
            CasIdyDmd = :CasIdyDmd,
            CasIdyDsc = :CasIdyDsc,
            CasIdyLck = :CasIdyLck,
            CasIdyTkn = :CasIdyTkn,
            CasIdyUpt = :CasIdyUpt,
            CasIdyExp = :CasIdyExp,
            CasIdyAtz = :CasIdyAtz
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ':CasIdyCod' => $this->attCasIdyCod,
            ':CasIdyDca' => $this->attCasIdyDca,
            ':CasIdyDmd' => $this->attCasIdyDmd,
            ':CasIdyDsc' => $this->attCasIdyDsc,
            ':CasIdyLck' => $this->attCasIdyLck,
            ':CasIdyTkn' => $this->attCasIdyTkn,
            ':CasIdyUpt' => $this->attCasIdyUpt,
            ':CasIdyExp' => $this->attCasIdyExp,
            ':CasIdyAtz' => $this->attCasIdyAtz
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
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ':CasIdyCod' => $this->attCasIdyCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }

    // -- other -- //
    public function validateIdentity()
    {
        $qry = "
        SELECT
            CasIdyCod,
            CasIdyLck
        FROM
        " . $this->tbl . "
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ":CasIdyCod" => $this->attCasIdyCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCasIdyCod = $row['CasIdyCod'];
            $this->attCasIdyLck = $row['CasIdyLck'];
        }

        return $rows;
    }

    public function getIdentity()
    {
        $qry = "
        SELECT
            CasIdyCod,
            CasIdyTkn,
            CasIdyLck
        FROM
        " . $this->tbl . "
        WHERE
            CasIdyTkn = :CasIdyTkn
        ";

        $parameters = array(
            ":CasIdyTkn" => $this->attCasIdyTkn
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCasIdyCod = $row['CasIdyCod'];
            $this->attCasIdyLck = $row['CasIdyLck'];
        }

        return $rows;
    }

    public function newToken()
    {
        $vCasIdyTkn = uniqid();
        $this->setCasIdyTkn($vCasIdyTkn);

        $vCasIdyUpt = date("Y-m-d H:i:s");
        $this->setCasIdyUpt($vCasIdyUpt);

        $qry = "
        UPDATE
        " . $this->tbl . "
        SET
            CasIdyTkn = :CasIdyTkn,
            CasIdyUpt = :CasIdyUpt
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ":CasIdyCod" => $this->attCasIdyCod,
            ":CasIdyTkn" => $this->attCasIdyTkn,
            ":CasIdyUpt" => $this->attCasIdyUpt
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            CasIdyCod
        FROM
        " . $this->tbl . "
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ":CasIdyCod" => $this->attCasIdyCod
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
