function ValidarMeusDados() {
    NotificarCampos("nome", "val_nome");
    NotificarCampos("email", "val_email");
    
    
    
    
    
    
    if ($("#nome").val().trim() == '' || $("#email").val().trim() == '') {
        alert("Preencher o(s) campo(s) obrigatórios");
        return false;
    }

}
function ValidarCategoria() {   
    NotificarCampos("nome", "val_nome");

    if ($("#nome").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatório(s)");
        return false;
    }
}
function ValidarEmpresa() {
    NotificarCampos("nome", "val_nome");

       
    
    
    if ($("#nome").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatorio(s)");
        $("#nome").focus();
        return false;
    }
}
function ValidarConta() {
    NotificarCampos("nome", "val_nome");
    NotificarCampos("agencia", "val_agencia");
    NotificarCampos("conta", "val_conta");
    NotificarCampos("saldo", "val_saldo");
    
    if ($("#nome").val().trim() == '' || $("#agencia").val().trim() == ''|| $("#conta").val().trim() == '' || $("#saldo").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatorio(s)");
        return false;
    }

}
function ValidarAlterarConta() {
    NotificarCampos("nome", "val_nome");
    NotificarCampos("agencia", "val_agencia");
    NotificarCampos("conta", "val_conta");
    
    
    if ($("#nome").val().trim() == '' || $("#agencia").val().trim() == ''|| $("#conta").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatorio(s)");
        return false;
    }

}
function ValidarMovimento() {
    NotificarCampos("tipo", "val_tipo");
    NotificarCampos("data", "val_data");
    NotificarCampos("valor", "val_valor");
    NotificarCampos("categoria", "val_categoria");
    NotificarCampos("empresa", "val_empresa");
    NotificarCampos("conta", "val_conta");
    
    if ($("#tipo").val().trim() == '' || $("#data").val().trim() == '' || $("#valor").val().trim() == '' || $("#categoria").val().trim() == '' || $("#empresa").val().trim() == '' || $("#conta").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatorio(s)");
        return false;
    }
}
function ConsultarMovimento(){
    NotificarCampos("dataini", "val_dataini");
    NotificarCampos("datafim", "val_datafim")
    
    if ($("#dataini").val().trim() == '' || $("#datafim").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatorio(s)");
        return false;
    }

}
function ValidarLogin(){
    if ($("#email").val().trim() == '') {
        alert("Preencha o campo EMAIL");
        $("#email").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencha o campo SENHA");
        $("#senha").focus();
        return false;
    }
}
function ValidarCadastro(){
    if ($("#nome").val().trim() == '') {
        alert("Preencha o campo NOME");
        $("#nome").focus();
        return false;
    }
    if ($("#email").val().trim() == '') {
        alert("Preencha o campo EMAIL");
        $("#email").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencha o campo SENHA");
        $("#senha").focus();
        return false;
    }
    if($("#senha").val().trim().length < 6){
        alert("A senha deve conter no mínimo 6 caracteres");
        $("#senha").focus();
        return false;
    }
    if ($("#rsenha").val().trim() != $("#senha").val().trim()) {
        alert("os campos SENHA e REPETIR SENHA devem ser iguais");
        $("#rsenha").focus();
        return false;
    }
}
function NotificarCampos(id, val){

    if($("#" + id).val().trim()==''){
        $("#" + val).addClass("has-error")
    }
    else{
        $("#" + val).removeClass("has-error").addClass("has-success");
    }

}
function ConsultarMovimentoValor(){
    NotificarCampos("dataini", "val_dataini");
    NotificarCampos("datafim", "val_datafim");
    NotificarCampos("valor", "val_valor")
    
    if ($("#dataini").val().trim() == '' || $("#datafim").val().trim() == '' || $("#valor").val().trim() == '') {
        alert("Preencha o(s) campo(s) obrigatorio(s)");
        return false;
    }
}

// Permitir somente numeros no input//
function onlynumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /^[0-9.,]+$/;
    //var regex = /^[0-9.]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
 }
