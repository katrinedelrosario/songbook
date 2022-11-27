<?php
/**
 * Class dbconf
 * Klasse til database oplysninger
 * Nedarver db klassen og opretter forbindelse til database
 */

class dbconf extends db {
    function __construct() {
        $this->dbhost = "sql.itcn.dk:3306";
	    $this->dbuser = "katr5252.SKOLE";
        $this->dbpassword = "Y2eP18aT8j";
        $this->dbname = "katr52522.SKOLE";
        $db = parent::connect();
    }
}
