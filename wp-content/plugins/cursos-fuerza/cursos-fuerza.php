<?php

use Fuerza\Plugin;

/*
Plugin Name: Cursos Fuerza
Description: Sistema de gestão de cursos da Fuerza Studio
Author: Wesley Silva
*/

define('NOME_DOMINIO', 'cf_dominio');

define('TIPO_POST', 'cursos-fuerza');

define('ARQUIVO_PRINCIPAL', plugin_dir_path(__FILE__) . 'cursos-fuerza.php');

require_once plugin_dir_path(__FILE__) . '/autoload.php';

Plugin::inicializa();

require_once plugin_dir_path(__FILE__) . 'includes/cf-funcoes.php';
