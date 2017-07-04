<?php

spl_autoload_register(function($class) {
    require_once(ROOT . DS . 'src' . DS . $class . '.php');
});

?>