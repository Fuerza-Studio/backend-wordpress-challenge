<?php

namespace Fuerza\PostPersonalizados;

use Fuerza\PostPersonalizados\Interfaces\PostPersonalizadoInterface;

class PostPersonalizadoDados implements PostPersonalizadoInterface
{
    
    /**
     * tipoPost
     *
     * @var string
     */
    private $tipoPost;    
    /**
     * nome
     *
     * @var string
     */
    private $nome;    
    /**
     * nomeNoSingular
     *
     * @var string
     */
    private $nomeNoSingular;
    /**
     * textoAdicionaNovoItem
     *
     * @var mixed
     */
    private $textoAdicionaNovoItem;
    /**
     * textoEditarItem
     *
     * @var mixed
     */
    private $textoEditarItem;    
    /**
     * textoBuscarItem
     *
     * @var mixed
     */
    private $textoBuscarItem;
    /**
     * publico
     *
     * @var bool
     */
    private $publico;    
    /**
     * temArquivo
     *
     * @var bool
     */
    private $temArquivo;    
    /**
     * campoSuportados
     *
     * @var array
     */
    private $camposSuportados;

    /**
     * Method __construct
     *
     * @param string $tipoPost Tipo do post
     * @param string $nome Nome do post
     * @param string $nomeNoSingular Nome do post no singular
     * @param bool $publico Se o post será público ou não
     * @param bool $temArquivo Informa se o post terá arquivos
     * @param array $camposSuportados Campo que o post irá suportar
     *
     * @return void
     */
    public function __construct(string $tipoPost, string $nome, string $nomeNoSingular, bool $publico, bool $temArquivo, array $camposSuportados)
    {

        $this->defineTipoPost($tipoPost);

        $this->defineNome($nome);

        $this->defineNomeSingular($nomeNoSingular);

        $this->definePublico($publico);

        $this->defineTemArquivo($temArquivo);

        $this->defineCamposSuportados($camposSuportados);

    }

    /**
     * Recuperar tipoPost
     *
     * @return string
     */ 
    public function recuperarTipoPost() : string
    {

        return $this->tipoPost;

    }

    /**
     * Define tipoPost
     *
     * @param  string  $tipoPost  tipoPost
     *
     * @return  self
     */ 
    public function defineTipoPost(string $tipoPost) : self
    {

        if (empty($tipoPost)) {

            throw new \InvalidArgumentException(__("Tipo de post precisa ser informado", NOME_DOMINIO));

        }

        $this->tipoPost = trim($tipoPost);

        return $this;

    }

    /**
     * Recuperar nome
     *
     * @return string
     */ 
    public function recuperarNome() : string
    {

        return $this->nome;

    }

    /**
     * Define nome
     *
     * @param  string  $nome  nome
     *
     * @return  self
     */ 
    public function defineNome(string $nome) : self
    {

        if (empty($nome)) {

            throw new \InvalidArgumentException(__("Nome precisa ser informado", NOME_DOMINIO));

        }

        $this->nome = trim($nome);

        return $this;
        
    }

     /**
     * Recuperar nomeNoSingular
     *
     * @return string
     */ 
    public function recuperarNomeSingular() : string
    {

        return $this->nomeNoSingular;

    }

    /**
     * Define nomeNoSingular
     *
     * @param  string  $nomeNoSingular  nomeNoSingular
     *
     * @return  self
     */ 
    public function defineNomeSingular(string $nomeNoSingular) : self
    {

        if (empty($nomeNoSingular)) {

            throw new \InvalidArgumentException(__("Nome no singular precisa ser informado", NOME_DOMINIO));

        }

        $this->nomeNoSingular = trim($nomeNoSingular);

        return $this;

    }

    /**
     * Recuperar recuperarTextoAdicionaNovoItem
     *
     * @return string
     */ 
    public function recuperarTextoAdicionaNovoItem() : string
    {

        return $this->textoAdicionaNovoItem;

    }

    /**
     * Define defineTextoAdicionaNovoItem
     *
     * @param  string  $textoAdicionaNovoItem  textoAdicionaNovoItem
     *
     * @return  self
     */ 
    public function defineTextoAdicionaNovoItem(string $textoAdicionaNovoItem) : self
    {

        if (empty($textoAdicionaNovoItem)) {

            throw new \InvalidArgumentException(__("Texto adiciona novo item precisa ser informado", NOME_DOMINIO));

        }

        $this->textoAdicionaNovoItem = trim($textoAdicionaNovoItem);

        return $this;

    }

    /**
     * Recuperar recuperarTextoEditarItem
     *
     * @return string
     */ 
    public function recuperarTextoEditarItem() : string
    {

        return $this->textoEditarItem;

    }

    /**
     * Define defineTextoEditarItem
     *
     * @param  string  $textoEditarItem  textoEditarItem
     *
     * @return  self
     */ 
    public function defineTextoEditarItem(string $textoEditarItem) : self
    {

        if (empty($textoEditarItem)) {

            throw new \InvalidArgumentException(__("Texto editar item precisa ser informado", NOME_DOMINIO));

        }

        $this->textoEditarItem = trim($textoEditarItem);

        return $this;

    }

    /**
     * Recuperar recuperarTextoBuscarItem
     *
     * @return string
     */ 
    public function recuperarTextoBuscarItem() : string
    {

        return $this->textoBuscarItem;

    }

    /**
     * Define defineTextoBuscarItem
     *
     * @param  string  $textoBuscarItem  textoBuscarItem
     *
     * @return  self
     */ 
    public function defineTextoBuscarItem(string $textoBuscarItem) : self
    {

        if (empty($textoBuscarItem)) {

            throw new \InvalidArgumentException(__("Texto buscar item precisa ser informado", NOME_DOMINIO));

        }

        $this->textoBuscarItem = trim($textoBuscarItem);

        return $this;

    }

    /**
     * Recuperar publico
     *
     * @return bool
     */ 
    public function recuperarPublico() : bool
    {

        return $this->publico;

    }

    /**
     * Define publico
     *
     * @param  bool  $publico  publico
     *
     * @return  self
     */ 
    public function definePublico(bool $publico) : self
    {

        $this->publico = $publico;

        return $this;

    }

    /**
     * Recuperar temArquivo
     *
     * @return bool
     */ 
    public function recuperarTemArquivo() : bool
    {

        return $this->temArquivo;

    }

    /**
     * Define temArquivo
     *
     * @param  bool  $temArquivo  temArquivo
     *
     * @return  self
     */ 
    public function defineTemArquivo(bool $temArquivo) : self
    {

        $this->temArquivo = $temArquivo;

        return $this;

    }

    /**
     * Recuperar camposSuportados
     *
     * @return array
     */ 
    public function recuperarCamposSuportados() : array
    {

        return $this->camposSuportados;

    }

    /**
     * Define camposSuportados
     *
     * @param  array  $camposSuportados  camposSuportados
     *
     * @return  self
     */ 
    public function defineCamposSuportados(array $camposSuportados) : self
    {

        if (count($camposSuportados) < 1) {

            throw new \InvalidArgumentException(__("O parâmetro campos suportados precisa ter pelo menos um campo", NOME_DOMINIO));

        }

        $this->camposSuportados = $camposSuportados;

        return $this;

    }

}
