<?php

spl_autoload_register('cursosFuerzaAutoloader');

function cursosFuerzaAutoloader($nomeDaClasse ) : void {
	
	define('NAMESPACE_BASE', 'Fuerza');

	if (false !== strpos($nomeDaClasse, NAMESPACE_BASE)) {

		$diretorioClasses = realpath(plugin_dir_path( __FILE__ )) . DIRECTORY_SEPARATOR . 'src';

		$arquivoClasse = str_replace(NAMESPACE_BASE, '', $nomeDaClasse) . '.php';

		$caminhoCompleto = $diretorioClasses . $arquivoClasse;

		if (is_file($caminhoCompleto) && file_exists($caminhoCompleto)) {

			require_once $caminhoCompleto;
			
		}

	}
  
}
