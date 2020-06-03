<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppController {

    public function index() {
        return New Response ("Page d'accueil");
    }
}

?>