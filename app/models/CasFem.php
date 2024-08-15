<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFem
{
    // -- attributes -- //
    private $attCasFemCod;
    private $attCasFemDca;
    private $attCasFemDmd;
    private $attCasFemDsc;
    private $attCasFemBlq;
    private $attCasFemGerFlg;
    private $attCasFemGerDtt;
    private $attCasFemEnvFlg;
    private $attCasFemEnvDtt;
    private $attCasFemPar;


    // -- database -- //
    private $cnx;
    private $tbl = 'CasFem';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasFemCod()
    {
        return $this->attCasFemCod;
    }
    public function getCasFemDca()
    {
        return $this->attCasFemDca;
    }
    public function getCasFemDmd()
    {
        return $this->attCasFemDmd;
    }
    public function getCasFemDsc()
    {
        return $this->attCasFemDsc;
    }
    public function getCasFemBlq()
    {
        return $this->attCasFemBlq;
    }
    public function getCasFemGerFlg()
    {
        return $this->attCasFemGerFlg;
    }
    public function getCasFemGerDtt()
    {
        return $this->attCasFemGerDtt;
    }
    public function getCasFemEnvFlg()
    {
        return $this->attCasFemEnvFlg;
    }
    public function getCasFemEnvDtt()
    {
        return $this->attCasFemEnvDtt;
    }
    public function getCasFemPar()
    {
        return $this->attCasFemPar;
    }

    // -- set -- //
    public function setCasFemCod($inCasFemCod)
    {
        $this->attCasFemCod = $inCasFemCod;
    }
    public function setCasFemDca($inCasFemDca)
    {
        $this->attCasFemDca = $inCasFemDca;
    }
    public function setCasFemDmd($inCasFemDmd)
    {
        $this->attCasFemDmd = $inCasFemDmd;
    }
    public function setCasFemDsc($inCasFemDsc)
    {
        $this->attCasFemDsc = $inCasFemDsc;
    }
    public function setCasFemBlq($inCasFemBlq)
    {
        $this->attCasFemBlq = $inCasFemBlq;
    }
    public function setCasFemGerFlg($inCasFemGerFlg)
    {
        $this->attCasFemGerFlg = $inCasFemGerFlg;
    }
    public function setCasFemGerDtt($inCasFemGerDtt)
    {
        $this->attCasFemGerDtt = $inCasFemGerDtt;
    }
    public function setCasFemEnvFlg($inCasFemEnvFlg)
    {
        $this->attCasFemEnvFlg = $inCasFemEnvFlg;
    }
    public function setCasFemEnvDtt($inCasFemEnvDtt)
    {
        $this->attCasFemEnvDtt = $inCasFemEnvDtt;
    }
    public function setCasFemPar($inCasFemPar)
    {
        $this->attCasFemPar = $inCasFemPar;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFemCod,
            CasFemDca,
            CasFemDmd,
            CasFemDsc,
            CasFemBlq,
            CasFemGerFlg,
            CasFemGerDtt,
            CasFemEnvFlg,
            CasFemEnvDtt,
            CasFemPar
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
            CasFemCod,
            CasFemDca,
            CasFemDmd,
            CasFemDsc,
            CasFemBlq,
            CasFemGerFlg,
            CasFemGerDtt,
            CasFemEnvFlg,
            CasFemEnvDtt,
            CasFemPar
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod
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
            CasFemCod,
            CasFemDca,
            CasFemDmd,
            CasFemDsc,
            CasFemBlq,
            CasFemGerFlg,
            CasFemGerDtt,
            CasFemEnvFlg,
            CasFemEnvDtt,
            CasFemPar
        )
        VALUES
        (
            :CasFemCod,
            :CasFemDca,
            :CasFemDmd,
            :CasFemDsc,
            :CasFemBlq,
            :CasFemGerFlg,
            :CasFemGerDtt,
            :CasFemEnvFlg,
            :CasFemEnvDtt,
            :CasFemPar
        )
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemDca' => $this->attCasFemDca,
            ':CasFemDmd' => $this->attCasFemDmd,
            ':CasFemDsc' => $this->attCasFemDsc,
            ':CasFemBlq' => $this->attCasFemBlq,
            ':CasFemGerFlg' => $this->attCasFemGerFlg,
            ':CasFemGerDtt' => $this->attCasFemGerDtt,
            ':CasFemEnvFlg' => $this->attCasFemEnvFlg,
            ':CasFemEnvDtt' => $this->attCasFemEnvDtt,
            ':CasFemPar' => $this->attCasFemPar
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
            CasFemDmd = :CasFemDmd,
            CasFemDsc = :CasFemDsc,
            CasFemBlq = :CasFemBlq,
            CasFemGerFlg = :CasFemGerFlg,
            CasFemGerDtt = :CasFemGerDtt,
            CasFemEnvFlg = :CasFemEnvFlg,
            CasFemEnvDtt = :CasFemEnvDtt,
            CasFemPar = :CasFemPar
        WHERE
            CasFemCod = :CasFemCod
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemDmd' => $this->attCasFemDmd,
            ':CasFemDsc' => $this->attCasFemDsc,
            ':CasFemBlq' => $this->attCasFemBlq,
            ':CasFemGerFlg' => $this->attCasFemGerFlg,
            ':CasFemGerDtt' => $this->attCasFemGerDtt,
            ':CasFemEnvFlg' => $this->attCasFemEnvFlg,
            ':CasFemEnvDtt' => $this->attCasFemEnvDtt,
            ':CasFemPar' => $this->attCasFemPar
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
            CasFemCod = :CasFemCod
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod
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
            CasFemCod
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod
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
