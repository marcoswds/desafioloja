<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);

include_once('../../classes/Documento.php');

$ds_post          = file_get_contents("php://input");
$arrFiltros       = json_decode($ds_post, true);

$objDocumento = new Documento();
$arrProdutos = $objDocumento->getDocumentoItem($arrFiltros);

if($arrProdutos == null){
   $arrProdutos = array();
}

echo json_encode($arrProdutos);