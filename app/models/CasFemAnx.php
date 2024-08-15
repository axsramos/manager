<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasFemAnx
{
    // -- attributes -- //
    private $attCasFemCod;
    private $attCasFemAnxCod;
    private $attCasFemAnxDca;
    private $attCasFemAnxDmd;
    private $attCasFemAnxDsc;
    private $attCasFemAnxDir;
    private $attCasFemAnxNme;
    private $attCasFemAnxExt;
    private $attCasFemAnxSze;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasFemAnx';

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
    public function getCasFemAnxCod()
    {
        return $this->attCasFemAnxCod;
    }
    public function getCasFemAnxDca()
    {
        return $this->attCasFemAnxDca;
    }
    public function getCasFemAnxDmd()
    {
        return $this->attCasFemAnxDmd;
    }
    public function getCasFemAnxDsc()
    {
        return $this->attCasFemAnxDsc;
    }
    public function getCasFemAnxDir()
    {
        return $this->attCasFemAnxDir;
    }
    public function getCasFemAnxNme()
    {
        return $this->attCasFemAnxNme;
    }
    public function getCasFemAnxExt()
    {
        return $this->attCasFemAnxExt;
    }
    public function getCasFemAnxSze()
    {
        return $this->attCasFemAnxSze;
    }

    // -- set -- //
    public function setCasFemCod($inCasFemCod)
    {
        $this->attCasFemCod = $inCasFemCod;
    }
    public function setCasFemAnxCod($inCasFemAnxCod)
    {
        $this->attCasFemAnxCod = $inCasFemAnxCod;
    }
    public function setCasFemAnxDca($inCasFemAnxDca)
    {
        $this->attCasFemAnxDca = $inCasFemAnxDca;
    }
    public function setCasFemAnxDmd($inCasFemAnxDmd)
    {
        $this->attCasFemAnxDmd = $inCasFemAnxDmd;
    }
    public function setCasFemAnxDsc($inCasFemAnxDsc)
    {
        $this->attCasFemAnxDsc = $inCasFemAnxDsc;
    }
    public function setCasFemAnxDir($inCasFemAnxDir)
    {
        $this->attCasFemAnxDir = $inCasFemAnxDir;
    }
    public function setCasFemAnxNme($inCasFemAnxNme)
    {
        $this->attCasFemAnxNme = $inCasFemAnxNme;
    }
    public function setCasFemAnxExt($inCasFemAnxExt)
    {
        $this->attCasFemAnxExt = $inCasFemAnxExt;
    }
    public function setCasFemAnxSze($inCasFemAnxSze)
    {
        $this->attCasFemAnxSze = $inCasFemAnxSze;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasFemCod,
            CasFemAnxCod,
            CasFemAnxDca,
            CasFemAnxDmd,
            CasFemAnxDsc,
            CasFemAnxDir,
            CasFemAnxNme,
            CasFemAnxExt,
            CasFemAnxSze
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
            CasFemAnxCod,
            CasFemAnxDca,
            CasFemAnxDmd,
            CasFemAnxDsc,
            CasFemAnxDir,
            CasFemAnxNme,
            CasFemAnxExt,
            CasFemAnxSze
        FROM
        " . $this->tbl . "
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemAnxCod = :CasFemAnxCod
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemAnxCod" => $this->attCasFemAnxCod
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
            CasFemAnxCod,
            CasFemAnxDca,
            CasFemAnxDmd,
            CasFemAnxDsc,
            CasFemAnxDir,
            CasFemAnxNme,
            CasFemAnxExt,
            CasFemAnxSze
        )
        VALUES
        (
            :CasFemCod,
            :CasFemAnxCod,
            :CasFemAnxDca,
            :CasFemAnxDmd,
            :CasFemAnxDsc,
            :CasFemAnxDir,
            :CasFemAnxNme,
            :CasFemAnxExt,
            :CasFemAnxSze
        )
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemAnxCod' => $this->attCasFemAnxCod,
            ':CasFemAnxDca' => $this->attCasFemAnxDca,
            ':CasFemAnxDmd' => $this->attCasFemAnxDmd,
            ':CasFemAnxDsc' => $this->attCasFemAnxDsc,
            ':CasFemAnxDir' => $this->attCasFemAnxDir,
            ':CasFemAnxNme' => $this->attCasFemAnxNme,
            ':CasFemAnxExt' => $this->attCasFemAnxExt,
            ':CasFemAnxSze' => $this->attCasFemAnxSze
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
            CasFemAnxDmd = :CasFemAnxDmd,
            CasFemAnxDsc = :CasFemAnxDsc,
            CasFemAnxDir = :CasFemAnxDir,
            CasFemAnxNme = :CasFemAnxNme,
            CasFemAnxExt = :CasFemAnxExt,
            CasFemAnxSze = :CasFemAnxSze
        WHERE
            CasFemCod = :CasFemCod
        AND CasFemAnxCod = :CasFemAnxCod
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemAnxCod' => $this->attCasFemAnxCod,
            ':CasFemAnxDmd' => $this->attCasFemAnxDmd,
            ':CasFemAnxDsc' => $this->attCasFemAnxDsc,
            ':CasFemAnxDir' => $this->attCasFemAnxDir,
            ':CasFemAnxNme' => $this->attCasFemAnxNme,
            ':CasFemAnxExt' => $this->attCasFemAnxExt,
            ':CasFemAnxSze' => $this->attCasFemAnxSze
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
        AND CasFemAnxCod = :CasFemAnxCod
        ";

        $parameters = array(
            ':CasFemCod' => $this->attCasFemCod,
            ':CasFemAnxCod' => $this->attCasFemAnxCod
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
        AND CasFemAnxCod = :CasFemAnxCod
        ";

        $parameters = array(
            ":CasFemCod" => $this->attCasFemCod,
            ":CasFemAnxCod" => $this->attCasFemAnxCod
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
