<?php 

namespace Fuerza\Admin;

use Fuerza\Inscricao\Inscricao;
use Fuerza\Admin\Interfaces\ColunasInterface;

class ColunaUsuariosInteressados
{
    
    /**
     * coluna
     *
     * @var ColunasInterface
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
    public function __construct(ColunasInterface $coluna)
    {

        $this->coluna = $coluna;
        
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
