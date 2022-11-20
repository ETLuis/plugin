<?php /** @noinspection LanguageDetectionInspection */

/*
Plugin Name: Cambiar Malsonantes
Plugin URI: http://wordpress.org/plugins/malsonantes/
Description: Busca palabras mal sonantes y las cambia por otras más cool.
Author: Luis Campañó Goldar
Version: 1.0
Author URI: https://twitter.com/LuisGoldar
*/


function cambiar_malsonantes($text) {
    $malsonante = array('caca', 'joder', 'hostia', 'mierda', 'gilipollas');
    $palabra = str_replace($malsonante, "popo", $text);

    return $palabra;
}


/*
 * cambia el contenido del host
 */
add_filter('the_content', 'cambiar_malsonantes');


function cambiar_malsonantes_base_de_datos() {
    // Creamos un objeto del WordPress para trabajar con la BD llamado wpdb.
    global $wpdb;

    // Recojemos el charset.
    $charset = $wpdb->get_charset_collate();

    // Le añado el prefijo a la tabla.
    $table_name = $wpdb->prefix . 'wp';

    // Creo una tabla y le añado un campo llamado "palabras".
    $sql = "CREATE TABLE $table_name (
        palabras text NOT NULL,
        PRIMARY KEY (palabras)
    ) $charset;";

    // libreria necesaria para usar la funcion dbDelta.
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta( $sql );
}

add_action( 'plugins_loaded', 'cambiar_malsonantes_base_de_datos' );
