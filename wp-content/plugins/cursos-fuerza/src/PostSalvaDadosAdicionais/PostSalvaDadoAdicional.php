<?php 

namespace Fuerza\PostSalvaDadosAdicionais;

class PostSalvaDadoAdicional
{

    const TIPO_POST = 'cursos-fuerza';
    
    /**
     * camposAdicionais
     *
     * @var array
     */
    private $camposAdicionais;
        
    /**
     * Method salvar
     *
     * @param int $idPost Callback que será executado após salvar o post
     *
     * @return void
     */
    public function salvar(int $idPost) : void
    {

        if (self::TIPO_POST == $_POST['post_type']) {
            
            if (!current_user_can('edit_page', $idPost)) {

                return;

            }

        } else {
            
            if (!current_user_can('edit_post', $idPost)) {

                return;

            }

        }
    
        foreach ($this->camposAdicionais as $nomeCampo) {
            
            update_post_meta($idPost, $nomeCampo, sanitize_text_field($_POST[$nomeCampo]));
            
        }

    }
    
    /**
     * Method defineDados
     *
     * @param string $nomeCampo Define o nome dos campos extras
     *
     * @return self
     */
    public function defineDados(string $nomeCampo) : self
    {

        if (empty($nomeCampo)) {

            throw new \InvalidArgumentException("Favor informar o nome do campo");

        }

        $this->camposAdicionais[] = trim($nomeCampo);

        return $this;

    }
    
    /**
     * Method executaSalvaDados
     *
     * @return void
     */
    public function executaSalvaDados() : void
    {
        
        add_action('save_post', [$this, 'salvar']);

    }

}
