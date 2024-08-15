<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasAfu
{
    // -- attributes -- //
    private $attCasPfiCod;
    private $attCasUsrCod;
    private $attCasPrgCod;
    private $attCasFunCod;
    private $attCasAfuDca;
    private $attCasAfuDmd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasAfu';

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
    public function getCasFunCod()
    {
        return $this->attCasFunCod;
    }
    public function getCasAfuDca()
    {
        return $this->attCasAfuDca;
    }
    public function getCasAfuDmd()
    {
        return $this->attCasAfuDmd;
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
    public function setCasFunCod($inCasFunCod)
    {
        $this->attCasFunCod = $inCasFunCod;
    }
    public function setCasAfuDca($inCasAfuDca)
    {
        $this->attCasAfuDca = $inCasAfuDca;
    }
    public function setCasAfuDmd($inCasAfuDmd)
    {
        $this->attCasAfuDmd = $inCasAfuDmd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasPfiCod,
            CasUsrCod,
            CasPrgCod,
            CasFunCod,
            CasAfuDca,
            CasAfuDmd
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
            CasFunCod,
            CasAfuDca,
            CasAfuDmd
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        AND CasFunCod = :CasFunCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod,
            ":CasUsrCod" => $this->attCasUsrCod,
            ":CasPrgCod" => $this->attCasPrgCod,
            ":CasFunCod" => $this->attCasFunCod
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
            CasFunCod,
            CasAfuDca,
            CasAfuDmd
        )
        VALUES
        (
            :CasPfiCod,
            :CasUsrCod,
            :CasPrgCod,
            :CasFunCod,
            :CasAfuDca,
            :CasAfuDmd
        )
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasFunCod' => $this->attCasFunCod,
            ':CasAfuDca' => $this->attCasAfuDca,
            ':CasAfuDmd' => $this->attCasAfuDmd
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
            CasAfuDmd = :CasAfuDmd
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        AND CasFunCod = :CasFunCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasFunCod' => $this->attCasFunCod,
            ':CasAfuDmd' => $this->attCasAfuDmd
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
        AND CasFunCod = :CasFunCod
        ";

        $parameters = array(
            ':CasPfiCod' => $this->attCasPfiCod,
            ':CasUsrCod' => $this->attCasUsrCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasFunCod' => $this->attCasFunCod
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
            CasPrgCod,
            CasFunCod
        FROM
        " . $this->tbl . "
        WHERE
            CasPfiCod = :CasPfiCod
        AND CasUsrCod = :CasUsrCod
        AND CasPrgCod = :CasPrgCod
        AND CasFunCod = :CasFunCod
        ";

        $parameters = array(
            ":CasPfiCod" => $this->attCasPfiCod,
            ":CasUsrCod" => $this->attCasUsrCod,
            ":CasPrgCod" => $this->attCasPrgCod,
            ":CasFunCod" => $this->attCasFunCod
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
