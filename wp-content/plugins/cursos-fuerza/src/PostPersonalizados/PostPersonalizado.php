<?php

namespace Fuerza\PostPersonalizados;

use Fuerza\PostPersonalizados\Interfaces\PostPersonalizadoInterface;

class PostPersonalizado
{
    
    private $dadosPost;
        
    /**
     * Method __construct
     *
     * @param PostPersonalizadoInterface $dadosPost Dados usados na configuração para criar post personalizado
     *
     * @return void
     */
    public function __construct(PostPersonalizadoInterface $dadosPost)
    {

       $this->dadosPost = $dadosPost;

    }

    public function definePost() : void
    {
        
        register_post_type($this->dadosPost->recuperarTipoPost(),
            [
                'labels' => [
                    'name'          => __($this->dadosPost->recuperarNome(), NOME_DOMINIO),
                    'singular_name' => __($this->dadosPost->recuperarNomeSingular(), NOME_DOMINIO),
                    'add_new_item'  => __($this->dadosPost->recuperarTextoAdicionaNovoItem(), NOME_DOMINIO),
                    'edit_item'     => __($this->dadosPost->recuperarTextoEditarItem(), NOME_DOMINIO),
                    'search_items'  => __($this->dadosPost->recuperarTextoBuscarItem(), NOME_DOMINIO),
            ],
                'public'        => $this->dadosPost->recuperarPublico(),
                'has_archive'   => $this->dadosPost->recuperarTemArquivo(),
                'supports'      => $this->dadosPost->recuperarCamposSuportados()
            ]
        );

    }

    /**
     * Method criar
     *
     * @return void
     */
    public function criar() : void
    {
    
        add_action('init', [$this, 'definePost']);

    }

}
