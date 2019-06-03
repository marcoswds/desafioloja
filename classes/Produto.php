<?php

include_once('Conexao.php');

/**
 * Busca e tratamento para produto
 * @package classes
 */
class Produto extends Conexao {

   public function __construct(){}

   // Retorna os produtos cadastrados
   public function getProdutos($arrFiltros = array()){

      $filtro_sql = "";

      foreach ($arrFiltros as $key => $filtro) {
         $filtro_sql .= " AND ". $key . "='" . $filtro ."' ";
      }

      $consulta =
         " SELECT     " .
         "    *       " .
         " FROM       " .
         "    produto " .
         " WHERE      " .
         "    1 = 1   " .
              $filtro_sql .
         " ORDER BY   " .
         "    ds_produto ";

      $resultado =  Conexao::getInstance()->realizaConsulta($consulta);

      return $resultado;
   }

   // Retorna os produtos cadastrados
   public function incluirProduto($arrFiltros){

      $resultado =  Conexao::getInstance()->insert($arrFiltros, 'produto');
      return $resultado;
   }


}