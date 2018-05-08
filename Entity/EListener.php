<?php
require_once 'inc.php';
include_once 'Entity/EUser.php';

/**
 *
 * @author gruppo 2
 *         La classe EListener rappresenta l'utente base dell'applicazione.
 *         Puo' seguire altri utenti e, in caso di musicisti, puo' supportarli
 */
class EListener extends EUser
{

    // ATTRIBUTI PER I DATI PERSONALI
    protected $name;
 // il nome dell'utente
    protected $region;
 // il luogo dove abita l'utente
    protected $birthDate;
 // la data di nascita dell'utente
    
    /**
     * Metodo costruttore che istanzia un oggetto EListener
     *
     * @param int $id
     *            l'id dell'utente (facoltativo)
     * @param string $user
     *            il nome dell'utente (facoltativo)
     * @param string $mail
     *            l'email associata all'account (facoltativa)
     */
    function __construct(int $id = null, string $user = null, string $mail = null, string $type = "listener")
    {
        parent::__construct($id,$user,$mail,$type);
    }

    /**
     *
     * @return string la regione dell'utente
     */
    function getRegion(): string
    {
        return $this->region;
    }

    /**
     *
     * @return string il nome dell'utente
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     *
     * @return string la password (criptata) dell'utente
     */
    function getPassword(): string
    {
        return $this->password;
    }

    /**
     *
     * @return DateInterval la data di nascita dell'utente
     */
    function getBirthDate(): DateInterval
    {
        return $this->birthDate;
    }


    /**
     *
     * @param string $region
     *            la regione dell'utente
     */
    function setRegion(string $region)
    {
        $this->region = $region;
    }

    /**
     *
     * @param DateInterval $birthDate
     *            la data di nascita da impostare
     */
    function setBirthDate(DateInterval $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     *
     * @param string $name
     *            il nome da assegnare all'utente
     */
    function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * Viene aggiunto un utente alla lista dei follower.
     *
     * @param EListener $user l'utente da aggiungere
     */
    function addFollower(EListener &$user)
    {
        
        // TODO
    }

    /**
     * Aggiunge ai preferiti una canzone.
     *
     * @param Esong $song
     *            la canzone da aggiungere
     */
    function addSongToFavourites(Esong &$song): bool
    {
        // TODO
    }

    /**
     * Rimuove una canzone dai preferiti.
     *
     * @param int $id della canzone.
     */
    function removeSongFromFavourites(int $id)
    {
        // TODO
    }

    /**
     * Rimuove un utente dalla lista dei follower
     *
     * @param int $id del follower
     */
    function removeFollower(int $id)
    {
        // TODO
    }

    /**
     * Restituisce una canzone presente tra i preferiti.
     *
     * @param int $id della canzone
     * @return ESong|NULL ritorna una canzone se la posizione e' valida, NULL altrimenti
     */
    function getSongsFromFavourites(int $id): array
    {
        // TODO
    }

    /**
     * Permette di seguire un altro utente
     *
     * @param EListener $listener
     *            l'utente da seguire
     */
    function follow(EListener &$listener)
    {
        // TODO
    }

    /**
     * Smette di seguire un altro utente
     *
     * @param EListener $listener
     *            l'utente da non seguire
     */
    function unFollow(EListener &$listener)
    {
        // TODO
    }

    /**
     * Permette di supportare un musicista.
     *
     * @param EMusician $musician
     */
    function support(EMusician &$musician)
    {
        // TODO
    }

    /**
     * Segnala un contenuto dell'applicazione.
     * @param object $object il contenuto da segnalare.
     */
    function report($object)
    {
        // TODO
    }
}

    