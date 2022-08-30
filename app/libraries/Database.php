<?php
    class Database {
        //db stuff
        private $host = DB_HOST;
        private $dbname = DB_NAME;
        private $user = DB_USER;
        private $pass = DB_PASS;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            //SET DNS
            $dns = "mysql:host={$this->host};dbname={$this->dbname}";
            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            //CREATE PDO INSTANCE
            try{
                $this->dbh = new PDO($dns, $this->user, $this->pass, $options);
            }catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //prepare query
        public function query($sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }

        //bind pamas
        public function bind($param, $value, $type = null) {
            if(is_null($type)) {
                switch(true) {
                    case is_int($value) :
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value) :
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value) : 
                        $type = PDO::PARAM_NULL;
                        break;
                    default :
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        //execute the prepared stmt
        public function execute() {
            return $this->stmt->execute();
        }

        //get all result as a array object
        public function getResult() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //get a single record as a obj
        public function singleRecorde() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //rowCount
        public function rowCount() {
            return $this->stmt->rowCount();
        }

        
    }