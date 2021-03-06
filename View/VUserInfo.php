<?php

require_once 'inc.php';
include_once 'View/VObject.php';

/**
 * 
 * @author gruppo2
 * @package View
 */
class VUserInfo extends VObject
{
    /**
     * 
     */
    function __construct()
    {
        parent::__construct();
        
        $this->check = array(
            'firstName' => true,
            'lastName' => true,
            'birthPlace' => true,
            'birthDate' => true,
            'bio' => true,
            'file' => true
        );
    }
    
    /**
     * Funzione che permette la creazione delle info utente con i valori prelevati da una form
     * @return EUserInfo ottenuta dai campi della form
     */
    function createUserInfo() : EUserInfo
    {
        $userInfo = new EUserInfo();
        
        if(isset($_POST['firstName']))
            $userInfo->setFirstName($_POST['firstName']);
        if(isset($_POST['lastName']))
            $userInfo->setLastName($_POST['lastName']);
        if(isset($_POST['birthPlace']))
            $userInfo->setBirthPlace($_POST['birthPlace']);
        if(isset($_POST['birthDate']))
            $userInfo->setBirthDate($_POST['birthDate']);
        if(isset($_POST['bio']))
            $userInfo->setBio($_POST['bio']);
        if(isset($_POST['genre']))
            $userInfo->setGenre($_POST['genre']);
    
        return $userInfo;
    }
    
    /**
     * Funzione che permette la creazione delle info utente con i valori prelevati da una form
     * @return EUserInfo ottenuta dai campi della form
     */
    function  createUserPic() : EImg
    {
        $img = new EImg();
        
        if($_FILES['file']['size']!=0)
        {
            $img->setImg(file_get_contents($_FILES['file']['tmp_name']));
            $img->setSize($_FILES['file']['size']);
            $img->setType($_FILES['file']['type']);
        }
        return $img;
    }
    
   
    /**
     * Controlla se l'oggetto EUserInfo sia valido
     * @param EUserInfo $eui di norma e' un oggetto ottenuto dal metodo createUserInfo()
     * @return true se l'oggetto e' valido, false altrimenti
     */
    function validateUserInfo(EUserInfo &$eui) : bool
    {
        $eui->validate($this->check['firstName'], $this->check['lastName'], $this->check['birthPlace'], $this->check['birthDate'], $this->check['bio']);
        
        if($this->check['firstName'] && $this->check['lastName'] && $this->check['birthPlace'] && $this->check['birthDate'])
            return true;
        else 
            return false;
    }
    
    /**
     * 
     * @param EImg $img
     * @return boolean
     */
    function validateImg(EImg &$img)
    {
        $img->validate($this->check['file']);
        if($this->check['file'])
            return true;
        else 
            return false;
    }
    
    /**
     * Mostra la form di modifica delle info utente
     *
     * @param bool $error
     *            facoltativo se presente un errore
     */
    function showUserInfoForm(EUser &$user, bool $error = NULL)
    {
        if (! $error)
            $error = false;
          
        $userInfo = $user->getUserInfo();

        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uInfo', $userInfo);
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        
        $this->smarty->assign('error', $error);
        $this->smarty->assign('check', $this->check);
        
        $this->smarty->display('user/registerUserInfo.tpl');
    }
    
    
}

?>