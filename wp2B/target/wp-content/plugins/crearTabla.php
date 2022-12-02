<?php /** @noinspection LanguageDetectionInspection */

/*
Plugin Name: Crear Tabla
Plugin URI: http://wordpress.org/plugins/malsonantes/
Description: Busca palabras mal sonantes y las cambia por otras más cool y crea una tabla en la base de datos.
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

function inserccion_malsonantes_base_de_datos() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'palabras_malsonantes';
    $table_name2 = $wpdb->prefix . 'palabras_reemplazo';

    $sql11 = "INSERT INTO $table_name (id, text) VALUES (1, 'caca')";
    $sql12 = "INSERT INTO $table_name (id, text) VALUES (2, 'joder')";
    $sql13 = "INSERT INTO $table_name (id, text) VALUES (3, 'hostia')";
    $sql14 = "INSERT INTO $table_name (id, text) VALUES (4, 'mierda')";
    $sql15 = "INSERT INTO $table_name (id, text) VALUES (5, 'gilipollas')";

    $sql21 = "INSERT INTO $table_name2 (id, text) VALUES (1, 'popo')";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql11);
    dbDelta( $sql12);
    dbDelta( $sql13);
    dbDelta( $sql14);
    dbDelta( $sql15);

    dbDelta( $sql21);

}
add_action('plugins_loaded', 'inserccion_malsonantes_base_de_datos');