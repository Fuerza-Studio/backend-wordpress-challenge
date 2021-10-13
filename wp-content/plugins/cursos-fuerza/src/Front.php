<?php 

namespace Fuerza;

use Fuerza\Templates\Interfaces\TemplateFrontInterface;

class Front
{
    
    /**
     * Method verificaFront
     *
     * @return void
     */
    public function adicionaInformacoes(TemplateFrontInterface $template, $metodo) : void
    {

        add_filter('single_template', function($original) use ($template, $metodo) {
            
            global $post;

            $tipoPost = $post->post_type;

            if (trim(strtolower($tipoPost)) == TIPO_POST) {
            
                add_filter('the_content', [$template, $metodo]);
                
            }
            
            return $original;
        
        });
        
    }

}
