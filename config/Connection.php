<?php 
  class ConnectionDB{
    public function connect(): PDO
    {
      try {
        $USER = 'root';
        $DNS = 'mysql:host=localhost;dbname=dev_users_ajax';
        $PASSWORD = '';
        $pdo = new PDO($DNS, $USER, $PASSWORD);
        return $pdo;
      } catch (PDOException $e) {
        echo $e->getMessage();
        die;
      }
    }
  }
