function aoCarregar(){
    mascaraInput();
    buscaTudo();
}

function mascaraInput(){
    $('#cep').mask('00000-000');
}

function buscaCEP(){
    var cep = $('#cep').val();
    $.ajax({
        type: 'GET',
        url: 'Controller.php?acao=CEP&cep='+cep,
        success: function(response){
            try{
                var object = JSON.parse(response);
            }catch{
                alert('CEP não encontrado.');
                return;
            }
            geraPesquisa(object);
            alert('Dados enviados com sucesso!');
        },
        error: function(){
            alert('Houve um erro ao enviar os dados.');
        }
    });
}

function geraPesquisa(dados){
    html = '<label>Pesquisa:</label><hr><p>CEP:'+dados.cep+'</p><p>Logradouro:'+dados.logradouro+'</p><p>Complemento:'+dados.complemento+'</p><p>Bairro:'+dados.bairro+'</p><p>Localidade:'+dados.localidade+'</p><p>UF:'+dados.uf+'</p><p>IBGE:'+dados.ibge+'</p>'; 
    $(".last-cep").html(html);
}

function geraCep(dados){
    html = ''; 
    dados.forEach(function(objeto) {
        html += '<div style="width: 250px;height: 75px;"><label>CEP: '+objeto.cep+'</label><br><label>Localidade: '+objeto.localidade+'</label><br><p style="text-align: center;"><input type="button" value="Excluir" onclick="excluirCep('+objeto.id+')"></p></div>';
    });
    $(".all").html(html);
}

function buscaTudo(){
    $.ajax({
        type: 'GET',
        url: 'Controller.php?acao=ALL',
        success: function(response){
            var object = JSON.parse(response);
            geraCep(object);
        },
        error: function(){
            alert('Houve um erro ao puxar os dados do cep.');
        }
    });
}

function excluirCep(id){
    $.ajax({
        type: 'DELETE',
        url: 'Controller.php?acao=DEL&id='+id,
        success: function(response){
            alert('CEP deletado');
            window.location.reload(true);
        },
        error: function(){
            alert('Houve um erro ao deletar o cep.');
        }
    });
}