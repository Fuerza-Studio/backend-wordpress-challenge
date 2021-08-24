<?php 

namespace Fuerza\Templates;

use Fuerza\Templates\Interfaces\TemplateFrontInterface;

class InformacoesPersonalizadas implements TemplateFrontInterface
{
    
    /**
     * Method adicionaFormularioInscricao
     *
     * @param string $conteudo Adiciona a lógica necessária para mostrar ou não o formulário de inscrição
     *
     * @return string
     */
    public function adicionaFormularioInscricao(string $conteudo) : string
    {
	
        $cargaHoraria = get_post_meta(get_the_ID(), 'cf_carga_horaria', true);
        
        $dataLimiteInscricao = new \DateTime(get_post_meta(get_the_ID(), 'cf_data_limite_inscricoes', true));
        
        $idCurso = base64_encode(get_the_ID());
        
        $linkInscricao = get_post_meta(get_the_ID(), 'cf_link_inscricao', true);
        
        $linkInscricaoCodificado = base64_encode($linkInscricao);
        
        $dataLimiteFormatada = $dataLimiteInscricao->format('d/m/Y');
        
        $formInscricao = "<p><a href='{$linkInscricao}' target='_blank' title='" . __('Efetuar inscrição', NOME_DOMINIO) . "' class='btn btn-sucesso'>" . __('Efetuar inscrição', NOME_DOMINIO) . "</a></p>";
        
        if (strtotime(date('Y-m-d')) <= strtotime($dataLimiteInscricao->format('Y-m-d'))) {
            
            $htmlFormularioInscricao = new FormularioInscricao();

            $formInscricao = $htmlFormularioInscricao->recuperarFormulario($idCurso, $linkInscricaoCodificado);
          
        }

        $htmlInformacoesExtras = new InformacoesExtras();

        $textoCustomizado = $htmlInformacoesExtras->recuperarInformacoes($cargaHoraria, $dataLimiteFormatada, $conteudo, $formInscricao);
     
        return $textoCustomizado;

    }

}
