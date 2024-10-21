<?php

class userModel {

    protected $db;

    public function __construct(){
        $this->db = $this->getConnection();
        $this->_deploy();
    }

    public function getConnection () {
        return new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END

            END;
            $this->db->query($sql);
        }
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');

        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }
} 