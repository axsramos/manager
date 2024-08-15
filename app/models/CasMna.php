<?php

namespace app\models;

use app\core\Database;
use MessageDictionary;
use PDO;

require_once('app/shared/message_dictionary.php');

class CasMna
{
    // -- attributes -- //
    private $attCasMnuCod;
    private $attCasMnaCod;
    private $attCasMnaDca;
    private $attCasMnaDmd;
    private $attCasMnaDsc;
    private $attCasMnaBlq;
    private $attCasMnaLnk;
    private $attCasMnaOrd;
    private $attCasMnaGrp;

    // -- database -- //
    private $cnx;
    private $tbl = 'CasMna';

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
    public function getCasMnaCod()
    {
        return $this->attCasMnaCod;
    }
    public function getCasMnaDca()
    {
        return $this->attCasMnaDca;
    }
    public function getCasMnaDmd()
    {
        return $this->attCasMnaDmd;
    }
    public function getCasMnaDsc()
    {
        return $this->attCasMnaDsc;
    }
    public function getCasMnaBlq()
    {
        return $this->attCasMnaBlq;
    }
    public function getCasMnaLnk()
    {
        return $this->attCasMnaLnk;
    }
    public function getCasMnaOrd()
    {
        return $this->attCasMnaOrd;
    }
    public function getCasMnaGrp()
    {
        return $this->attCasMnaGrp;
    }

    // -- set -- //
    public function setCasMnuCod($inCasMnuCod)
    {
        $this->attCasMnuCod = $inCasMnuCod;
    }
    public function setCasMnaCod($inCasMnaCod)
    {
        $this->attCasMnaCod = $inCasMnaCod;
    }
    public function setCasMnaDca($inCasMnaDca)
    {
        $this->attCasMnaDca = $inCasMnaDca;
    }
    public function setCasMnaDmd($inCasMnaDmd)
    {
        $this->attCasMnaDmd = $inCasMnaDmd;
    }
    public function setCasMnaDsc($inCasMnaDsc)
    {
        $this->attCasMnaDsc = $inCasMnaDsc;
    }
    public function setCasMnaBlq($inCasMnaBlq)
    {
        $this->attCasMnaBlq = $inCasMnaBlq;
    }
    public function setCasMnaLnk($inCasMnaLnk)
    {
        $this->attCasMnaLnk = $inCasMnaLnk;
    }
    public function setCasMnaOrd($inCasMnaOrd)
    {
        $this->attCasMnaOrd = $inCasMnaOrd;
    }
    public function setCasMnaGrp($inCasMnaGrp)
    {
        $this->attCasMnaGrp = $inCasMnaGrp;
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CasMnuCod,    
            CasMnaCod,
            CasMnaDca,
            CasMnaDmd,
            CasMnaDsc,
            CasMnaBlq,
            CasMnaLnk,
            CasMnaOrd,
            CasMnaGrp
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
            CasMnaCod,
            CasMnaDca,
            CasMnaDmd,
            CasMnaDsc,
            CasMnaBlq,
            CasMnaLnk,
            CasMnaOrd,
            CasMnaGrp
        FROM
        " . $this->tbl . "
        WHERE
            CasMnuCod = :CasMnuCod
        AND CasMnaCod = :CasMnaCod
        ";

        $parameters = array(
            ":CasMnuCod" => $this->attCasMnuCod,
            ":CasMnaCod" => $this->attCasMnaCod
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
            CasMnaCod,
            CasMnaDca,
            CasMnaDmd,
            CasMnaDsc,
            CasMnaBlq,
            CasMnaLnk,
            CasMnaOrd,
            CasMnaGrp
        )
        VALUES
        (
            :CasMnuCod,    
            :CasMnaCod,
            :CasMnaDca,
            :CasMnaDmd,
            :CasMnaDsc,
            :CasMnaBlq,
            :CasMnaLnk,
            :CasMnaOrd,
            :CasMnaGrp
        )
        ";

        $parameters = array(
            ':CasMnuCod' => $this->attCasMnuCod,
            ':CasMnaCod' => $this->attCasMnaCod,
            ':CasMnaDca' => $this->attCasMnaDca,
            ':CasMnaDmd' => $this->attCasMnaDmd,
            ':CasMnaDsc' => $this->attCasMnaDsc,
            ':CasMnaBlq' => $this->attCasMnaBlq,
            ':CasMnaLnk' => $this->attCasMnaLnk,
            ':CasMnaOrd' => $this->attCasMnaOrd,
            ':CasMnaGrp' => $this->attCasMnaGrp
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
            CasMnaDmd = :CasMnaDmd,
            CasMnaDsc = :CasMnaDsc,
            CasMnaBlq = :CasMnaBlq,
            CasMnaLnk = :CasMnaLnk,
            CasMnaOrd = :CasMnaOrd,
            CasMnaGrp = :CasMnaGrp
        WHERE
            CasMnuCod = :CasMnuCod
        AND CasMnaCod = :CasMnaCod
        ";

        $parameters = array(
            ':CasMnuCod' => $this->attCasMnuCod,
            ':CasMnaCod' => $this->attCasMnaCod,
            ':CasMnaDmd' => $this->attCasMnaDmd,
            ':CasMnaDsc' => $this->attCasMnaDsc,
            ':CasMnaBlq' => $this->attCasMnaBlq,
            ':CasMnaLnk' => $this->attCasMnaLnk,
            ':CasMnaOrd' => $this->attCasMnaOrd,
            ':CasMnaGrp' => $this->attCasMnaGrp
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
        AND CasMnaCod = :CasMnaCod
        ";

        $parameters = array(
            ':CasMnuCod' => $this->attCasMnuCod,
            ':CasMnaCod' => $this->attCasMnaCod
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
            CasMnuCod,    
            CasMnaCod
        FROM
        " . $this->tbl . "
        WHERE
            CasMnuCod = :CasMnuCod
        AND CasMnaCod = :CasMnaCod
        ";

        $parameters = array(
            ":CasMnuCod" => $this->attCasMnuCod,
            ":CasMnaCod" => $this->attCasMnaCod
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
