<?php   
/**
 * Description of FPersistantManager
 * This foundation class provides a unique access to the Mysql DBMS, its aim is 
 * to use the static methods of all the other foundation classes in order to 
 * gather the information required by the upper layers.
 * @author gruppo 2
 */
 
require_once 'config.inc.php';
require_once 'inc.php';

class FPersistantManager {
    
    private static $instance = null; 	// the unique instance of the class
    private $db; 						// mysqli's database

    private function __construct()
    {
        global $address,$user,$pass,$database;
        $this->db = new mysqli($address, $user, $pass, $database);
        if($this->db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
    }

    private function __clone(){
        // evita la clonazione dell'oggetto
    }

    public static function getInstance(){
        if (static::$instance == null) {
            static::$instance = new FPersistantManager();
        }
        return static::$instance;
    }
    
    public function load($className){
        $result;
        switch($className){
            case('E'.$className=='EMusician'):
                break;
            case('E'.$className=='EListener'):
                break;
            case('E'.$className=='ESong'):
                
                break;
            default:
                break;
        }
        return $result;        
    }
    
    public function store($obj){
        $result;
        switch($obj){
            case(is_a($obj, EMusician::class)):
                $result=FMusician::getMusician($this->db, $name);
                break;
            case(is_a($obj, EListener::class)):
                break;
            case(is_a($obj, ESong::class)):
                if(FSong::storeSong($this->db, $obj))
                    echo("Caricamento effettuato.");
                else echo("Caricamento fallito.");
                break;
            default:
                break;
        }
    }
	
	public function update($obj){
        $result;
        switch($obj){
            case(is_a($obj, EMusician::class)):
                break;
            case(is_a($obj, EListener::class)):
                break;
            case(is_a($obj, ESong::class)):
                if(FSong::updateSong($this->db, $obj))
                    echo("Aggiornamento effettuato.");
                else echo("Aggiornamento fallito.");
                break;
            default:
                break;
        }
    }
}

