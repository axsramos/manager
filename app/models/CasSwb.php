<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasSwb
{
    // -- attributes -- //
    private $attCasSwbCod;
    private $attCasSwbDca;
    private $attCasSwbDmd;
    private $attCasSwbBlq;
    private $attCasSwbIdy;
    private $attCasSwbWks;
    private $attCasSwbUsu;
    private $attCasSwbBrw;
    private $attCasSwbIni;
    private $attCasSwbFin;
    private $attCasSwbUsrCod;
    private $attCasSwbWksCod;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasSwb';

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
    public function getCasSwbDca()
    {
        return $this->attCasSwbDca;
    }
    public function getCasSwbDmd()
    {
        return $this->attCasSwbDmd;
    }
    public function getCasSwbBlq()
    {
        return $this->attCasSwbBlq;
    }
    public function getCasSwbIdy()
    {
        return $this->attCasSwbIdy;
    }
    public function getCasSwbWks()
    {
        return $this->attCasSwbWks;
    }
    public function getCasSwbUsu()
    {
        return $this->attCasSwbUsu;
    }
    public function getCasSwbBrw()
    {
        return $this->attCasSwbBrw;
    }
    public function getCasSwbIni()
    {
        return $this->attCasSwbIni;
    }
    public function getCasSwbFin()
    {
        return $this->attCasSwbFin;
    }
    public function getCasSwbUsrCod()
    {
        return $this->attCasSwbUsrCod;
    }
    public function getCasSwbWksCod()
    {
        return $this->attCasSwbWksCod;
    }

    // -- set -- //
    public function setCasSwbCod($inCasSwbCod)
    {
        $this->attCasSwbCod = $inCasSwbCod;
    }
    public function setCasSwbDca($inCasSwbDca)
    {
        $this->attCasSwbDca = $inCasSwbDca;
    }
    public function setCasSwbDmd($inCasSwbDmd)
    {
        $this->attCasSwbDmd = $inCasSwbDmd;
    }
    public function setCasSwbBlq($inCasSwbBlq)
    {
        $this->attCasSwbBlq = $inCasSwbBlq;
    }
    public function setCasSwbIdy($inCasSwbIdy)
    {
        $this->attCasSwbIdy = $inCasSwbIdy;
    }
    public function setCasSwbWks($inCasSwbWks)
    {
        $this->attCasSwbWks = $inCasSwbWks;
    }
    public function setCasSwbUsu($inCasSwbUsu)
    {
        $this->attCasSwbUsu = $inCasSwbUsu;
    }
    public function setCasSwbBrw($inCasSwbBrw)
    {
        $this->attCasSwbBrw = $inCasSwbBrw;
    }
    public function setCasSwbIni($inCasSwbIni)
    {
        $this->attCasSwbIni = $inCasSwbIni;
    }
    public function setCasSwbFin($inCasSwbFin)
    {
        $this->attCasSwbFin = $inCasSwbFin;
    }
    public function setCasSwbUsrCod($inCasSwbUsrCod)
    {
        $this->attCasSwbUsrCod = $inCasSwbUsrCod;
    }
    public function setCasSwbWksCod($inCasSwbWksCod)
    {
        $this->attCasSwbWksCod = $inCasSwbWksCod;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasSwbCod,
            CasSwbDca,
            CasSwbDmd,
            CasSwbBlq,
            CasSwbIdy
            CasSwbWks,
            CasSwbUsu,
            CasSwbBrw,
            CasSwbIni,
            CasSwbFin,
            CasSwbUsrCod,
            CasSwbWksCod
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
            CasSwbDca,
            CasSwbDmd,
            CasSwbBlq,
            CasSwbIdy,
            CasSwbWks,
            CasSwbUsu,
            CasSwbBrw,
            CasSwbIni,
            CasSwbFin,
            CasSwbUsrCod,
            CasSwbWksCod
        FROM
        " . $this->tbl . "
        WHERE
            CasSwbCod = :CasSwbCod
        ";

        $parameters = array(
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
            CasSwbDca,
            CasSwbDmd,
            CasSwbBlq,
            CasSwbIdy,
            CasSwbWks,
            CasSwbUsu,
            CasSwbBrw,
            CasSwbIni,
            CasSwbFin,
            CasSwbUsrCod,
            CasSwbWksCod
        )
        VALUES
        (
            :CasSwbCod,
            :CasSwbDca,
            :CasSwbDmd,
            :CasSwbBlq,
            :CasSwbIdy,
            :CasSwbWks,
            :CasSwbUsu,
            :CasSwbBrw,
            :CasSwbIni,
            :CasSwbFin,
            :CasSwbUsrCod,
            :CasSwbWksCod
        )
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasSwbDca' => $this->attCasSwbDca,
            ':CasSwbDmd' => $this->attCasSwbDmd,
            ':CasSwbBlq' => $this->attCasSwbBlq,
            ':CasSwbIdy' => $this->attCasSwbIdy,
            ':CasSwbWks' => $this->attCasSwbWks,
            ':CasSwbUsu' => $this->attCasSwbUsu,
            ':CasSwbBrw' => $this->attCasSwbBrw,
            ':CasSwbIni' => $this->attCasSwbIni,
            ':CasSwbFin' => $this->attCasSwbFin,
            ':CasSwbUsrCod' => $this->attCasSwbUsrCod,
            ':CasSwbWksCod' => $this->attCasSwbWksCod
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
            CasSwbDmd = :CasSwbDmd,
            CasSwbBlq = :CasSwbBlq,
            CasSwbIdy = :CasSwbIdy,
            CasSwbWks = :CasSwbWks,
            CasSwbUsu = :CasSwbUsu,
            CasSwbBrw = :CasSwbBrw,
            CasSwbIni = :CasSwbIni,
            CasSwbFin = :CasSwbFin,
            CasSwbUsrCod = :CasSwbUsrCod,
            CasSwbWksCod = :CasSwbWksCod
        WHERE
            CasSwbCod = :CasSwbCod
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod,
            ':CasSwbDmd' => $this->attCasSwbDmd,
            ':CasSwbBlq' => $this->attCasSwbBlq,
            ':CasSwbIdy' => $this->attCasSwbIdy,
            ':CasSwbWks' => $this->attCasSwbWks,
            ':CasSwbUsu' => $this->attCasSwbUsu,
            ':CasSwbBrw' => $this->attCasSwbBrw,
            ':CasSwbIni' => $this->attCasSwbIni,
            ':CasSwbFin' => $this->attCasSwbFin,
            ':CasSwbUsrCod' => $this->attCasSwbUsrCod,
            ':CasSwbWksCod' => $this->attCasSwbWksCod
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
        ";

        $parameters = array(
            ':CasSwbCod' => $this->attCasSwbCod
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
            CasSwbCod
        FROM
        " . $this->tbl . "
        WHERE
            CasSwbCod = :CasSwbCod
        ";

        $parameters = array(
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
