<?php

namespace Fuerza;

use Fuerza\{InstalaPlugin, Front};
use Fuerza\Admin\{Colunas, ColunaUsuariosInteressados};
use Fuerza\Api\RegistraApi;
use Fuerza\ArquivosExtras\ArquivoExtra;
use Fuerza\Templates\InformacoesPersonalizadas;
use Fuerza\PostSalvaDadosAdicionais\PostSalvaDadoAdicional;
use Fuerza\CamposAdicionais\{CampoAdicional, TemplateCampoAdicional};
use Fuerza\Inscricao\Inscricao;
use Fuerza\PostPersonalizados\{PostPersonalizado, PostPersonalizadoDados};

class Plugin
{
        
    /**
     * Method inicializa
     *
     * @return void
     */
    public static function inicializa() : void
    {

        try {

            new InstalaPlugin();

            $dadosPostPersonalizado = new PostPersonalizadoDados(TIPO_POST, 'Cursos Fuerza', 'Curso Fuerza', true, false, ['title', 'editor', 'thumbnail']);
            
            $postPersonalizado = new PostPersonalizado($dadosPostPersonalizado);
        
            $postPersonalizado->criar();

            $campoPersonalizado = new CampoAdicional(new TemplateCampoAdicional);

            $campoPersonalizado
                ->defineDadosCampoAdicional('cf_box_link_inscricao', 'Link de inscrição para o curso', 'campoLinkInscricao', TIPO_POST)
                ->defineDadosCampoAdicional('cf_box_carga_horaria', 'Carga horária do curso', 'campoCargaHoraria', TIPO_POST)
                ->defineDadosCampoAdicional('cf_box_data_limite_inscricoes', 'Data limite de inscrições para o curso', 'campoDataLimiteInscricoes', TIPO_POST)
                ->executaCriacaoCampos();

            $dadosAdicionais = new PostSalvaDadoAdicional();
            
            $dadosAdicionais
                ->defineDados('cf_link_inscricao')
                ->defineDados('cf_carga_horaria')
                ->defineDados('cf_data_limite_inscricoes')
                ->executaSalvaDados();

            $formularioInscricao = new Front();

            $formularioInscricao->adicionaInformacoes(new InformacoesPersonalizadas, 'adicionaFormularioInscricao');

            $arquivosExtras = new ArquivoExtra();

            $arquivosExtras
                ->executaArquivosFront()
                ->executaScriptFront()
                ->executaArquivosAdmin();

            $registraApi = new RegistraApi();

            $inscricao = new Inscricao();

            $registraApi->registrar($inscricao);

            $colunaInteressados = new ColunaUsuariosInteressados(new Colunas, $inscricao);

            $colunaInteressados->adiciona('Usuários interessados', TIPO_POST);

            $inscricao->executaListaInteressados();
        
        } catch(\Throwable $e) {
        
            wp_die($e->getMessage());
        
        }        

    }

}
