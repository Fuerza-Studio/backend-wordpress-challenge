<?php 

namespace Fuerza;

class InstalaPlugin
{

    const NOME_TABELA = 'cursos_fuerza_inscricoes';
    
    /**
     * bancoDeDados
     *
     * @var wpdb
     */
    private $bancoDeDados;    
    /**
     * nomeTabela
     *
     * @var string
     */
    private $nomeTabela;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {

        global $wpdb;
        
        $this->bancoDeDados = $wpdb;

        $this->nomeTabela = $this->bancoDeDados->prefix . self::NOME_TABELA;

        register_activation_hook(ARQUIVO_PRINCIPAL, [$this, 'ativa']);

        register_deactivation_hook(ARQUIVO_PRINCIPAL, [$this, 'inativa']);

    }
    
    /**
     * Method ativa
     *
     * @return void
     */
    public function ativa() : void
    {

        $charset = $this->bancoDeDados->get_charset_collate();

        $this->bancoDeDados->query("CREATE TABLE IF NOT EXISTS {$this->nomeTabela} (
            id INT(11) NOT NULL AUTO_INCREMENT,
            nome VARCHAR(150) NOT NULL,
            email VARCHAR(150) NOT NULL,
            id_curso INT(11) NOT NULL,
            data_inscricao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
            ) $charset;");

    }
    
    /**
     * Method inativa
     *
     * @return void
     */
    public function inativa() : void
    {

        $this->bancoDeDados->query("DROP TABLE IF EXISTS {$this->nomeTabela}");

    }

}
