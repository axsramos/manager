<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasMnu
{
    // -- attributes -- //
    private $attCasMnuCod;
    private $attCasMnuDca;
    private $attCasMnuDmd;
    private $attCasMnuDsc;
    private $attCasMnuBlq;
    private $attCasMnuVch;
    private $attCasMnuOrd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasMnu';

    public $messages = array();

    public function __construct()
    {
        $this->cnx = new Database();
    }

    // -- get -- //
    public function getCasMnuCod()
    {
        return $this->attCasMnuCod;
    }
    public function getCasMnuDca()
    {
        return $this->attCasMnuDca;
    }
    public function getCasMnuDmd()
    {
        return $this->attCasMnuDmd;
    }
    public function getCasMnuDsc()
    {
        return $this->attCasMnuDsc;
    }
    public function getCasMnuBlq()
    {
        return $this->attCasMnuBlq;
    }
    public function getCasMnuVch()
    {
        return $this->attCasMnuVch;
    }
    public function getCasMnuOrd()
    {
        return $this->attCasMnuOrd;
    }

    // -- set -- //
    public function setCasMnuCod($inCasMnuCod)
    {
        $this->attCasMnuCod = $inCasMnuCod;
    }
    public function setCasMnuDca($inCasMnuDca)
    {
        $this->attCasMnuDca = $inCasMnuDca;
    }
    public function setCasMnuDmd($inCasMnuDmd)
    {
        $this->attCasMnuDmd = $inCasMnuDmd;
    }
    public function setCasMnuDsc($inCasMnuDsc)
    {
        $this->attCasMnuDsc = $inCasMnuDsc;
    }
    public function setCasMnuBlq($inCasMnuBlq)
    {
        $this->attCasMnuBlq = $inCasMnuBlq;
    }
    public function setCasMnuVch($inCasMnuVch)
    {
        $this->attCasMnuVch = $inCasMnuVch;
    }
    public function setCasMnuOrd($inCasMnuOrd)
    {
        $this->attCasMnuOrd = $inCasMnuOrd;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasMnuCod,
            CasMnuDca,
            CasMnuDmd,
            CasMnuDsc,
            CasMnuBlq,
            CasMnuVch,
            CasMnuOrd
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
            CasMnuCod,
            CasMnuDca,
            CasMnuDmd,
            CasMnuDsc,
            CasMnuBlq,
            CasMnuVch,
            CasMnuOrd
        FROM
        " . $this->tbl . "
        WHERE
            CasMnuCod = :CasMnuCod
        ";

        $parameters = array(
            ":CasMnuCod" => $this->attCasMnuCod
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
            CasMnuCod,
            CasMnuDca,
            CasMnuDmd,
            CasMnuDsc,
            CasMnuBlq,
            CasMnuVch,
            CasMnuOrd
        )
        VALUES
        (
            :CasMnuCod,
            :CasMnuDca,
            :CasMnuDmd,
            :CasMnuDsc,
            :CasMnuBlq,
            :CasMnuVch,
            :CasMnuOrd
        )
        ";

        $parameters = array(
            ':CasMnuCod' => $this->attCasMnuCod,
            ':CasMnuDca' => $this->attCasMnuDca,
            ':CasMnuDmd' => $this->attCasMnuDmd,
            ':CasMnuDsc' => $this->attCasMnuDsc,
            ':CasMnuBlq' => $this->attCasMnuBlq,
            ':CasMnuVch' => $this->attCasMnuVch,
            ':CasMnuOrd' => $this->attCasMnuOrd
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
            CasMnuDmd = :CasMnuDmd,
            CasMnuDsc = :CasMnuDsc,
            CasMnuBlq = :CasMnuBlq,
            CasMnuVch = :CasMnuVch,
            CasMnuOrd = :CasMnuOrd
        WHERE
            CasMnuCod = :CasMnuCod
        ";

        $parameters = array(
            ':CasMnuCod' => $this->attCasMnuCod,
            ':CasMnuDmd' => $this->attCasMnuDmd,
            ':CasMnuDsc' => $this->attCasMnuDsc,
            ':CasMnuBlq' => $this->attCasMnuBlq,
            ':CasMnuVch' => $this->attCasMnuVch,
            ':CasMnuOrd' => $this->attCasMnuOrd
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
            CasMnuCod = :CasMnuCod
        ";

        $parameters = array(
            ':CasMnuCod' => $this->attCasMnuCod
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
            CasMnuCod
        FROM
        " . $this->tbl . "
        WHERE
            CasMnuCod = :CasMnuCod
        ";

        $parameters = array(
            ":CasMnuCod" => $this->attCasMnuCod
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
