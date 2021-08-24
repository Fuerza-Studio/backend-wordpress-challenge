<?php 

namespace Fuerza\Admin;

use Fuerza\Inscricao\Inscricao;
use Fuerza\Admin\Interfaces\ColunasInterface;
use Fuerza\Inscricao\Interfaces\InscricaoInterface;

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
     * @var InscricaoInterface
     */
    private $inscricao;
    
        
    /**
     * Method __construct
     *
     * @param ColunasInterface $coluna Objeto concreto que implement a interface ColunasInterface
     * @param InscricaoInterface $inscricao Objeto concreto que implement a interface InscricaoInterface
     *
     * @return void
     */
    public function __construct(ColunasInterface $coluna, InscricaoInterface $inscricao)
    {

        $this->coluna = $coluna;
        
        $this->inscricao = $inscricao;

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
