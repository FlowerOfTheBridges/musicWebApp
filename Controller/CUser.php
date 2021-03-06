<?php

require_once 'inc.php';

/**
 * La classe CUser implementa la funzionalità 'Gestione Utenti'. I vari metodi permettono 
 * la creazione, autenticazione e visualizzazione di un profilo di un utente.
 * @author gruppo2 
 * @package Controller
 */
class CUser
{
    /**
     * Metodo che implementa il caso d'uso di login. Se richiamato tramite GET, fornisce
     * la pagina di login, se richiamato tramite POST cerca di autenticare l'utente attraverso
     * i valori che quest'ultimo ha fornito
     */
    static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') // se il metodo e' get...
        { //...carica la pagina del login, se l'utente e' effettivamente un guest
            $vUser = new VUser();
            $user = CSession::getUserFromSession();
            if(get_class($user)!=EGuest::class) // se l'utente non è guest, non puo accedere al login
            {
                $vUser->showErrorPage($user, 'Why are you doing this? Yuo\'re already logged!');
            }
            else
                $vUser->showLogin();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CUser::authentication();
        else
            header('Location: HTTP/1.1 Invalid HTTP method detected');
    }

    /**
     * Metodo che implementa il caso d'uso di registrazione. Se richiamato a seguito di una richiesta
     * GET da parte del client, mostra la form di compilazione; altrimenti se richiamato tramite POST
     * riceve i dati forniti dall'utente e procede con la creazione di un nuovo utente.
     */
    static function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') //se il metodo http utilizzato e' GET...
        { //...visualizza la pagina di signup, controllando che l'utente sia effettivamente un guest
            $vUser = new VUser();
            $user = CSession::getUserFromSession();
            if (get_class($user)!=EGuest::class) // se l'utente non è guest, non puo accedere al login
                $vUser->showErrorPage($user, 'Why are you doing this? Yuo\'re already logged!');
            else
                $vUser->showSignUp();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CUser::register();
        else
            header('Location: Invalid HTTP method detected');
    }
    
    /**
     * La funzione mostra il profilo di un utente. A seconda del tipo di URL, saranno visualizzati contenuti differenti.
     * In particolare:
     *  - /deepmusic/user/profile/id mostra la pagina base: per un musicista mostra la lista delle canzoni, per gli altri utenti un messaggio di benvenuto
     *  - /deepmusic/user/profile/id&followers mostra la lista dei follower
     *  - /deepmusic/user/profile/id&following mostra la lista dei following dell'utente
     * @param $string l'argomento della url. se non specificato, si viene reindirizzati ad una pagina di errore.
     */
    static function profile($id, $content = null)
    {
        $vUser = new VUser();
        $loggedUser = CSession::getUserFromSession();
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            if ($id) // se l'url ha almeno l'id si procede
            {
                if (is_numeric($id)) // se effettivamente la variabile id corrisponde ad un numero
                {
                    // si effettua il caricamento dell'utente
                    $profileUser = FPersistantManager::getInstance()->load(EUser::class, $id);
                    
                    if ($profileUser) // se l'utente esiste...
                    {
                        $following = false; // bool che denota se l'utente della sessione sta seguendo l'utente del profilo
                        
                        $follower = new EFollower();
                        $follower->setUser($profileUser);
                        $follower->setFollower($loggedUser);
                        
                        if($follower->isValid()) 
                        { // se l'id dei due utenti e' diverso, si verifica che l'associazione sia presente
                            $following = $follower->exists(); // verifica che l'utente della sessione segue l'utente del profilo
                        }
                        
                        $supporting = false; // bool che denota se l'utente della sessione sta seguendo l'utente del profilo
                        
                       if(get_class($profileUser) == EMusician::class) // se l'utente del profilo e' un musicista...
                       { // ...si costruisce l'utente ESupporter
                           $supporter = new ESupporter();
                           $supporter->setArtist($profileUser);
                           $supporter->setSupport($loggedUser);
                           if($supporter->isValid())
                           { // se l'id dei due utenti e' diverso, si verifica che se l'utente segue l'utente del profilo
                               $supporting = $supporter->exists();
                           }
                       }
                                         
                        $array = NULL; // array contenente i dati dell'utente da visualizzare
                        
                        if ($content == 'song')  // se il parametro e' song
                        { // si carica la lista delle canzoni dell'utente (caricate se musician, preferite se listener)
                            $array = FPersistantManager::getInstance()->load(ESong::class, $profileUser->getId(), FTarget::LOAD_MUSICIAN_SONG);
                            $content = 'Song List';
                        }
                        elseif($content == 'followers') // se il parametro e' follower
                        { // si carica la lista dei follower del profilo utente
                            $array = FPersistantManager::getInstance()->load(EUser::class, $profileUser->getId(), FTarget::LOAD_FOLLOWERS);
                            $content = 'Followers';
                        }
                        elseif ($content == 'following') // se il parametro e' following
                        { // si carica la lista dei following del profilo utente
                            $array = FPersistantManager::getInstance()->load(EUser::class, $profileUser->getId(), FTarget::LOAD_FOLLOWING);
                            $content = 'Following';
                        }
                        elseif ($content == 'supporters') // se il parametro e' following
                        { // si carica la lista dei following del profilo utente
                            $array = FPersistantManager::getInstance()->load(EUser::class, $profileUser->getId(), FTarget::LOAD_SUPPORTERS);
                            $content = 'Supporters';
                        }
                        elseif ($content == 'supporting') // se il parametro e' following
                        { // si carica la lista dei following del profilo utente
                            $array = FPersistantManager::getInstance()->load(EUser::class, $profileUser->getId(), FTarget::LOAD_SUPPORTING);
                            $content = 'Supporting';
                        }
                        else // se il contenuto non e' specificato, e' stato inserito solo l'id e quindi si visualizza la pagina base
                        {
                            if(get_class($profileUser)==EMusician::class)
                            { // per un musicista corrisponde alla lista delle canzoni caricate
                                $array = FPersistantManager::getInstance()->load(ESong::class, $profileUser->getId(), FTarget::LOAD_MUSICIAN_SONG);
                                $content = 'Song List';
                            }
                            else // altrimenti ad una semplice pagina di benvenuto
                                $content = 'None';
                        }
                        
                        $vUser->showProfile($profileUser, $loggedUser, $following, $supporting, $content, $array); // mostra il profilo
                    } 
                    else
                        $vUser->showErrorPage($loggedUser, 'The user id doesn\'t match any DeepMusic\'s user!');
                } 
                else
                    $vUser->showErrorPage($loggedUser, 'The URL is invalid!');
            } 
            else
                $vUser->showErrorPage($loggedUser, 'The URL is invalid!');
        } 
        else
            $vUser->showErrorPage($loggedUser, 'The URL has too few arguments');
    }
    
    /**
     * Effettua il logout.
     */
    static function logout()
    {
        CSession::destroySession();
        header('Location: /deepmusic/home');
    }
    
    /**
     * La funzione remove implementa il caso d'uso 'Rimuovi Utente' e permette la visualizzazione
     * della form per la rimozione di un utente, a seguito di una richiesta GET, o la conferma
     * dell'operazione da parte di un utente a seguito di una richiesta POST.
     *
     * @param int $id l'identificativo della cazone, prelevato dall'URL.
     */
    static function remove($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            CUser::showRemoveForm($id);
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            CUser::removeUser($id);
        }
        else
            header('Location: HTTP/1.1 405 Invalid HTTP method detected');
    }
    
    /**
     * La funzione Authentication verifica che le credenziali di accesso inserite da un utente
     * siano corrette: in tal caso, l'applicazione lo riporterà verso la sua pagina, altrimenti
     * restituirà la schermata di login, con un messaggio di errore
     */
    private function authentication()
    {
        $vUser = new VUser();
        $loggedUser = $vUser->createUser();
        
        if($vUser->validateLogin($loggedUser))
        {
            $authenticated = false; // bool per l'autenticazione
            
            $userId = FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $loggedUser->getNickName()); // si verifica che l'utente inserito matchi una entry nel db
            
            if($userId) // se e' stato prelevato un id...
            {
                
                $loggedUser->setId($userId); // viene assegnato all'utente l'user id
                
                if($loggedUser->checkPassword()) // se la password e' corretta
                {
                    unset($loggedUser); // l'istanza utilizzata per il login viene rimossa
                    $user = FPersistantManager::getInstance()->load(EUser::class, $userId); // viene caricato l'utente
                    
                    $authenticated = true; // l'utente e' autenticato
                    
                    CSession::startSession($user);
                    
                    header('Location: /deepmusic/index');
                }
            }
            
            if(!$authenticated)
                $vUser->showLogin(true);
                
        }
        else
            $vUser->showLogin();
            
    }
    
    /**
     * La funzione Register permette di creare un nuovo utente
     * ammesso che non vi siano presenti utenti con stessa mail o nome utente inseriti nella form
     */
    private function register()
    {
        $vUser = new VUser();
        $loggedUser = $vUser->createUser(); // viene creato un utente con i parametri della form
        
        if($vUser->validateSignUp($loggedUser))
        {
            if(!FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $loggedUser->getNickName())
                && !FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_MAIL, $loggedUser->getMail()))
            {
                // se il nickname e la mail non sono stati ancora usati, si puo salvare l'utente
                
                $loggedUser->hashPassword(); // si cripta la password
                
                FPersistantManager::getInstance()->store($loggedUser); // si salva l'utente
                
                CSession::startSession($loggedUser);
                
                if(is_a($loggedUser, EMusician::class)) // se l'utente e' musicista...
                {
                    $loggedUser->setSupportInfo(); // ..carica le info di supporto di default
                }
                
                $loggedUser->setUserInfo();
                $loggedUser->setImage();
  
        
                header('Location: /deepmusic/userInfo/editInfo/');
            }
            else
                $vUser->showSignUp(true);
        }
        else
            $vUser->showSignUp();
    }
    
    /**
     * Mostra la form per la rimozione di un utente. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un utente registrato.
     * @param int $id l'identificativo dell'utente da rimuovere. Tale identificativo puo' essere
     * specificato SOLO da un moderatore.
     */
    private function showRemoveForm($id = null)
    {
        $vUser = new VUser();
        $user = CSession::getUserFromSession();
        
        if(is_numeric($id)) // verifica che nell'url sia stato inserito un id
        { // verifica che l'utente che ha richiesto l'url sia un moderatore
            
            if(is_a($user, EModerator::class))
            {
                $removedUser = FPersistantManager::getInstance()->load(EUser::class, $id); // ricava l'utente da rimuovere
                if($removedUser)
                    $vUser->showRemoveForm($user, $removedUser);
                else 
                    $vUser->showErrorPage($user, 'The id doesn\'t match any user.');
            }
            else
                $vUser->showErrorPage($user, 'You can\'t delete other users!');
                
            
        }
        else
        {
            if(get_class($user)!=EGuest::class)
                $vUser->showRemoveForm($user);
            else 
                $vUser->showErrorPage($user, 'You can\'t delete a guest!');
        }
    }
    
    /**
     * Rimuove un utente dall'applicazione
     * @param int $id l'identificativo dell'utente da rimuovere, specificato SOLO se l'utente
     * che sta effettuando l'operazione di rimozione sia un moderatore
     */
    private function removeUser($id = null)
    {
        $vUser = new VUser();
        $user = CSession::getUserFromSession();
        
        if(is_numeric($id)) // verifica che nell'url sia stato inserito un id
        { // verifica che l'utente che ha richiesto l'url sia un moderatore
            
            if(is_a($user, EModerator::class)) // se l'utente e' moderatore
            { // ricava l'id del profilo da rimuovere
                $removedUser = FPersistantManager::getInstance()->load(EUser::class, $id); // ricava l'utente da rimuovere
                if($removedUser)
                {
                    FPersistantManager::getInstance()->remove(EUser::class, $removedUser->getId());
                    header('Location: /deepmusic/index');
                }
                else
                    $vUser->showErrorPage($user, 'The id doesn\'t match any user.');
            }
            else
                $vUser->showErrorPage($user, 'You can\'t delete other users!');
        }
        else
        { // altrimenti e' l'utente della sessione che chiede di essere rimosso
            if(get_class($user)!=EGuest::class)
            {
                FPersistantManager::getInstance()->remove(EUser::class, $user->getId());
                CSession::destroySession(); // viene rimossa la sessione
                header('Location: /deepmusic/index');
            }
            else
                $vUser->showErrorPage($user, 'You can\'t delete a guest!');
        }
        
    }
    
}

