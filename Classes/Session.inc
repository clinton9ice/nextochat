<?php

class Session{

    public function setSession($name,$value){
        $_SESSION[$name] = $value;
    }

    public function removeSession($name){
        if($this->SessionExist($name)) {
            unset($_SESSION[$name]);
            session_destroy();
        }
    }

    public function getSession($name){
        return $this->SessionExist($name)?$_SESSION[$name]:null;
    }

    public function SessionExist($name):bool{
        return isset($_SESSION[$name]);
    }

}