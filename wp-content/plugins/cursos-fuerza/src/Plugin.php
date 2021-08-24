<?php

namespace Fuerza;

use Fuerza\{InstalaPlugin, Front};
use Fuerza\Admin\ColunaUsuariosInteressados;
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

            $dadosPostPersonalizado = new PostPersonalizadoDados('cursos-fuerza', 'Cursos Fuerza', 'Curso Fuerza', true, false, ['title', 'editor', 'thumbnail', 'custom-fields']);
            
            $postPersonalizado = new PostPersonalizado($dadosPostPersonalizado);
        
            $postPersonalizado->criar();

            $campoPersonalizado = new CampoAdicional(new TemplateCampoAdicional);

            $campoPersonalizado
                ->defineDadosCampoAdicional('cf_box_link_inscricao', 'Link de inscrição para o curso', 'campoLinkInscricao', 'cursos-fuerza')
                ->defineDadosCampoAdicional('cf_box_carga_horaria', 'Carga horária do curso', 'campoCargaHoraria', 'cursos-fuerza')
                ->defineDadosCampoAdicional('cf_box_data_limite_inscricoes', 'Data limite de inscrições para o curso', 'campoDataLimiteInscricoes', 'cursos-fuerza')
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

            $colunaInteressados = new ColunaUsuariosInteressados();

            $colunaInteressados->adiciona('Usuários interessados', 'cursos-fuerza');

            $inscricao->executaListaInteressados();
        
        } catch(\Throwable $e) {
        
            echo $e->getMessage();
        
        }        

    }

}
