<?php 

namespace Fuerza\CamposAdicionais\Interfaces;

interface CampoAdicionalInterface
{
    
    public function campoLinkInscricao($idMetaBox) : void;

    public function campoCargaHoraria($idMetaBox) : void;

    public function campoDataLimiteInscricoes($idMetaBox) : void;

}
