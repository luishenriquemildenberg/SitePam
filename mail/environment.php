<?php 

    if($_SERVER['HTTP_HOST'] == 'localhost') {
        define("ENVIRONMENT", "development"); // Subir o projeto como local
    } else {
        define("ENVIRONMENT", "prod"); // Para colocar em produção basta alterar a const para prod
    }
    

    echo ENVIRONMENT;
