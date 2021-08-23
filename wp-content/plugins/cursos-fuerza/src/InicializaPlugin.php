<?php

namespace Fuerza;

use Fuerza\PostPersonalizados\{PostPersonalizado, PostPersonalizadoDados};

class InicializaPlugin
{
    
    public static function inicializa()
    {

        try {

            $dadosPostPersonalizado = new PostPersonalizadoDados('cursos-fuerza', 'Cursos Fuerza', 'Curso Fuerza', true, false, ['title', 'editor', 'thumbnail', 'custom-fields']);
            
            $postPersonalizado = new PostPersonalizado($dadosPostPersonalizado);
        
            $postPersonalizado->criar();
        
        } catch(\Throwable $e) {
        
            echo $e->getMessage();
        
        }        

    }

}
