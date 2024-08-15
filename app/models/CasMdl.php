<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasMdl
{
    // -- attributes -- //
    private $attCasMdlCod;
    private $attCasMdlDca;
    private $attCasMdlDmd;
    private $attCasMdlDsc;
    private $attCasMdlBlq;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasMdl';

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
    public function getCasMdlDca()
    {
        return $this->attCasMdlDca;
    }
    public function getCasMdlDmd()
    {
        return $this->attCasMdlDmd;
    }
    public function getCasMdlDsc()
    {
        return $this->attCasMdlDsc;
    }
    public function getCasMdlBlq()
    {
        return $this->attCasMdlBlq;
    }

    // -- set -- //
    public function setCasMdlCod($inCasMdlCod)
    {
        $this->attCasMdlCod = $inCasMdlCod;
    }
    public function setCasMdlDca($inCasMdlDca)
    {
        $this->attCasMdlDca = $inCasMdlDca;
    }
    public function setCasMdlDmd($inCasMdlDmd)
    {
        $this->attCasMdlDmd = $inCasMdlDmd;
    }
    public function setCasMdlDsc($inCasMdlDsc)
    {
        $this->attCasMdlDsc = $inCasMdlDsc;
    }
    public function setCasMdlBlq($inCasMdlBlq)
    {
        $this->attCasMdlBlq = $inCasMdlBlq;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasMdlCod,
            CasMdlDca,
            CasMdlDmd,
            CasMdlDsc,
            CasMdlBlq
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
            CasMdlDca,
            CasMdlDmd,
            CasMdlDsc,
            CasMdlBlq
        FROM
        " . $this->tbl . "
        WHERE
            CasMdlCod = :CasMdlCod
        ";

        $parameters = array(
            ":CasMdlCod" => $this->attCasMdlCod
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
            CasMdlDca,
            CasMdlDmd,
            CasMdlDsc,
            CasMdlBlq
        )
        VALUES
        (
            :CasMdlCod,
            :CasMdlDca,
            :CasMdlDmd,
            :CasMdlDsc,
            :CasMdlBlq
        )
        ";

        $parameters = array(
            ':CasMdlCod' => $this->attCasMdlCod,
            ':CasMdlDca' => $this->attCasMdlDca,
            ':CasMdlDmd' => $this->attCasMdlDmd,
            ':CasMdlDsc' => $this->attCasMdlDsc,
            ':CasMdlBlq' => $this->attCasMdlBlq
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
            CasMdlDmd = :CasMdlDmd,
            CasMdlDsc = :CasMdlDsc,
            CasMdlBlq = :CasMdlBlq
        WHERE
            CasMdlCod = :CasMdlCod
        ";

        $parameters = array(
            ':CasMdlCod' => $this->attCasMdlCod,
            ':CasMdlDmd' => $this->attCasMdlDmd,
            ':CasMdlDsc' => $this->attCasMdlDsc,
            ':CasMdlBlq' => $this->attCasMdlBlq
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
        ";

        $parameters = array(
            ':CasMdlCod' => $this->attCasMdlCod
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
            CasMdlCod
        FROM
        " . $this->tbl . "
        WHERE
            CasMdlCod = :CasMdlCod
        ";

        $parameters = array(
            ":CasMdlCod" => $this->attCasMdlCod
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
