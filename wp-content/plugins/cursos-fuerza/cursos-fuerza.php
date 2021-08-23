<?php

use Fuerza\InicializaPlugin;

/*
Plugin Name: Cursos Fuerza
Description: Sistema de gestão de cursos da Fuerza Studio
Author: Wesley Silva
*/

define('NOME_DOMINIO', 'cf_dominio');

require_once(plugin_dir_path(__FILE__) . '/autoload.php');

InicializaPlugin::inicializa();

require_once plugin_dir_path(__FILE__) . 'includes/cf-funcoes.php';
