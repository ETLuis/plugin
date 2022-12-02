<?php

/*
Plugin Name: Cambiar Malsonantes
Plugin URI: http://wordpress.org/plugins/malsonantes/
Description: Busca palabras malsonantes y las cambia por otras más cool.
Author: Luis Campañó Goldar
Version: 1.0
Author URI: https://twitter.com/LuisGoldar
*/


function cambiar_malsonantes($text){
    $malsonante = array('caca', 'joder', 'hostia', 'mierda', 'gilipollas');
    $palabra = str_replace($malsonante, "popo", $text);

    return $palabra;
}


/*
 * cambia el contenido del host
 */
add_filter('the_content', 'cambiar_malsonantes');
