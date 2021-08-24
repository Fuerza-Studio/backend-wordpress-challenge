<?php 

namespace Fuerza\Api;

use Fuerza\Inscricao\Interfaces\InscricaoInterface;

class RegistraApi
{
    
    /**
     * Method registrar
     *
     * @return void
     */
    public function registrar(InscricaoInterface $inscricao) : void
    {
        
        add_action('rest_api_init', function() use ($inscricao) {
	
            register_rest_route('cursos-fuerza/v1', '/inscricao', [
              'methods'     => 'POST',
              'callback'    => [$inscricao, 'salvaInscricao'],
            ]);
            
        });

    }

}
