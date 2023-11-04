<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {

        session_start();

        //Funcion helper para comprobar si el usuario esta autenticado
        isAuth();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}