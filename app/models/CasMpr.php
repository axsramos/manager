<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasMpr
{
    // -- attributes -- //
    private $attCasMdlCod;
    private $attCasPrgCod;
    private $attCasMprDca;
    private $attCasMprDmd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasMpr';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasMdlCod()
    {
        return $this->attCasMdlCod;
    }
    public function getCasPrgCod()
    {
        return $this->attCasPrgCod;
    }
    public function getCasMprDca()
    {
        return $this->attCasMprDca;
    }
    public function getCasMprDmd()
    {
        return $this->attCasMprDmd;
    }

    // -- set -- //
    public function setCasMdlCod($inCasMdlCod)
    {
        $this->attCasMdlCod = $inCasMdlCod;
    }
    public function setCasPrgCod($inCasPrgCod)
    {
        $this->attCasPrgCod = $inCasPrgCod;
    }
    public function setCasMprDca($inCasMprDca)
    {
        $this->attCasMprDca = $inCasMprDca;
    }
    public function setCasMprDmd($inCasMprDmd)
    {
        $this->attCasMprDmd = $inCasMprDmd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasMdlCod,
            CasPrgCod,
            CasMprDca,
            CasMprDmd
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
            CasMdlCod,
            CasPrgCod,
            CasMprDca,
            CasMprDmd
        FROM
        " . $this->tbl . "
        WHERE
            CasMdlCod = :CasMdlCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasMdlCod" => $this->attCasMdlCod,
            ':CasPrgCod' => $this->attCasPrgCod
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
            CasMdlCod,
            CasPrgCod,
            CasMprDca,
            CasMprDmd
        )
        VALUES
        (
            :CasMdlCod,
            :CasPrgCod,
            :CasMprDca,
            :CasMprDmd
        )
        ";

        $parameters = array(
            ':CasMdlCod' => $this->attCasMdlCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasMprDca' => $this->attCasMprDca,
            ':CasMprDmd' => $this->attCasMprDmd
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
            CasMprDmd = :CasMprDmd
        WHERE
            CasMdlCod = :CasMdlCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasMdlCod' => $this->attCasMdlCod,
            ':CasPrgCod' => $this->attCasPrgCod,
            ':CasMprDmd' => $this->attCasMprDmd
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
            CasMdlCod = :CasMdlCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ':CasMdlCod' => $this->attCasMdlCod,
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
            CasMdlCod,
            CasPrgCod
        FROM
        " . $this->tbl . "
        WHERE
            CasMdlCod = :CasMdlCod
        AND CasPrgCod = :CasPrgCod
        ";

        $parameters = array(
            ":CasMdlCod" => $this->attCasMdlCod,
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
