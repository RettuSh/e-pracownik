<?php
/**
 * Created by PhpStorm.
 * User: adriancieslak
 * Date: 30.01.2016
 * Time: 12:59
 */

namespace Moduly\uzytkownicy;


class autoryzacja extends uzytkownik
{

    private $hashSesja;

    public function __construct(\FluentPDO $fpdo)
    {
        $this->fpdo = $fpdo;
    }


    public function logowanie($username, $haslo)
    {
        // TODO: logowanie
    }

    public function wylogowanie($username)
    {
        // TODO: wylogowanie
    }

    public function sprawdzHashSesja($username)
    {
        // TODO: sprawdz hashsesja
        // zwraca MD5 z ID sesji lub NULL
    }

    public function dodajSesje($username)
    {
        // TODO: dodaj sesje
    }

    public function usunSesje($username)
    {
        // TODO: usun sesje
    }

    public function sprawdzRole($username)
    {
        // TODO: sprawdz sesje
    }
}