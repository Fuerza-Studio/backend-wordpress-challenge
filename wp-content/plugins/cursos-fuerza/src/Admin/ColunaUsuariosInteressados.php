<?php 

namespace Fuerza\Admin;

use Fuerza\Admin\Colunas;
use Fuerza\Inscricao\Inscricao;

class ColunaUsuariosInteressados
{
    
    /**
     * coluna
     *
     * @var Colunas
     */
    private $coluna;    
    /**
     * inscricao
     *
     * @var Inscricao
     */
    private $inscricao;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {

        $this->coluna = new Colunas();
        
        $this->inscricao = new Inscricao();

    }
    
    /**
     * Method adiciona
     *
     * @return void
     */
    public function adiciona($tituloColuna, $tipoPost) : void
    {

        $this->coluna->adicionar(__($tituloColuna), $tipoPost, function($idPost) {
    
            echo $this->inscricao->recuperaUsuariosPorCurso($idPost);
            
        });

    }

}
