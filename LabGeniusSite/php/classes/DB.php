<?php



// Offline
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'labgenius');

// Online
// define('HOST', 'sql9.freemysqlhosting.net');
// define('USER', 'sql9264103');
// define('PASS', 'hw8rM8qCsP');
// define('DB', 'sql9264103');


class DB{
    private static $instance;

    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                //self::$instance = new PDO('mysql:host=localhost; dbname=labgenius', USER, PASS);
                self::$instance = new PDO('mysql:host='.HOST.'; dbname='.DB.'', USER, PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        return self::$instance;
    }


    public static function prepare($sql){
        return self::getInstance()->prepare($sql);
    }


}


