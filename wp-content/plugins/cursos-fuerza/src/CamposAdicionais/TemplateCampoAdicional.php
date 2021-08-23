<?php 

namespace Fuerza\CamposAdicionais;

use Fuerza\CamposAdicionais\Interfaces\CampoAdicionalInterface;

class TemplateCampoAdicional implements CampoAdicionalInterface
{
        
    /**
     * Method campoLinkInscricao
     *
     * @param $idMetaBox $idMetaBox Campo adicional para o link de inscrição do curso
     *
     * @return void
     */
    public function campoLinkInscricao($idMetaBox) : void
    {

        $valorCampo = get_post_meta($idMetaBox->ID, 'cf_link_inscricao', true);
       
        $html = '<label for="cf_link_inscricao" style="width:150px; display:inline-block;">'. esc_html__('Link de inscrição', NOME_DOMINIO) .'</label>';
        
        $html .= '<input type="url" placeholder="https://www.fuerzastudio.com.br/cursos/php" name="cf_link_inscricao" id="cf_link_inscricao" value="'. esc_attr($valorCampo) .'" style="width:300px;" required/>';
        
        echo $html;

    }

      /**
     * Method campoLinkInscricao
     *
     * @param $idMetaBox $idMetaBox Campo adicional para a carga horária do curso
     *
     * @return void
     */
    public function campoCargaHoraria($idMetaBox) : void
    {

        $valorCampo = get_post_meta($idMetaBox->ID, 'cf_carga_horaria', true);

        $html = '<label for="cf_carga_horaria" style="width:150px; display:inline-block;">'. esc_html__('Carga horária em horas', NOME_DOMINIO) .'</label>';
        
        $html .= '<input type="number" placeholder="50" name="cf_carga_horaria" id="cf_carga_horaria" value="'. esc_attr($valorCampo) .'" style="width:300px;" required/>';
     
        echo $html;

    }

      /**
     * Method campoLinkInscricao
     *
     * @param $idMetaBox $idMetaBox Campo adicional para a data limite de inscrições do curso
     *
     * @return void
     */
    public function campoDataLimiteInscricoes($idMetaBox) : void
    {

        $valorCampo = get_post_meta($idMetaBox->ID, 'cf_data_limite_inscricoes', true);

        $html = '<label for="cf_data_limite_inscricoes" style="width:150px; display:inline-block;">'. esc_html__('Data limite de inscrições', NOME_DOMINIO) .'</label>';
        
        $html .= '<input type="date" name="cf_data_limite_inscricoes" id="cf_data_limite_inscricoes" value="'. esc_attr($valorCampo) .'" style="width:300px;" required/>';
     
        echo $html;

    }

}
