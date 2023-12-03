function mascaraInput(){
    $('#cep').mask('00000-000');
}

function buscaCEP(){

}

function geraPesquisa(dados){
    html = '<label>Pesquisa:</label><hr><p>CEP:</p><p>Logradouro:</p><p>Complemento:</p><p>Bairro:</p><p>Localidade:</p><p>UF:</p><p>IBGE:</p>'; 
    $(".last-cep").html(html);
} 