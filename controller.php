<?php

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Recife');

$menuOptions = [
    "ListagemLocais" => "Cadastro de Locais",
    "ListagemEventos" => "Cadastro de Eventos",
    "ListagemProgramacoes" => "Cadastro de Programações"
];

function setMain( $page )
{
    if ( !empty( $page ) &&  file_exists( "views/{$page}View.php" ) ) {
        require_once "views/{$page}View.php";
    } else {
        require_once "views/ListagemEventosView.php";
    }
}

function setHeader()
{
    global $menuOptions;

    $header = file_get_contents( "resources/app/html/header.html" );

    $menubar = "";
    foreach ( $menuOptions as $page => $title ) {
       $menubar .= '<li><a href="index.php?page='.$page.'">'.$title.'</a></li>';
    }

    $header = str_replace( "{OPTIONS}", $menubar, $header );

    echo $header;
}

function setFooter()
{
    echo file_get_contents( "resources/app/html/footer.html" );
}

function setStyles()
{
    echo file_get_contents( "resources/app/html/styles.html" );
}

function setScripts()
{
    echo file_get_contents( "resources/app/html/scripts.html" );
}
