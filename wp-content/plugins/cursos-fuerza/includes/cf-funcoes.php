<?php

add_action( 'save_post', 'cfSalvaDadosPost' );

/* Quando o post for salvo, salvamos também nossos dados personalizados */
function cfSalvaDadosPost( int $idPost ) {

  if ( 'cursos-fuerza' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $idPost ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $idPost ) )
        return;
  }
  
  $camposPersonalizados = [
	'cf_link_inscricao' => sanitize_text_field( $_POST['cf_link_inscricao'] ),
	'cf_carga_horaria' => sanitize_text_field( $_POST['cf_carga_horaria'] ),
	'cf_data_limite_inscricoes' => sanitize_text_field( $_POST['cf_data_limite_inscricoes'] ),
  ];

  foreach ($camposPersonalizados as $nomeCampo => $valorCampo) {
	  
	  // Adiciona ou atualiza os campos
	  update_post_meta($idPost, $nomeCampo, $valorCampo);
	  
  }

}

add_filter('single_template', function($original){
	
	global $post;

	$tipoPost = $post->post_type;

	if (trim(strtolower($tipoPost)) == 'cursos-fuerza') {
	  
		add_filter( 'the_content', 'adicionaInformacoesPersonalizadas' );  
	}
	
	return $original;
  
});

function adicionaInformacoesPersonalizadas( $conteudo ) {
	
	$cargaHoraria = get_post_meta(get_the_ID(), 'cf_carga_horaria', true);
	
	$dataLimiteInscricao = new DateTime(get_post_meta(get_the_ID(), 'cf_data_limite_inscricoes', true));
	
	$idCurso = base64_encode(get_the_ID());
	
	$linkInscricao = get_post_meta(get_the_ID(), 'cf_link_inscricao', true);
	
	$linkInscricaoCodificado = base64_encode($linkInscricao);
	
	$dataLimiteFormatada = $dataLimiteInscricao->format('d/m/Y');
	
	$formInscricao = "<p><a href='{$linkInscricao}' target='_blank' title='Efetuar inscrição' class='btn btn-sucesso'>Efetuar inscrição</a></p>";
	
	if (strtotime(date('Y-m-d')) <= strtotime($dataLimiteInscricao->format('Y-m-d'))) {
		
		$formInscricao = <<<FORM_INSCRICAO
			<h4>Tenho Interesse</h4>
			<form method="post" id="formInscreveCurso">
			  <p class="margin-baixo-20">
				<label for="nome">Nome:</label>
				<input type="text" id="nome" name="nome" class="input-100" required>
			  </p>
			  <p class="margin-baixo-20">
				<label for="email">E-mail:</label>
				<input type="email" id="email" name="email" class="input-100" required>
			  </p>
			  <p class="margin-baixo-20">		  
				<input type="submit" value="Enviar">
			  </p>
			  <input type="hidden" value="{$idCurso}" id="curso">
			  <input type="hidden" value="{$linkInscricaoCodificado}" id="url">
			</form>
			<div class="mensagem-inscricao sucesso"></div>
FORM_INSCRICAO;
		
	}
	
	$textoCustomizado = <<<INFORMACOES_EXTRAS
		<h4>Detalhes do curso</h4>
		<p class="font-tamanho-16 margin-topo-0 margin-baixo-0">Carga Horária: <strong>{$cargaHoraria}</strong> horas</p>
		<p class="font-tamanho-16 margin-topo-0 margin-baixo-0">Data limite para inscrições: <strong>{$dataLimiteFormatada}</strong></p>
		{$conteudo}
		{$formInscricao}
INFORMACOES_EXTRAS;
 
    return $textoCustomizado;
}

function adicionaAssetsFront() {
    
	wp_enqueue_style('cf-estilo', plugins_url( 'layout/assets/css/estilos.css', __FILE__ ), array(), false);
	wp_enqueue_script('jquery', plugins_url( 'layout/assets/js/jquery.min.js', __FILE__ ), array(), false);
	wp_enqueue_script('cf-script', plugins_url( 'layout/assets/js/script.js', __FILE__ ), array(), false);

}

add_action( 'wp_enqueue_scripts', 'adicionaAssetsFront' );

add_action('wp_footer', 'adicionarScriptRodape');

function adicionarScriptRodape() {
    ?>
        <script>
            const URL = '<?php echo get_site_url(); ?>';
        </script>
    <?php
}

add_action('rest_api_init', function() {
	
  register_rest_route( 'cursos-fuerza/v1', '/inscricao', [
    'methods' => 'POST',
    'callback' => 'apiInscricaoCurso',
  ]);
  
});

function apiInscricaoCurso( WP_REST_Request $requisicao ) {
	
	$nome = sanitize_text_field($requisicao['nome']);
	
	$email = sanitize_text_field($requisicao['email']);
	
	$idCurso = sanitize_text_field(base64_decode($requisicao['idCurso']));
	
	if (empty($nome) || empty($email) || empty($idCurso)) {
		
		return rest_ensure_response(['erro' => true, 'mensagem' => 'Requisição inválida.']);
		
	}
	
	$salvaInscricao = salvaInscricaoNoBanco($nome, $email, $idCurso);
	
	if ($salvaInscricao[0]) {
	
		return rest_ensure_response(['erro' => false, 'mensagem' => $salvaInscricao[1]]);
	}
	
	return rest_ensure_response(['erro' => true, 'mensagem' => $salvaInscricao[1]]);
	
}

function salvaInscricaoNoBanco($nome, $email, $idCurso) {
	
	global $wpdb;
	
	$tabela = $wpdb->prefix . 'cursos_fuerza_inscricoes';
	
	$usuarioJaCadastrado = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$tabela} WHERE email = %s AND id_curso = %d", $email, $idCurso) );
	
	if ($usuarioJaCadastrado) {
		
		return [false, 'Você já está cadastrado para este curso'];
		
	}
	
	$dados = [
		'nome' => $nome,
		'email' => $email,
		'id_curso' => $idCurso
	];
	
	$formato = [
		'%s',
		'%s',
		'%d'
	];
	
	$inseriu = $wpdb->insert( $tabela, $dados, $formato );
	
	if($inseriu){
		
		return [true, 'Inscrição realizada com sucesso.'];
		
	}
	
	return [false, 'Falha ao realizar inscrição.'];

}

function add_admin_column($column_title, $post_type, $cb){

    // Column Header
    add_filter( 'manage_' . $post_type . '_posts_columns', function($columns) use ($column_title) {
        unset($columns['date']);
		$columns[ sanitize_title($column_title) ] = $column_title;
		$columns['date'] = __('Date');
        return $columns;
    } );

    // Column Content
    add_action( 'manage_' . $post_type . '_posts_custom_column' , function( $column, $post_id ) use ($column_title, $cb) {

        if(sanitize_title($column_title) === $column){
            $cb($post_id);
        }

    }, 10, 2 );
}

add_admin_column(__('Usuários interessados'), 'cursos-fuerza', function($idPost){
    
	echo recuperaUsuariosPorCurso($idPost);
	
});

function recuperaUsuariosPorCurso(int $idCurso) {
	
	global $wpdb;
	
	$tabela = $wpdb->prefix . 'cursos_fuerza_inscricoes';
	
	$qtdInteressados = $wpdb->get_row( $wpdb->prepare("SELECT COUNT(id_curso) AS qtdInteressados FROM {$tabela} WHERE id_curso = %d", $idCurso) );
	
	return $qtdInteressados->qtdInteressados;
}

add_action('edit_form_top', 'listaInteressadosEdicao');

function listaInteressadosEdicao( $post ) {
	
	$screen = get_current_screen();
 
	if ( $screen->parent_base == 'edit' && $screen->action != 'add' ) {

		if( in_array( $post->post_type, [ 'cursos-fuerza' ] ) ){
			
			global $wpdb;
		
			$tabela = $wpdb->prefix . 'cursos_fuerza_inscricoes';
		
			$listaInteressados = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$tabela} WHERE id_curso = %d", $post->ID) );
			
			echo '<h1 class="padding-bottom-20 margin-top-20">' . __( 'Lista de interessados' ) . '</h1>';
			
			echo '<table class="tabela-listagem-interessados"><thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Data da inscrição</th></tr></thead><tbody>';
			
				foreach ($listaInteressados as $interessado) {
					
					$dataInscricao = date('d/m/Y H:i:s', strtotime($interessado->data_inscricao));
					
					echo "<tr><td>{$interessado->id}</td><td>{$interessado->nome}</td><td>{$interessado->email}</td><td>{$dataInscricao}</td></tr>";
				
				}
			
			echo '</tbody></table>';
			
		}
	
	}
}

add_action( 'admin_enqueue_scripts', 'estilosAdministracao' );

function estilosAdministracao() {
	wp_enqueue_style('admin-cf-estilo', plugins_url( 'layout/assets/css/admin.css', __FILE__ ), array(), false);
	wp_enqueue_style('admin-datatable', plugins_url( 'layout/assets/css/datatables.min.css', __FILE__ ), array(), false);
	wp_enqueue_script('admin-jquery', plugins_url( 'layout/assets/js/jquery.min.js', __FILE__ ), array(), false);
	wp_enqueue_script('admin-datatable', plugins_url( 'layout/assets/js/datatables.min.js', __FILE__ ), array(), false);
	wp_enqueue_script('cf-admin-script', plugins_url( 'layout/assets/js/admin.js', __FILE__ ), array(), false);
}