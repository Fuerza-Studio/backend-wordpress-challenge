<?php 

namespace Fuerza\Admin;

use Fuerza\Admin\Interfaces\ColunasInterface;

class Colunas implements ColunasInterface
{
    
    /**
     * Method adicionar
     *
     * @param $tituloColuna $tituloColuna Título da coluna na listagem de posts
     * @param $tipoPost $tipoPost Tipo de post
     * @param $callback $callback Função de callback
     *
     * @return void
     */
    public function adicionar($tituloColuna, $tipoPost, $callback) : void
    {
        
        add_filter('manage_' . $tipoPost . '_posts_columns', function($colunas) use ($tituloColuna) {
            
            unset($colunas['date']);

            $colunas[sanitize_title($tituloColuna)] = __($tituloColuna, NOME_DOMINIO);

            $colunas['date'] = __('Date');

            return $colunas;

        });

        add_action('manage_' . $tipoPost . '_posts_custom_column' , function($coluna, $idPost) use ($tituloColuna, $callback) {

            if (sanitize_title($tituloColuna) === $coluna) {

                $callback($idPost);

            }

        }, 10, 2);

    }

}
