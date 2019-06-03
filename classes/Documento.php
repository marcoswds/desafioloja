<?php

include_once('Conexao.php');

/**
 * Busca e tratamento para documento
 * @package classes
 */
class Documento extends Conexao {

   public function __construct(){}

   // Retorna os produtos cadastrados
   public function getVendas(){

      $consulta =
         " SELECT " .
         "    SUM(vl_total) AS valor_total, " .
         "    SUM(IF(sn_confirmado=1,vl_total,0)) AS valor_confirmado " .
         " FROM " .
         "    documento ";

      $resultado =  Conexao::getInstance()->realizaConsulta($consulta);

      return $resultado;
   }


   // Retorna os produtos cadastrados
   public function incluirDocumento(){

      $arrFiltros = array(
         'sn_confirmado' => '0',
         'vl_total' => '0'
      );

      $resultado =  Conexao::getInstance()->insert($arrFiltros, 'documento');
      return $resultado;
   }


   // Retorna os produtos cadastrados
   public function incluirDocumentoItem($arrFiltros){

      $resultado =  Conexao::getInstance()->insert($arrFiltros, 'documento_item');
      return $resultado;
   }

   // Retorna os itens do documento cadastrados
   public function getDocumentoItem($arrFiltros = array()){

      $filtro_sql = "";

      foreach ($arrFiltros as $key => $filtro) {
         $filtro_sql .= " AND ". $key . "='" . $filtro ."' ";
      }

      $consulta =
         "  SELECT
               *
            FROM
               documento_item di
               INNER JOIN produto p ON ( di.id_produto=p.id_produto )
            WHERE
               1=1  " .
              $filtro_sql .
         " ORDER BY   " .
         "    di.id_documento_item ";

      $resultado =  Conexao::getInstance()->realizaConsulta($consulta);

      return $resultado;
   }

   // Retorna os itens do documento cadastrados
   public function atualizaValorDocumento($id_documento){

      $consulta =
         "  UPDATE
               documento
            SET vl_total =
            (
               SELECT
                  SUM(p.vl_preco)
               FROM documento_item di
               INNER JOIN produto p ON (di.id_produto = p.id_produto)
               WHERE
                  di.id_documento = $id_documento
            )
            WHERE
               id_documento = $id_documento ";

      $resultado =  Conexao::getInstance()->executaQuery($consulta);

      return $resultado;
   }

   // Confirma o Documento
   public function confirmaDocumento($id_documento){

      $consulta =
         "  UPDATE
               documento
            SET sn_confirmado = 1
            WHERE
               id_documento = $id_documento ";

      $resultado =  Conexao::getInstance()->executaQuery($consulta);

      return $resultado;
   }

   // Confirma o Documento
   public function cancelaDocumento($id_documento){

      $consulta =
         "  DELETE
               di
            FROM
               documento d
               INNER JOIN documento_item di ON (d.id_documento = di.id_documento)
            WHERE
               d.id_documento = $id_documento ";

      $resultado1 =  Conexao::getInstance()->executaQuery($consulta);

      $consulta =
         "  DELETE
               d
            FROM
               documento d
            WHERE
               d.id_documento = $id_documento ";

      $resultado2 =  Conexao::getInstance()->executaQuery($consulta);

      return $resultado && $resultado2;
   }

}