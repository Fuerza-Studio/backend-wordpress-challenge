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
        
        $formInscricao = "<p><a href='{$linkInscricao}' target='_blank' title='Efetuar inscrição' class='btn btn-sucesso'>Efetuar inscrição</a></p>";
        
        if (strtotime(date('Y-m-d')) <= strtotime($dataLimiteInscricao->format('Y-m-d'))) {
            
            $formInscricao = <<<FORM_INSCRICAO
                <h4>Tenho Interesse</h4>
                <form method="post" id="formInscreveCurso">
                  <p class="margin-baixo-20">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="input-100" required>
                  </p>
                  <p class="margin-baixo-20">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" class="input-100" required>
                  </p>
                  <p class="margin-baixo-20">		  
                    <input type="submit" value="Enviar">
                  </p>
                  <input type="hidden" value="{$idCurso}" id="curso">
                  <input type="hidden" value="{$linkInscricaoCodificado}" id="url">
                </form>
                <div class="mensagem-inscricao sucesso"></div>
FORM_INSCRICAO;
            
        }
        
        $textoCustomizado = <<<INFORMACOES_EXTRAS
            <h4>Detalhes do curso</h4>
            <p class="font-tamanho-16 margin-topo-0 margin-baixo-0">Carga Horária: <strong>{$cargaHoraria}</strong> horas</p>
            <p class="font-tamanho-16 margin-topo-0 margin-baixo-0">Data limite para inscrições: <strong>{$dataLimiteFormatada}</strong></p>
            {$conteudo}
            {$formInscricao}
INFORMACOES_EXTRAS;
     
        return $textoCustomizado;

    }

}
