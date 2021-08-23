<?php

namespace Fuerza;

use Fuerza\PostPersonalizados\{PostPersonalizado, PostPersonalizadoDados};
use Fuerza\InstalaPlugin;

class InicializaPlugin
{
    
    public static function inicializa()
    {

        try {

            new InstalaPlugin();

            $dadosPostPersonalizado = new PostPersonalizadoDados('cursos-fuerza', 'Cursos Fuerza', 'Curso Fuerza', true, false, ['title', 'editor', 'thumbnail', 'custom-fields']);
            
            $postPersonalizado = new PostPersonalizado($dadosPostPersonalizado);
        
            $postPersonalizado->criar();
        
        } catch(\Throwable $e) {
        
            echo $e->getMessage();
        
        }        

    }

}
