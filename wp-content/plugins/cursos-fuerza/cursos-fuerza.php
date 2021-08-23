<?php

use Fuerza\Plugin;

/*
Plugin Name: Cursos Fuerza
Description: Sistema de gestão de cursos da Fuerza Studio
Author: Wesley Silva
*/

define('NOME_DOMINIO', 'cf_dominio');

define('TIPO_POST', 'cursos-fuerza');

define('CAMINHO_BASE', plugin_dir_path(__FILE__));

define('ARQUIVO_PRINCIPAL', CAMINHO_BASE . 'cursos-fuerza.php');

require_once CAMINHO_BASE . '/autoload.php';

Plugin::inicializa();

require_once CAMINHO_BASE . 'includes/cf-funcoes.php';
