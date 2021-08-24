<?php 

namespace Fuerza\Inscricao;

use Fuerza\Inscricao\Interfaces\InscricaoInterface;

class Inscricao implements InscricaoInterface
{

    const TABELA_INSCRICAO = 'cursos_fuerza_inscricoes';
    
    /**
     * bancoDeDados
     *
     * @var wpdb
     */
    private $bancoDeDados;    
    /**
     * tabela
     *
     * @var string
     */
    private $tabela;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {

        global $wpdb;

        $this->bancoDeDados = $wpdb;
        
        $this->tabela = $this->bancoDeDados->prefix . self::TABELA_INSCRICAO;
        
    }
    
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
        
        if (empty($nome) || empty($email) || (int) $idCurso < 1) {
            
            return rest_ensure_response(['erro' => true, 'mensagem' => __('Requisição inválida.', NOME_DOMINIO)]);
            
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return rest_ensure_response(['erro' => true, 'mensagem' => __('E-mail inválido.', NOME_DOMINIO)]);

        }
        
        $salvaInscricao = $this->salvaNoBanco($nome, $email, $idCurso);
        
        if ($salvaInscricao[0]) {
        
            return rest_ensure_response(['erro' => false, 'mensagem' => __($salvaInscricao[1], NOME_DOMINIO)]);
        
        }
        
        return rest_ensure_response(['erro' => true, 'mensagem' => __($salvaInscricao[1], NOME_DOMINIO)]);
        
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
	
        $usuarioJaCadastrado = $this->bancoDeDados->get_results($this->bancoDeDados->prepare("SELECT * FROM {$this->tabela} WHERE email = %s AND id_curso = %d", $email, $idCurso));
        
        if ($usuarioJaCadastrado) {
            
            return [false, __('Você já está cadastrado para este curso', NOME_DOMINIO)];
            
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
        
        $inseriu = $this->bancoDeDados->insert($this->tabela, $dados, $formato);
        
        if ($inseriu) {
            
            return [true, __('Inscrição realizada com sucesso.', NOME_DOMINIO)];
            
        }
        
        return [false, __('Falha ao realizar inscrição.', NOME_DOMINIO)];
    
    }
    
    /**
     * Method recuperaUsuariosPorCurso
     *
     * @param int $idCurso Id do curso
     *
     * @return int
     */
    public function recuperaUsuariosPorCurso(int $idCurso) : int
    {
	
        $qtdInteressados = $this->bancoDeDados->get_row($this->bancoDeDados->prepare("SELECT COUNT(id_curso) AS qtdInteressados FROM {$this->tabela} WHERE id_curso = %d", $idCurso));
        
        return $qtdInteressados->qtdInteressados;
        
    }
    
    /**
     * Method listaInteressadosEdicao
     *
     * @param \WP_Post $post Objeto Post
     *
     * @return void
     */
    public function listaInteressados(\WP_Post $post) : void
    {
	
        $screen = get_current_screen();
     
        if ($screen->parent_base == 'edit' && $screen->action != 'add') {
    
            if (in_array($post->post_type, [TIPO_POST])) {
                
                $listaInteressados = $this->bancoDeDados->get_results($this->bancoDeDados->prepare("SELECT * FROM {$this->tabela} WHERE id_curso = %d", $post->ID));
                
                echo '<h1 class="padding-bottom-20 margin-top-20">' . __('Lista de interessados', NOME_DOMINIO) . '</h1>';
                
                echo '<table class="tabela-listagem-interessados"><thead><tr><th>' . __('ID', NOME_DOMINIO) . '</th><th>' . __('Nome', NOME_DOMINIO) . '</th><th>' . __('E-mail', NOME_DOMINIO) . '</th><th>' . __('Data da inscrição', NOME_DOMINIO) . '</th></tr></thead><tbody>';
                
                    foreach ($listaInteressados as $interessado) {
                        
                        $dataInscricao = date('d/m/Y H:i:s', strtotime($interessado->data_inscricao));
                        
                        echo "<tr><td>{$interessado->id}</td><td>{$interessado->nome}</td><td>{$interessado->email}</td><td>{$dataInscricao}</td></tr>";
                    
                    }
                
                echo '</tbody></table>';
                
            }
        
        }

    }
    
    /**
     * Method executaListaInteressados
     *
     * @return void
     */
    public function executaListaInteressados() : void
    {

        add_action('edit_form_top', [$this, 'listaInteressados']);
        
    }

}
