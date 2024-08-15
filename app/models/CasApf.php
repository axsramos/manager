<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasApf
{
    // -- attributes -- //
    private $attCasPfiCod;
    private $attCasUsrCod;
    private $attCasPrgCod;
    private $attCasApfDca;
    private $attCasApfDmd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasApf';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasPfiCod()
    {
        return $this->attCasPfiCod;
    }
    public function getCasUsrCod()
    {
        return $this->attCasUsrCod;
    }
    public function getCasPrgCod()
    {
        return $this->attCasPrgCod;
    }
    public function getCasApfDca()
    {
        return $this->attCasApfDca;
    }
    public function getCasApfDmd()
    {
        return $this->attCasApfDmd;
    }

    // -- set -- //
    public function setCasPfiCod($inCasPfiCod)
    {
        $this->attCasPfiCod = $inCasPfiCod;
    }
    public function setCasUsrCod($inCasUsrCod)
    {
        $this->attCasUsrCod = $inCasUsrCod;
    }
    public function setCasPrgCod($inCasPrgCod)
    {
        $this->attCasPrgCod = $inCasPrgCod;
    }
    public function setCasApfDca($inCasApfDca)
    {
        $this->attCasApfDca = $inCasApfDca;
    }
    public function setCasApfDmd($inCasApfDmd)
    {
        $this->attCasApfDmd = $inCasApfDmd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasPfiCod,
            CasUsrCod,
            CasPrgCod,
            CasApfDca,
            CasApfDmd
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
            CasPfiCod,
            CasUsrCod,
            CasPrgCod,
            CasApfDca,
            CasApfDmd
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod,
            ":CasUsrCod" => $this->attCasUsrCod,
            ":CasPrgCod" => $this->attCasPrgCod
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
            CasPfiCod,
            CasUsrCod,
            CasPrgCod,
            CasApfDca,
            CasApfDmd
        )
        VALUES
        (
            :CasPfiCod,
            :CasUsrCod,
            :CasPrgCod,
            :CasApfDca,
            :CasApfDmd
        )
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasApfDca' => $this->attCasApfDca,
            ':CasApfDmd' => $this->attCasApfDmd
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
            CasApfDmd = :CasApfDmd
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasApfDmd' => $this->attCasApfDmd
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
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
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
            CasPfiCod,
            CasUsrCod,
            CasPrgCod
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod,
            ":CasUsrCod" => $this->attCasUsrCod,
            ":CasPrgCod" => $this->attCasPrgCod
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
