<?php
    session_start();
    session_destroy();
    
    require_once('php/class/Autoloader.php');
    Autoloader::Register();

    Toolbox::RedirectToHome();