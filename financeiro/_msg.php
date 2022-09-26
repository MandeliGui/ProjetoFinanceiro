<?php
if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}


if (isset($ret)) {

    switch ($ret) {
        case -1:
            echo '<div class="alert alert-danger">
                Ocorreu um erro na operação, tente mais tarde
            </div>';
            break;
        case 0:
            echo '<div class="alert alert-warning">
            Preencher o(s) Campo(s) obrigatório(s)
        </div>';
            break;
        case 1:
            echo '<div class="alert alert-success">
                Ação realizada com sucesso
            </div>';
            break;
        case 2:
            echo '<div class="alert alert-warning">
                A senha deve conter no mínimo 6 caracteres
            </div>';
            break;
        case 3:
            echo '<div class="alert alert-warning">
                O campo senha e repetir senha devem ser iguais
            </div>';
            break;
        case 4:
            echo '<div class="alert alert-warning">
                O campo não pode ser exluido, pois já esta em uso!
            </div>';
            break;
        case 5:
            echo '<div class="alert alert-info">
                    Não existem dados para esta pesquisa!
                </div>';
            break;
        case 6:
            echo '<div class="alert alert-danger">
                        Email ja cadastrado! Coloque outro Email.
                    </div>';
            break;
        case 7:
            echo '<div class="alert alert-danger">
                            Usuario não encontrado.
                        </div>';
            break;
    }
}
