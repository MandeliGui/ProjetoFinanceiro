function FiltrarCategoria(valor){
    var texto = $("#pesquisa").val().trim();
    if($("#pesquisa").val().trim().length > 2){
        location = "consultar_categoria.php?filtro=" + valor;
    }
}
function FiltrarEmpresa(valor){
    let id = $("#id").val();
    if(valor.length > 2){
        location = "consultar_empresa.php?filtro=" + valor + "&id=" + id;
    }
}
