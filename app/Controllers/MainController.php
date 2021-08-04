<?php

class MainController {
    public function home(){
        //echo "Maintenant, c'est la méthode home() du MainController qui est appelée pour afficher cette page ! Youhou !";
        $this->show('home', ['title' => "Page acceuil"]);
    }

    public function about(){
        //echo "Maintenant, c'est la méthode about() du MainController qui est appelée pour afficher cette page ! Youhou !";
        $parametrePourLaVue = ['title' => "Page A Propos"];
        
        $this->show('about', $parametrePourLaVue);
    }

    public function tagada(){
        //echo "vive les fraises !";
        $this->show('tagada');
    }
    public function err404(){
        //echo "Ce n'est pas la page que vous recherchez";
        $this->show('err404');
    }
    public function author(){
        $this->show('author');
    }
    public function prof(){
        $this->show('prof');
    }
    // marre des echo ! Affichons du HTML
    // et donnons à notre méthode la possibilité de choisir ce qu'on affiche
    // hep hep hep, minute papillon ! private ? pourquoi ?
    // pour qu'on ne puisse pas appeler cette méthode depuis autre part que l'intérieur de ce contrôleur. Après tout, elle n'existe que pour que les actions puissent facilement déléguer la partie "affichage de la réponse" au visiteur
    private function show($viewName, $viewData = []) {
        
        // avant de require les vues, on déclare la absolutURL, comme ça, on pourra y accéder de partout
        $absolutURL = dirname($_SERVER['SCRIPT_NAME']);

        require __DIR__."/../views/partials/header.part.php";
        
        // beh oui, c'est aussi simple que ça
        // on demande 404, on va chercher views/404.tpl.php
        // on demande about, on va chercher views/about.tpl.php
        // on demande nimp, on va chercher... ah tiens, views/nimp.tpl.php n'existe pas => il faudra quand même faire attention à ce qu'on demande, mais avec un require, le message devrait être assez clair (Fatal error, ça cause, non ?)
        require __DIR__."/../views/$viewName.tpl.php";

        require __DIR__."/../views/partials/footer.part.php";

    }
}