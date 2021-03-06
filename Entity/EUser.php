<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

//This is the EUser Class, a class made to handle all 
//kind of users of the application,
//this is going to be the main class for every action performed
/**
 * La classe EUser contiene tutti gli attributi e metodi base che sono adoperati da tutte
 * le tipologie di utente. Contiene metodi per impostare, ottenere, validare i seguenti attributi:
 * - nickname: il nome utente utilizzato nell'applicazione
 * - mail: l'indirizzo utilizzato in fase di registrazione
 * - password: la password per accedere nell'applicazione
 * - info: oggetto EUserInfo contenente informazioni da modificare e visualizzabili nel profilo
 * - img: oggetto EImg contenente l'immagine da visualizzare nel profilo
 * @author gruppo2
 * @package Entity
 */
class EUser extends EObject
{
    /** il nome dell'utente */
    protected $nickname; 
    /** la mail dell'utente */
    protected $mail; 
    /** la password dell'utente */
    protected $password; 
    /** EUserInfo rappresentante le informazioni dell'utente */
    protected $userInfo;
    /** EImg rappresentante l'immagine dell'utente */
    protected $img; 
     
    /**
     * 
     */    
    function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * Metodo che verifica se l'email dell'istanza sia corretta. Una email corretta
     * e' nella forma domain@example.com
     * @return bool true se l'email e' corretta, false altrimenti
     */
    function validateMail() : bool
    {
        if($this->mail && filter_var($this->mail, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        else
            return false;
    }
    
    /**
     * Metodo che verifica se l'email dell'istanza sia corretta. Una password corretta
     * deve contenere almeno un numero, almeno una lettera minuscola e almeno una lettera maiuscola
     * @return bool true se la password e' corretta, false altrimenti
     */
    function validatePassword() : bool
    {
        if($this->password && preg_match('/^[[:alnum:]]{6,20}$/', $this->password)) // solo numeri-lettere da 6 a 20
        {
            return true;
        }
        else
            return false;
    }
    
    /**
     * Metodo che effettua l'hash della password
     */
    function hashPassword () 
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
    
    /**
     * Metodo che controllo se la password dell'oggetto sia corrispondente alla entry nel database
     * che contiene lo stesso id dell'oggetto che ha richiamato il metodo
     * @param string $pwd la password 
     * @return bool
     */
    function checkPassword () : bool
    {
        return password_verify($this->password, FPersistantManager::getInstance()->load(EUser::class, $this->id)->getPassword());
    }
    
    /**
     * Metodo che verifica se il nickname dell'istanza sia corretto. Un nickname si intende corretto
     * quando contiene solo caratteri alfanumerici, per una lunghezza tra 3 e 20 caratteri.
     * @return bool true se il nickname e' corretto, false altrimenti
     */
    function validateNickName() : bool
    {
        if ($this->nickname && preg_match('/^[a-zA-Z0-9_-]{6,15}$/', $this->nickname))
        {
            return true;
        }
        else 
            return false;
    }
    
    /**
     * 
     * @return string il nickname dell'utente
     */
    function getNickName () : string
    {
        return $this->nickname;
    }
    
    /**
     * 
     * @param string $nickname il nickname dell'utente
     */
    function setNickName (string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    /**
     * Restituisce le info dell'utente
     * @return EUserInfo|NULL
     */
    function getUserInfo()
    {
        $uInfo = FPersistantManager::getInstance()->load(EUserInfo::class, $this->id); 
        if($uInfo)
            $this->userInfo = $uInfo;
        else 
            $this->userInfo = new EUserInfo();
        return $this->userInfo;
    }
    
    /**
     * Imposta le informazioni dell'utente
     * @param EUserInfo $info 
     */
    function setUserInfo(EUserInfo $info = null)
    {
        if(!$info)
            $info = new EUserInfo();
        
        $info->setId($this->id);
        $this->userInfo = $info;
        
        if(!FPersistantManager::getInstance()->load(EUserInfo::class, $this->id)) // se le informazioni non sono presenti...
        { //vengono caricate nel db
            FPersistantManager::getInstance()->store($this->userInfo);
        }
        else 
        { //altrimenti vengono aggiornate
            FPersistantManager::getInstance()->update($this->userInfo);
        }
        
        
    }
    
    /**
     * Restituisce l'immagine dell'utente
     * @return EImg | NULL
     */
    function getImage()
    {
        $this->img = FPersistantManager::getInstance()->load(EImg::class, $this->id);
        return $this->img;
    }
    
    /**
     * Imposta l'immagine dell'utente
     * @param EImg $img
     */
    function setImage(EImg $img = null)
    {
        if(!$img)
        {
            $img = new EImg();
            $img->setStatic();
        }
        
        $img->setId($this->id);
        
        if(!FPersistantManager::getInstance()->load(EImg::class, $this->id)) // se le informazioni non sono presenti...
        { // vengono salvate nel db
            FPersistantManager::getInstance()->store($img); 
        }
        else
        { // altrimenti vengono aggiornate
            FPersistantManager::getInstance()->update($img);
        }
        
        $this->img = $img;
    }
    
    /**
     * 
     * @return string la paswword dell'utente
     */
    function getPassword () : string
    {
        return $this->password;
    }
    
    /**
     * 
     * @param string $pwd la password dell'utente
     */
    function setPassword (string $pwd)
    {
        $this->password = $pwd;
    }
    
    /**
     * 
     * @return string la mail dell'utente
     */
    function getMail () : string
    {
        return $this->mail;
    }
    
    /**
     * 
     * @param string $mail la mail dell'utente
     */
    function setMail (string $mail)
    {
        $this->mail = $mail;
    }
    
    /**
     * Funzione che ritorna i follower dell'utente
     * @return array di EUser se l'utente ha follower | NULL se l'utente non ha follower 
     */
    function getFollower() 
    {
        return FPersistantManager::getInstance()->load(EUser::class, $this->id, FTarget::LOAD_FOLLOWERS);
    }
    
    /**
     * Funzione che ritorna gli utenti seguiti.
     * @return array di EUser se l'utente segue qualche utente | NULL se l'utente non segue nessuno
     */
    function getFollowing()
    {
        return FPersistantManager::getInstance()->load(EUser::class, $this->id, FTarget::LOAD_FOLLOWING);
    }
    
    
    function __toString()
    {
        return "Nome: ".$this->nickname."\nId: ".$this->id;
    }
    
    
}
