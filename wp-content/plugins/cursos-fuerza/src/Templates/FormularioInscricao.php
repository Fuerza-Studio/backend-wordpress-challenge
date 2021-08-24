<?php 

namespace Fuerza\Templates;

class FormularioInscricao
{
    
    /**
     * Method recuperarFormulario
     *
     * @param int $idCurso Id do curso no qual o usuário será inscrito
     * @param string $linkInscricaoCodificado Link para inscrição codificado
     *
     * @return string
     */
    public function recuperarFormulario(int $idCurso, string $linkInscricaoCodificado) : string
    {
        
        return "
            <h4>Tenho Interesse</h4>
            <form method='post' id='formInscreveCurso'>
                <p class='margin-baixo-20'>
                <label for='nome'>Nome:</label>
                <input type='text' id='nome' name='nome' class='input-100' required>
                </p>
                <p class='margin-baixo-20'>
                <label for='email'>E-mail:</label>
                <input type='email' id='email' name='email' class='input-100' required>
                </p>
                <p class='margin-baixo-20'>		  
                <input type='submit' value='Enviar'>
                </p>
                <input type='hidden' value='{$idCurso}' id='curso'>
                <input type='hidden' value='{$linkInscricaoCodificado}' id='url'>
            </form>
            <div class='mensagem-inscricao sucesso'></div>";

    }

}
