<?php

/**
 * Class Db
 */
class Db{
    static private $_instance;
    private $_dbConfig = array(
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'wing-root',
            'database' => 'app',
        );
    static private $_connectSource;

    private function __construct(){
        
    }

    /**
     * @return Db
     */
    static public function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return  self::$_instance;
    }

    /**
     * @return mysqli
     * @throws Exception
     */
    public function connect(){
        if(!self::$_connectSource){
            self::$_connectSource = mysqli_connect(
                $this->_dbConfig['host'],
                $this->_dbConfig['user'],
                $this->_dbConfig['password'],
                $this->_dbConfig['database']
            );
            if(!self::$_connectSource){
                //die('mysql connect error' . mysqli_error());
                throw new Exception('mysql connect error' . mysqli_error());
            }
            mysqli_query(self::$_connectSource,'set names UTF8') ;
        }
        return self::$_connectSource;  
    }
}


