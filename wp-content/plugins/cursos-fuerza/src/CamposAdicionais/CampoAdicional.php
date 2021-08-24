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
      
    /**
     * templateCampo
     *
     * @var CampoAdicionalInterface
     */
    private $templateCampo;
    
    /**
     * Method __construct
     *
     * @param CampoAdicionalInterface $templateCampo Objeto concreto do template de campos adicionais
     *
     * @return void
     */
    public function __construct(CampoAdicionalInterface $templateCampo)
    {

        $this->templateCampo = $templateCampo;

    }
        
    /**
     * Method defineDadosCampoAdicional
     *
     * @param string $idCampo Id do campo a ser criado
     * @param string $titulo Título do campo a ser criado
     * @param string $funcaoRetorno Função callback para executar após o campo ser criado
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
    
    /**
     * Method criaCampos
     *
     * @return void
     */
    public function criaCampos() : void
    {

        $usuarioAdministrador = current_user_can('manage_options');

        foreach ($this->camposAdicionais as $campo) {

            if ($usuarioAdministrador) {

                add_meta_box($campo['idCampo'], esc_html__($campo['titulo'], NOME_DOMINIO), [$this->templateCampo , $campo['funcaoRetorno']], $campo['contexto']);
            }
            
        }

    }
    
    /**
     * Method executaCriacaoCampos
     *
     * @return void
     */
    public function executaCriacaoCampos() : void
    {

        add_action('add_meta_boxes', [$this, 'criaCampos']);

    }

}
