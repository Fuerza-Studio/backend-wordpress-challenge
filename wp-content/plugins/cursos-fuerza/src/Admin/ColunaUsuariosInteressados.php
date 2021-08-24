<?php 

namespace Fuerza\Admin;

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
     * @param $tituloColuna $tituloColuna Título da coluna que será mostrado no admin
     * @param $tipoPost $tipoPost Tipo de post que será usado para verificar se é realmente o tipo de post correto
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
