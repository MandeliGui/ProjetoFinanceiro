<?php
require_once '../DAO/UtilDAO.php';




?>


<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Financeiro</a>
    </div>
    <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Olá, <strong><?= UtilDAO::NomeLogado() ?></strong>     ! - Duvidas Ligue para mim - <span><i class="fa fa-phone-square fa-10x"></i> <a href="https://contate.me/Guilherme.Mandeli" target="blank" style=" color:white;">(43) 99844-2622</a></span> </div>
</nav>