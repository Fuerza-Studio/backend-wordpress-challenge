<?php

/*
Plugin Name: Cursos Fuerza
Description: Sistema de gestão de cursos da Fuerza Studio
Author: Wesley Silva
*/

function criaTabelaInscricoes() {
 
	global $wpdb;

	$charset = $wpdb->get_charset_collate();

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$nomeTabela = $wpdb->prefix . 'cursos_fuerza_inscricoes';

	$sql = "CREATE TABLE {$nomeTabela} (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(150) NOT NULL,
	email VARCHAR(150) NOT NULL,
	id_curso INT(11) NOT NULL,
	data_inscricao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
	) $charset;";
	
	dbDelta( $sql );
	
}

register_activation_hook( __FILE__, 'criaTabelaInscricoes' );

require_once plugin_dir_path(__FILE__) . 'includes/cf-funcoes.php';
