<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasCvt
{
    // -- attributes -- //
    private $attCasCvtCod;
    private $attCasCvtDca;
    private $attCasCvtDmd;
    private $attCasCvtNme;
    private $attCasCvtLgn;
    private $attCasCvtPar;
    private $attCasCvtLnk;
    private $attCasCvtBlq;
    private $attCasCvtBlqDtt;
    private $attCasCvtEnv;
    private $attCasCvtEnvDtt;
    private $attCasCvtCnf;
    private $attCasCvtCnfDtt;
    private $attCasCvtChv;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasCvt';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasCvtCod()
    {
        return $this->attCasCvtCod;
    }
    public function getCasCvtDca()
    {
        return $this->attCasCvtDca;
    }
    public function getCasCvtDmd()
    {
        return $this->attCasCvtDmd;
    }
    public function getCasCvtNme()
    {
        return $this->attCasCvtNme;
    }
    public function getCasCvtLgn()
    {
        return $this->attCasCvtLgn;
    }
    public function getCasCvtPar()
    {
        return $this->attCasCvtPar;
    }
    public function getCasCvtLnk()
    {
        return $this->attCasCvtLnk;
    }
    public function getCasCvtBlq()
    {
        return $this->attCasCvtBlq;
    }
    public function getCasCvtBlqDtt()
    {
        return $this->attCasCvtBlqDtt;
    }
    public function getCasCvtEnv()
    {
        return $this->attCasCvtEnv;
    }
    public function getCasCvtEnvDtt()
    {
        return $this->attCasCvtEnvDtt;
    }
    public function getCasCvtCnf()
    {
        return $this->attCasCvtCnf;
    }
    public function getCasCvtCnfDtt()
    {
        return $this->attCasCvtCnfDtt;
    }
    public function getCasCvtChv()
    {
        return $this->attCasCvtChv;
    }

    // -- set -- //
    public function setCasCvtCod($inCasCvtCod)
    {
        $this->attCasCvtCod = $inCasCvtCod;
    }
    public function setCasCvtDca($inCasCvtDca)
    {
        $this->attCasCvtDca = $inCasCvtDca;
    }
    public function setCasCvtDmd($inCasCvtDmd)
    {
        $this->attCasCvtDmd = $inCasCvtDmd;
    }
    public function setCasCvtNme($inCasCvtNme)
    {
        $this->attCasCvtNme = $inCasCvtNme;
    }
    public function setCasCvtLgn($inCasCvtLgn)
    {
        $this->attCasCvtLgn = $inCasCvtLgn;
    }
    public function setCasCvtPar($inCasCvtPar)
    {
        $this->attCasCvtPar = $inCasCvtPar;
    }
    public function setCasCvtLnk($inCasCvtLnk)
    {
        $this->attCasCvtLnk = $inCasCvtLnk;
    }
    public function setCasCvtBlq($inCasCvtBlq)
    {
        $this->attCasCvtBlq = $inCasCvtBlq;
    }
    public function setCasCvtBlqDtt($inCasCvtBlqDtt)
    {
        $this->attCasCvtBlqDtt = $inCasCvtBlqDtt;
    }
    public function setCasCvtEnv($inCasCvtEnv)
    {
        $this->attCasCvtEnv = $inCasCvtEnv;
    }
    public function setCasCvtEnvDtt($inCasCvtEnvDtt)
    {
        $this->attCasCvtEnvDtt = $inCasCvtEnvDtt;
    }
    public function setCasCvtCnf($inCasCvtCnf)
    {
        $this->attCasCvtCnf = $inCasCvtCnf;
    }
    public function setCasCvtCnfDtt($inCasCvtCnfDtt)
    {
        $this->attCasCvtCnfDtt = $inCasCvtCnfDtt;
    }
    public function setCasCvtChv($inCasCvtChv)
    {
        $this->attCasCvtChv = $inCasCvtChv;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasCvtCod,
            CasCvtDca,
            CasCvtDmd,
            CasCvtNme,
            CasCvtLgn,
            CasCvtPar,
            CasCvtLnk,
            CasCvtBlq,
            CasCvtBlqDtt,
            CasCvtEnv,
            CasCvtEnvDtt,
            CasCvtCnf,
            CasCvtCnfDtt,
            CasCvtChv
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
            CasCvtCod,
            CasCvtDca,
            CasCvtDmd,
            CasCvtNme,
            CasCvtLgn,
            CasCvtPar,
            CasCvtLnk,
            CasCvtBlq,
            CasCvtBlqDtt,
            CasCvtEnv,
            CasCvtEnvDtt,
            CasCvtCnf,
            CasCvtCnfDtt,
            CasCvtChv
        FROM
        " . $this->tbl . "
        WHERE
            CasCvtCod = :CasCvtCod
        ";

        $parameters = array(
            ":CasCvtCod" => $this->attCasCvtCod
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
            CasCvtCod,
            CasCvtDca,
            CasCvtDmd,
            CasCvtNme,
            CasCvtLgn,
            CasCvtPar,
            CasCvtLnk,
            CasCvtBlq,
            CasCvtBlqDtt,
            CasCvtEnv,
            CasCvtEnvDtt,
            CasCvtCnf,
            CasCvtCnfDtt,
            CasCvtChv
        )
        VALUES
        (
            :CasCvtCod,
            :CasCvtDca,
            :CasCvtDmd,
            :CasCvtNme,
            :CasCvtLgn,
            :CasCvtPar,
            :CasCvtLnk,
            :CasCvtBlq,
            :CasCvtBlqDtt,
            :CasCvtEnv,
            :CasCvtEnvDtt,
            :CasCvtCnf,
            :CasCvtCnfDtt,
            :CasCvtChv
        )
        ";

        $parameters = array(
            ':CasCvtCod' => $this->attCasCvtCod,
            ':CasCvtDca' => $this->attCasCvtDca,
            ':CasCvtDmd' => $this->attCasCvtDmd,
            ':CasCvtNme' => $this->attCasCvtNme,
            ':CasCvtLgn' => $this->attCasCvtLgn,
            ':CasCvtPar' => $this->attCasCvtPar,
            ':CasCvtLnk' => $this->attCasCvtLnk,
            ':CasCvtBlq' => $this->attCasCvtBlq,
            ':CasCvtBlqDtt' => $this->attCasCvtBlqDtt,
            ':CasCvtEnv' => $this->attCasCvtEnv,
            ':CasCvtEnvDtt' => $this->attCasCvtEnvDtt,
            ':CasCvtCnf' => $this->attCasCvtCnf,
            ':CasCvtCnfDtt' => $this->attCasCvtCnfDtt,
            ':CasCvtChv' => $this->attCasCvtChv
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
            CasCvtDmd = :CasCvtDmd,
            CasCvtNme = :CasCvtNme,
            CasCvtLgn = :CasCvtLgn,
            CasCvtPar = :CasCvtPar,
            CasCvtLnk = :CasCvtLnk,
            CasCvtBlq = :CasCvtBlq,
            CasCvtBlqDtt = :CasCvtBlqDtt,
            CasCvtEnv = :CasCvtEnv,
            CasCvtEnvDtt = :CasCvtEnvDtt,
            CasCvtCnf = :CasCvtCnf,
            CasCvtCnfDtt = :CasCvtCnfDtt,
            CasCvtChv = :CasCvtChv
        WHERE
            CasCvtCod = :CasCvtCod
        ";

        $parameters = array(
            ':CasCvtCod' => $this->attCasCvtCod,
            ':CasCvtDmd' => $this->attCasCvtDmd,
            ':CasCvtNme' => $this->attCasCvtNme,
            ':CasCvtLgn' => $this->attCasCvtLgn,
            ':CasCvtPar' => $this->attCasCvtPar,
            ':CasCvtLnk' => $this->attCasCvtLnk,
            ':CasCvtBlq' => $this->attCasCvtBlq,
            ':CasCvtBlqDtt' => $this->attCasCvtBlqDtt,
            ':CasCvtEnv' => $this->attCasCvtEnv,
            ':CasCvtEnvDtt' => $this->attCasCvtEnvDtt,
            ':CasCvtCnf' => $this->attCasCvtCnf,
            ':CasCvtCnfDtt' => $this->attCasCvtCnfDtt,
            ':CasCvtChv' => $this->attCasCvtChv
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
            CasCvtCod = :CasCvtCod
        ";

        $parameters = array(
            ':CasCvtCod' => $this->attCasCvtCod
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
            CasCvtCod
        FROM
        " . $this->tbl . "
        WHERE
            CasCvtCod = :CasCvtCod
        ";

        $parameters = array(
            ":CasCvtCod" => $this->attCasCvtCod
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
