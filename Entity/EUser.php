<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EUser
 *
 * @author giovanni
 */
abstract class EUser {
    //put your code here
    
    protected $name;
    private $password;
    protected $birthDate;
    protected $followers;
    
    function __construct(string $user, DateTime $birthDate) {
        $this->name = $user;
        $this->birthDate = $birthDate;
        $this->followers=array();
    }
    
    function getBirthDate() {
        return $this->birthDate;
    }

    function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    function getName() {
        return (string) $this->name;
    }
    
    function setName(string $name){
        $this->name=$name;
    }
    
    function addFollower(EUser $user){
        if($this->user!=$user){
            $this->followers[]=$user;
            return true;
        }
        else return false;
    }
    
    function hasFollowers(){
        return count($this->followers);
    }
    



}
