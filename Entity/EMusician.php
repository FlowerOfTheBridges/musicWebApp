<?php
require_once 'inc.php';

/**
 *
 * @author gruppo 2
 *         La classe EMusician rappresenta una tipologia di utente piu' avanzata di quella
 *         di EListener (di cui infatti eredita i metodi). Un utente istanza di EMusician
 *         ha infatti un genere musicale, ricavato dalla lista di canzoni che egli stesso puo'
 *         caricare.
 */
class EMusician extends EListener
{

    private $genre;
 // genere musicale adottato dal musicista. Calcolato rispetto ai generi di ogni singola canzone.
    
    /**
     *
     * @param int $id
     * @param string $user
     * @param string $mail
     * @param string $region
     * @param DateInterval $birthDate
     * @param string $genre
     */
    function __construct(int $id, string $user = null, string $mail = null, string $region = null, DateInterval $birthDate = null, string $genre)
    {
        parent::__construct($id, $user, $mail, $region, $birthDate); // richiamo il costruttore della classe padre
        $this->genre = $genre;
    }

    /**
     * Assegna una canzone all'artista.
     *
     * @param Esong $song
     *            la canzone da aggiungere
     */
    function addSong(Esong &$song)
    {
        // FPersistantManger->store?
        // TODO
    }

    /**
     * Rimuove una canzone del musicista
     *
     * @param int $pos
     *            la posizione della canzone nella struttura dati (comincia da 1)
     * @return bool true se l'operazione e' riuscita, false altrimenti
     */
    function removeSong(int $pos)
    {
        // TODO
    }

    /**
     * Restituisce una canzone dell'artista
     *
     * @param int $pos
     *            la posizione dell'artista (comincia da 1)
     * @return ESong|NULL ritorna una ESong se la posizione e' valida, NULL altrimenti
     */
    function getSong(int $pos): ESong
    {
        // TODO
    }

    /**
     *
     * @return string il genere musicale dell'artista
     */
    function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * Calcola il genere musicale dell'artista come combinazione dei generi musicali
     * di ogni singola canzone, oppure viene fornito in ingresso.
     *
     * @param string $genre
     *            il genere musicale dell'artista (facoltativo)
     */
    function setGenre(string $genre = null): void
    {
        // TODO
    }
}
