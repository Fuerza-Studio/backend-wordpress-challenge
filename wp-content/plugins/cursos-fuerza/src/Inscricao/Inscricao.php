<?php 

namespace Fuerza\Inscricao;

use Fuerza\Inscricao\Interfaces\InscricaoInterface;

class Inscricao implements InscricaoInterface
{

    const TABELA_INSCRICAO = 'cursos_fuerza_inscricoes';
    
    /**
     * Method salvaInscricao
     *
     * @param \WP_REST_Request $requisicao Recebe a requisição da inscrição no curso
     *
     * @return WP_REST_Response
     */
    public function salvaInscricao(\WP_REST_Request $requisicao) : \WP_REST_Response
    {
	
        $nome = sanitize_text_field($requisicao['nome']);
        
        $email = sanitize_text_field($requisicao['email']);
        
        $idCurso = sanitize_text_field(base64_decode($requisicao['idCurso']));
        
        if (empty($nome) || empty($email) || empty($idCurso)) {
            
            return rest_ensure_response(['erro' => true, 'mensagem' => 'Requisição inválida.']);
            
        }
        
        $salvaInscricao = $this->salvaNoBanco($nome, $email, $idCurso);
        
        if ($salvaInscricao[0]) {
        
            return rest_ensure_response(['erro' => false, 'mensagem' => $salvaInscricao[1]]);
        
        }
        
        return rest_ensure_response(['erro' => true, 'mensagem' => $salvaInscricao[1]]);
        
    }
    
    /**
     * Method salvaNoBanco
     *
     * @param $nome $nome Nome do usuário
     * @param $email $email Email do usuário
     * @param $idCurso $idCurso Id do curso
     *
     * @return array
     */
    public function salvaNoBanco($nome, $email, $idCurso) : array
    {
	
        global $wpdb;
        
        $tabela = $wpdb->prefix . self::TABELA_INSCRICAO;
        
        $usuarioJaCadastrado = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$tabela} WHERE email = %s AND id_curso = %d", $email, $idCurso));
        
        if ($usuarioJaCadastrado) {
            
            return [false, 'Você já está cadastrado para este curso'];
            
        }
        
        $dados = [
            'nome'      => $nome,
            'email'     => $email,
            'id_curso'  => $idCurso
        ];
        
        $formato = [
            '%s',
            '%s',
            '%d'
        ];
        
        $inseriu = $wpdb->insert($tabela, $dados, $formato);
        
        if ($inseriu) {
            
            return [true, 'Inscrição realizada com sucesso.'];
            
        }
        
        return [false, 'Falha ao realizar inscrição.'];
    
    }

}
