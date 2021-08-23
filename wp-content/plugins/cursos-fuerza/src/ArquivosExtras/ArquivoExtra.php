<?php

namespace Fuerza\ArquivosExtras;

class ArquivoExtra
{
    
    /**
     * Method adicionaArquivosFront
     *
     * @return void
     */
    public function adicionaArquivosFront() : void
    {
       
        wp_enqueue_style('cf-estilo', plugins_url(TIPO_POST . '/includes/layout/assets/css/estilos.css', CAMINHO_BASE), [], false);
	    
        wp_enqueue_script('jquery', plugins_url(TIPO_POST . '/includes/layout/assets/js/jquery.min.js', CAMINHO_BASE), [], false);
	    
        wp_enqueue_script('cf-script', plugins_url(TIPO_POST . '/includes/layout/assets/js/script.js', CAMINHO_BASE), [], false);

    }
    
    /**
     * Method executaArquivosFront
     *
     * @return self
     */
    public function executaArquivosFront() : self
    {
        
        add_action('wp_enqueue_scripts', [$this, 'adicionaArquivosFront']);

        return $this;

    }
    
    /**
     * Method adicionaScriptRodape
     *
     * @return void
     */
    public function adicionaScriptRodapeFront() : void
    {
        
        ?>
            <script>
                const URL = '<?php echo get_site_url(); ?>';
            </script>
        <?php
        
    }
    
    /**
     * Method executaScriptFront
     *
     * @return self
     */
    public function executaScriptFront() : self
    {
        
        add_action('wp_footer', [$this, 'adicionaScriptRodapeFront']);

        return $this;

    }
    
    /**
     * Method adicionaArquivosAdmin
     *
     * @return void
     */
    public function adicionaArquivosAdmin() : void
    {
       
        wp_enqueue_style('admin-cf-estilo', plugins_url(TIPO_POST . '/includes/layout/assets/css/admin.css', CAMINHO_BASE), [], false);

	    wp_enqueue_style('admin-datatable', plugins_url(TIPO_POST . '/includes/layout/assets/css/datatables.min.css', CAMINHO_BASE ), [], false);
	
        wp_enqueue_script('admin-jquery', plugins_url(TIPO_POST . '/includes/layout/assets/js/jquery.min.js', CAMINHO_BASE), [], false);
	
        wp_enqueue_script('admin-datatable', plugins_url(TIPO_POST . '/includes/layout/assets/js/datatables.min.js', CAMINHO_BASE), [], false);
	
        wp_enqueue_script('cf-admin-script', plugins_url(TIPO_POST . '/includes/layout/assets/js/admin.js', CAMINHO_BASE), [], false);

    }

    public function executaArquivosAdmin() : self
    {
        
        add_action('admin_enqueue_scripts', [$this, 'adicionaArquivosAdmin']);

        return $this;

    }

}
