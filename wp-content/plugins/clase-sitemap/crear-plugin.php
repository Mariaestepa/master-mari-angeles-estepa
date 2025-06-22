<?php
/*
Plugin Name: Lección de Sitemap
Plugin URI:
Description: Ejercicio para la clase.
Author: Mª Ángeles Estepa 
Author URI: https://master-mari-angeles-estepa.test/
Version: 0.1
License: GPLv2
*/

//Borrar sitemap nativo de wordpress:
include 'includes/borrar-sitemap.php';

//Generar plantilla
include 'includes/template-generator.php';

//Datos estructurados
include 'includes/json.php';
?>

