<?php 

namespace Fuerza;

use Fuerza\Templates\Interfaces\TemplateFrontInterface;

class Front
{
    
    /**
     * post
     *
     * @var \WP_Post
     */
    private $post;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {

        global $post;

        $this->post = $post;

    }
    
    /**
     * Method verificaFront
     *
     * @return void
     */
    public function adicionaInformacoes(TemplateFrontInterface $template, $metodo) : void
    {

        add_filter('single_template', function($original) use ($template, $metodo) {
            
            $tipoPost = $this->post->post_type;

            if (trim(strtolower($tipoPost)) == TIPO_POST) {
            
                add_filter('the_content', [$template, $metodo]);
                
            }
            
            return $original;
        
        });
        
    }

}
