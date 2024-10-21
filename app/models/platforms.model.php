<?php

class platformsModel {
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

    public function getPlatforms() {
        $queryPlataformas = $this->db->prepare('SELECT * FROM plataformas');
        $queryPlataformas->execute();

        $platforms = $queryPlataformas->fetchAll(PDO::FETCH_OBJ);

        return $platforms;
    }

    public function getPlatformById($id) {
        $query = $this->db->prepare('SELECT * FROM plataformas WHERE id_plataforma = ?');
        $query->execute([$id]);
        $platform = $query->fetch(PDO::FETCH_OBJ);
        return $platform;

    }
    public function addPlatform($plataforma, $fabricante, $tipo) {
        $query = $this->db->prepare('INSERT INTO plataformas(plataforma, fabricante, tipo) VALUES (?,?,?)');
        $query->execute([$plataforma, $fabricante, $tipo]);
        return $this->db->lastInsertId();
    }

    public function deletePlataform($id) {
        $queryPlataformas = $this->db->prepare('DELETE FROM plataformas WHERE id_plataforma = ?');
        $queryPlataformas->execute([$id]);
    }

    public function updatePlatform($plataforma, $fabricante, $tipo, $id) {
        $queryPlataformas = $this->db->prepare('UPDATE plataformas SET plataforma = ?, fabricante = ?, tipo = ? WHERE id_plataforma = ?');
        $queryPlataformas->execute([$plataforma, $fabricante, $tipo, $id]);
    }
}