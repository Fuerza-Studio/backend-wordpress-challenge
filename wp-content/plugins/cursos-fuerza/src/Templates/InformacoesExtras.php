<?php 

namespace Fuerza\Templates;

class InformacoesExtras
{

    /**
     * Method recuperarInformacoes
     *
     * @param string $cargaHoraria Carga horária do curso
     * @param string $dataLimite Data limite para inscrição no curso
     * @param string $conteudo Conteúdo descritivo sobre o curso
     * @param string $inscricao Formulário de inscrição ou link
     *
     * @return string
     */
    public function recuperarInformacoes(string $cargaHoraria, string $dataLimite, string $conteudo, string $inscricao) : string
    {
        
        return "
            <h4>" . __('Detalhes do curso', NOME_DOMINIO) . "</h4>
            <p class='font-tamanho-16 margin-topo-0 margin-baixo-0'>" . __('Carga Horária', NOME_DOMINIO) . ": <strong>{$cargaHoraria}</strong> horas</p>
            <p class='font-tamanho-16 margin-topo-0 margin-baixo-0'>" . __('Data limite para inscrições', NOME_DOMINIO) . ": <strong>{$dataLimite}</strong></p>
            {$conteudo}
            {$inscricao}";

    }

}
