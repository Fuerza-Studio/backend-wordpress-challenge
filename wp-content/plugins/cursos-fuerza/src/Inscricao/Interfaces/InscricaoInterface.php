<?php 

namespace Fuerza\Inscricao\Interfaces;

interface InscricaoInterface
{

    public function salvaInscricao(\WP_REST_Request $requisicao) : \WP_REST_Response;

    public function salvaNoBanco($nome, $email, $idCurso) : array;

    public function recuperaUsuariosPorCurso(int $idCurso) : int;

    public function listaInteressados(\WP_Post $post) : void;

    public function executaListaInteressados() : void;

}
