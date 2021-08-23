<?php 

namespace Fuerza\Inscricao\Interfaces;

interface InscricaoInterface
{

    public function salvaInscricao(\WP_REST_Request $requisicao) : \WP_REST_Response;

}
