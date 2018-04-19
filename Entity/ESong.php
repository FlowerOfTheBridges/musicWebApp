<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ESong
 *
 * @author giovanni
 */
class ESong
{

    private $name; //stringa contenente il nome dela canzone

    private $artist; //il nome dell'artista

    private $lenght; //lunghezza del brano

    private $genre; //il genere del brano

    private $lyrics; //testo del brano (facoltativo)
    
    private $composers; //i compositori del brano (facoltativo)

    //attributi booleani che denotano la visibilita' del brano
    private $forAll;

    private $supportersOnly;

    private $registeredOnly;



    /**
     * Inizializza una canzone. La visibilita' e' di default solo
     * per gli utenti registrati
     * @param string $name il nome del brano
     * @param string $artist il nome dell'artista
     * @param string $genre il genere del brano
     */
    public function __construct(string $name, string $artist,string $genre)
    {
        $this->name = $name;
        $this->artist=$artist;
        $this->genre = $genre;
        $this->forAll = false;
        $this->supportersOnly = false;
        $this->registeredOnly = true;
    }

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }
    
    /**
     * @param string $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }
    function getText(): string
    {
        return $this->lyrics;
    }

    function setText(string $text)
    {
        $this->lyrics = $text;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getLenght(): DateTime
    {
        return $this->lenght;
    }

    function getGenre(): string
    {
        return $this->genre;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setLenght(DateTime $lenght)
    {
        $this->lenght = $lenght;
    }

    function setGenre(string $genre)
    {
        $this->genre = $genre;
    }
    
    /**
     * @return string
     */
    public function getLyrics() : string
    {
        return $this->lyrics;
    }
    
    /**
     * @return mixed
     */
    public function getComposers() : string
    {
        return $this->composers;
    }
    
    /**
     * @param string $lyrics
     */
    public function setLyrics(string $lyrics)
    {
        $this->lyrics = $lyrics;
    }
    
    /**
     * @param mixed $composers
     */
    public function setComposers(string $composers)
    {
        $this->composers = $composers;
    }

    /**
     * Controlla se il brano e' visibile per tutte le tipologie di utenti
     * @return bool 
     */
    function isForAll(): bool
    {
        return $this->All;
    }

    /**
     * Controlla se il brano e' visibile solo per chi supporta l'artista
     * @return bool
     */
    function isForSupportersOnly(): bool
    {
        return $this->supportersOnly;
    }

    /**
     * Controlla se il brano e' visibile solo per chi e' registrato
     * @return bool
     */
    function isForRegisteredOnly(): bool
    {
        return $this->registeredOnly;
    }

   /**
    * Imposta la visibilita' per tutti gli utenti.
    */
    function setForAll() : void
    {
        $this->All = true;
        $this->supportersOnly = true;
        $this->registeredOnly = true;
    }

    /**
     * Imposta la visibilita' solo per chi supporta l'artista
     */
    function setForSupportersOnly() : void
    {
        $this->All = false;
        $this->registeredOnly = false;
        $this->supportersOnly = true;
    }

  

    /**
     * Imposta la visibilita' solo per chi e' registrato
     */
    function setForRegisteredOnly() : void
    {
        $this->All = false;
        $this->supportersOnly = true;
        $this->registeredOnly = true;
    }

    /**
     * Nasconde il brano a tutti gli utenti
     */
    function hide() : void
    {
        $this->All = false;
        $this->supportersOnly = false;
        $this->registeredOnly = false;
    }

    function __toString(){
        $string="Nome :".$this->name."\nArtista: ".$this->artist."\nGenere: ".$this->genre;
        return $string;
        
    }

    
}
