<?php 

namespace Fuerza\CamposAdicionais;

use Fuerza\CamposAdicionais\Interfaces\CampoAdicionalInterface;

class CampoAdicional
{
    
    /**
     * camposAdicionais
     *
     * @var array
     */
    private $camposAdicionais;
    private $templateCampo;

    public function __construct(CampoAdicionalInterface $templateCampo)
    {

        $this->templateCampo = $templateCampo;

    }
        
    /**
     * Method defineCampoAdicional
     *
     * @param string $idCampo Id do campo a ser criado
     * @param string $titulo Título do campo a ser criado
     * @param string $nomeCampo Nome do campo a ser criado
     * @param string $contexto Contexto do campo a ser criado
     *
     * @return self
     */
    public function defineDadosCampoAdicional(string $idCampo, string $titulo, string $funcaoRetorno, string $contexto) : self
    {

        if (empty($idCampo) || empty($titulo) || empty($funcaoRetorno) || empty($contexto)) {

            throw new \InvalidArgumentException("Favor informar todos os parâmetros");

        }

        $this->camposAdicionais[] = ['idCampo' => $idCampo, 'titulo' => $titulo, 'funcaoRetorno' => $funcaoRetorno, 'contexto' => $contexto];

        return $this;
    
    }

    public function criaCampos() : void
    {

        foreach ($this->camposAdicionais as $campo) {

            add_meta_box($campo['idCampo'], esc_html__($campo['titulo'], NOME_DOMINIO), [$this->templateCampo , $campo['funcaoRetorno']], $campo['contexto']);
        
        }

    }

    public function executaCriacaoCampos() : void
    {

        add_action('add_meta_boxes', [$this, 'criaCampos']);

    }

}
