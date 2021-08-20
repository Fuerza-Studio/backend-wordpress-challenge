<?php

function cfAdicionaLinkAdministrativo() {
	
    register_post_type( 'cursos-fuerza',
        array(
           'labels' => array(
                'name' => __( 'Cursos Fuerza', 'cf_dominio' ),
                'singular_name' => __( 'Curso Fuerza', 'cf_dominio' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
        )
    );
	
}

add_action('init', 'cfAdicionaLinkAdministrativo');


function registraCampoAdicional() {
    add_meta_box( 'cf-box-info-adicionais', esc_html__( 'Informações adicionais', 'cf_dominio' ), 'cfInfoAdicionais', 'cursos-fuerza' );
	//add_meta_box( 'cf-box-info-adicionais-2', esc_html__( 'Informações adicionais', 'cf_dominio' ), 'cfInfoAdicionais2', 'cursos-fuerza' );
}

add_action( 'add_meta_boxes', 'registraCampoAdicional');
 

function cfInfoAdicionais( $meta_id ) {

    $outline = '<label for="cf_link_inscricao" style="width:150px; display:inline-block;">'. esc_html__('Link de inscrição', 'cf_dominio') .'</label>';
    $title_field = get_post_meta( $meta_id->ID, 'cf_link_inscricao', true );
	$outline .= '<input type="text" name="cf_link_inscricao" id="cf_link_inscricao" value="'. esc_attr($title_field) .'" style="width:300px;"/>';
    echo $outline;
}

function cfInfoAdicionais2( $meta_id ) {
 
    $outline = '<label for="cf_link_inscricao" style="width:150px; display:inline-block;">'. esc_html__('Link de inscrição', 'cf_dominio') .'</label>';
    $title_field = get_post_meta( $meta_id->ID, 'cf_link_inscricao', true );
    $outline .= '<input type="text" name="cf_link_inscricao" id="cf_link_inscricao" value="'. esc_attr($title_field) .'" style="width:300px;"/>';
 
    echo $outline;
}


/* Faça algo com os dados inseridos */
add_action( 'save_post', 'cfSalvaDadosPost' );

/* Quando o post for salvo, salvamos também nossos dados personalizados */
function cfSalvaDadosPost( $post_id ) {

  // É necessário verificar se o usuário está autorizado a fazer isso
  if ( 'cursos-fuerza' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Recebe o ID do post
  $post_ID = $_POST['post_ID'];

  // Remove caracteres indesejados
  $mydata = sanitize_text_field( $_POST['cf_link_inscricao'] );

  // Adicionamos ou atualizados o $mydata 
    update_post_meta($post_ID, 'cf_link_inscricao', $mydata);
}