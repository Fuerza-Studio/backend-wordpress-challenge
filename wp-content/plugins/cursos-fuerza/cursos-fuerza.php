<?php

/*
Plugin Name: Cursos Fuerza
Description: Sistema de gestão de cursos da Fuerza Studio
Author: Wesley Silva
*/

function adicionaTabelaInscricoes() {
 
	global $wpdb;

	$charset = $wpdb->get_charset_collate();

	$nomeTabela = $wpdb->prefix . 'cursos_fuerza_inscricoes';

	$wpdb->query("CREATE TABLE IF NOT EXISTS {$nomeTabela} (
		id INT(11) NOT NULL AUTO_INCREMENT,
		nome VARCHAR(150) NOT NULL,
		email VARCHAR(150) NOT NULL,
		id_curso INT(11) NOT NULL,
		data_inscricao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id)
		) $charset;");
	
}

function removeTabelaInscricoes() {
 
	global $wpdb;

	$nomeTabela = $wpdb->prefix . 'cursos_fuerza_inscricoes';

	$wpdb->query("DROP TABLE IF EXISTS {$nomeTabela}");
	
}

register_activation_hook( __FILE__, 'adicionaTabelaInscricoes' );

register_deactivation_hook( __FILE__, 'removeTabelaInscricoes' );

require_once plugin_dir_path(__FILE__) . 'includes/cf-funcoes.php';
