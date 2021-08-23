const $j = jQuery.noConflict();

$j(document).ready(function() {
	$j('#formInscreveCurso').on('submit', enviaFormInscricaoCurso);
});

function enviaFormInscricaoCurso(e) {
	e.preventDefault();
	$j('.mensagem-inscricao').hide().removeClass('erro').removeClass('sucesso').text('');
	const nome = $j.trim($j('#nome').val());
	const email = $j.trim($j('#email').val());
	const idCurso = $j.trim($j('#curso').val());
	const urlInscricao = window.atob($j.trim($j('#url').val()));
	const validaDados = validaDadosForm(nome, email, idCurso, urlInscricao);
	if (validaDados === true) {
		fazRequisicao(nome, email, idCurso, urlInscricao);
	}
}

function fazRequisicao(nome, email, idCurso, urlInscricao) {
	const dados = {};
	dados.nome = nome;
	dados.email = email;
	dados.idCurso = idCurso;
	$j.ajax({
	 url : URL + "/wp-json/cursos-fuerza/v1/inscricao",
	 type : 'POST',
	 data : dados,
	 dataType: "json"
	})
	.success(function(dados){
		if (dados.erro === true) {
			$j('.mensagem-inscricao').addClass('erro');
		} else {
			$j('.mensagem-inscricao').addClass('sucesso');
			redireciona(urlInscricao);
		}
		$j('.mensagem-inscricao').show().text(dados.mensagem);
	})
	.fail(function(jqXHR, textStatus, msg){
		$j('.mensagem-inscricao').show().text('Falha na requisição, tente novamente mais tarde');
	});
}

function validaDadosForm(nome, email, idCurso, urlInscricao) {
	if (nome == '') {
		$j('.mensagem-inscricao').show().addClass('erro').text('O campo nome é obrigatório');
		return false;
	}
	if (email == '' || validaEmail(email) === false) {
		$j('.mensagem-inscricao').show().addClass('erro').text('O campo email não é um email válido');
		return false;
	}
	if (idCurso == '') {
		$j('.mensagem-inscricao').show().addClass('erro').text('Curso não identificado');
		return false;
	}
	if (urlInscricao == '') {
		$j('.mensagem-inscricao').show().addClass('erro').text('Inscrição não identificada');
		return false;
	}
	return true;
}

function validaEmail(email) {
  let re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function redireciona(url) {
	setTimeout(function(){ window.open(url); }, 1500);
}
