<?php

namespace Moduly\uzytkownicy;

/**
 * Created by PhpStorm.
 * User: adriancieslak
 * Date: 30.01.2016
 * Time: 08:21
 */
class uzytkownik
{
    protected $id;

    private $username;
    private $haslo;
    private $rola;
    private $email;

    private $imie;
    private $nazwisko;

    public function sprawdzUsername($id)
    {
        // TODO: sprawdz username
    }

    public function sprawdzUsernamePoSesji($hashSesja)
    {
        // TODO: sprawdz czy sesja istnieje i nalezy do usera
    }

    public function dodajRole($username)
    {
        // TODO: dodaj role
    }

    public function usunRole($username)
    {
        // TODO: usun role
    }

    public function zmienRole($username)
    {
        // TODO: zmien role
    }


}