<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);

include_once('../../classes/Documento.php');

$ds_post    = file_get_contents("php://input");
$arrRetorno = json_decode($ds_post, true);

$objDocumento = new Documento();
$arrDocumento = $objDocumento->atualizaValorDocumento($arrRetorno['id_documento']);

$arrResultado = array(
   'sucesso' => false
);

if($arrDocumento){
   $arrResultado = array(
      'sucesso' => true
   );
}

echo json_encode($arrResultado);