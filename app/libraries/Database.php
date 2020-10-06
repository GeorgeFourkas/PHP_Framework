<?php

    /*
    * PDO class Database
    *Connect to Database
    *Create PRepared statements
    *Bind Values
    *Return rows and results
    */

    class Database{
        private $host   = DB_HOST;
        private $user   = DB_USER;
        private $pass   = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh; //database handler
        private $stmt;
        private $error;
        

        public function __construct(){
            $dsn = 'mysql:host=' . $this->host .';dbname='. $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
            );

            // create a new pdo instance
            try{
                $this->dbh = new PDO($dsn, $this->user, $this->pass,$options);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Prepare Statement with query
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){

                    case is_int($value):
                        $type = PDO::PARAM_INT;
                    break;  

                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                    break; 

                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                    break; 

                    default:
                        $type = PDO::PARAM_STR;
                    break; 

                }
            }
            $this->stmt->bindValue($param, $value , $param);
        }

        //Execute the Prepared Statement

        public function execute(){
             $this->stmt->execute();
            

        }

        //Get result set as array of objects

        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        //Get a single Record as Object
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);

        }
        public function rowCount(){
            return $this->stmt->rowCount();
        }

    }
?>