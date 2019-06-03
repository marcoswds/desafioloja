<?php
session_start();
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html>

<!-- Jquery 3.4.0 -->
<script src="visual/js/jquery-3.4.0.min.js"></script>

<!-- Vue JS 2.6.10 -->
<script src="visual/js/vue-2.6.10.min.js"></script>

<!-- Axios 0.18.0 -->
<script src="visual/js/axios-0.18.0.min.js"></script>

<!-- Estilos CSS -->
<link rel="stylesheet" href="visual/css/estilos.min.css">

<!-- Material Icons Font -->
<link href="visual/fonts/material_icons_css.css" rel="stylesheet">

<!-- Materialize CSS 1.0.0 -->
<link rel="stylesheet" href="visual/css/materialize.min.css">

<!-- Vue-the-mask -->
<script src="visual/js/vue-the-mask.js"></script>

<!-- V-money -->
<script src="visual/js/v-money.js"></script>

<body class="grey lighten-4">

   <main id="admin" class="l-padding-20">

      <div class="row">
         <div class="col s12">
            <ul class="tabs z-depth-1">
               <li class="tab col s6"><a class="active black-text" href="#cadastro">Cadastro de Produtos</a></li>
               <li class="tab col s6"><a class="active black-text" href="#relatorio">Relatório de Vendas</a></li>
            </ul>

         </div>

         <div id="cadastro" class="col s12">

            <div class="white z-depth-1 l-min-height-50">
               <div class=" l-pagina-cabecalho">
                  <h5>Cadastro de Produtos</h5>
                  <div class="button-box" >

                     <a class="btn-floating waves-effect white modal-trigger tooltipped l-border-radius-5" data-position="bottom" data-tooltip="Voltar" href="index.php">
                        <i class="material-icons black-text">arrow_back</i>
                     </a>

                     <a class="btn-floating waves-effect white modal-trigger tooltipped l-border-radius-5" data-position="bottom" data-tooltip="Novo Produto" href="#modal_novo_produto">
                        <i class="material-icons black-text">add</i>
                     </a>
                  </div>
               </div>
               <table class="centered">
                  <thead>
                     <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                     </tr>
                  </thead>

                  <tbody>
                     <tr v-for="produto in arrProdutos">
                        <td>{{ produto.cd_produto }}</td>
                        <td>{{ produto.ds_produto }}</td>
                        <td>R$ {{ produto.vl_preco }}</td>
                    </tr>
                  </tbody>
               </table>
            </div>

            <div id="modal_novo_produto" class="modal modal-fixed-footer">
               <div class="modal-content">
                  <h5>Novo Produto</h5>

                  <div class="row l-margin-top-20 l-margin-bottom-0">

                     <!-- Código -->
                     <div class="input-field col s12">
                        <input
                           id="cd_produto"
                           v-model="arrProdutoNovo.cd_produto"
                           type="text"
                           maxlength="20"
                           title="Código do Produto"
                           required
                        >
                        <label for="cd_produto">Código do Produto</label>
                     </div>

                     <!-- Descrição -->
                     <div class="input-field col s12">
                        <input
                           id="ds_produto"
                           v-model="arrProdutoNovo.ds_produto"
                           type="text"
                           maxlength="255"
                           title="Descrição do Produto"
                           required
                        >
                        <label for="ds_produto">Descrição do Produto</label>
                     </div>

                     <!-- Valor -->
                     <div class="input-field col s12">
                        <input
                           id="vl_valor"
                           v-model="arrProdutoNovo.vl_preco"
                           type="text"
                           title="Preço do Produto"
                           v-money="money"
                           required
                        >
                        <label for="vl_valor">Preço do Produto</label>
                     </div>

                  </div>
               </div>
               <div class="modal-footer">
                  <button id="btn_criar" class="btn" @click="submitForm(false)">Criar e Continuar</button>
                  <button id="btn_criar" class="btn" @click="submitForm(true)">Criar e Fechar</button>
                  <button class="modal-close btn white black-text">Cancelar</button>
               </div>

            </div>

         </div>
         <div id="relatorio" class="col s12">
            <div class="white z-depth-1">
               <div class=" l-pagina-cabecalho">
                  <h5>Relatório de Vendas</h5>

                  <div class="button-box" >
                     <a class="btn-floating waves-effect white modal-trigger tooltipped l-border-radius-5" data-position="bottom" data-tooltip="Voltar" href="index.php">
                        <i class="material-icons black-text">arrow_back</i>
                     </a>
                  </div>

               </div>

               <div class="col s6 l3 offset-l3">
                  <div class="card card-panel white">
                     <div class="card-title center">
                        <h2>
                           R$ {{ vendas_confirmadas }}
                        </h2>
                     </div>
                     <div class="card-title center">
                        <p><strong>Vendas confirmadas</strong></p>
                     </div>
                  </div>
               </div>
               <div class="col s6 l3">
                  <div class="card card-panel white">
                     <div class="card-title center">
                        <h2>
                           R$ {{ vendas_total }}
                        </h2>
                     </div>
                     <div class="card-title center">
                        <p><strong>Total de Vendas</strong></p>
                     </div>
                  </div>
               </div>
            </div>

         </div>

      </div>


   </main>

</body>

<!-- Materialize JS 1.0.0 -->
<script src="visual/js/materialize.min.js"></script>

<!-- COMPONENTES VUE -->
<script src="visual/vue/admin.min.vue.js"></script>

</html>