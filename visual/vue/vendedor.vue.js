const VENDEDOR = new Vue({
   el: '#vendedor',
   data: {
      arrProdutoNovo     : [],
      arrProdutos        : [],
      id_documento       : '',
      cd_produto         : ''

   },

   methods: {

      getProdutos: function () {

         var arrDados = {
            id_documento : this.id_documento
         };

         axios
         .post("ajax/documento/getDocumentoItem.php",
            Object.assign({}, arrDados))
         .then(response => {
            this.arrProdutos = response.data;
         });
      },

      atualizaValorDocumento: function () {

         var arrDados = {
            id_documento : this.id_documento
         };

         axios
         .post("ajax/documento/atualizaValorDocumento.php",
            Object.assign({}, arrDados))
         .then(response => {

         });
      },

      incluirProduto: function () {

         return new Promise((resolve) => {

            if (this.id_documento == 0){
               axios
               .get("ajax/documento/incluirDocumento.php")
               .then(response => {
                  this.id_documento = response.data.id;
                  resolve();
               });
            } else {
               resolve();
            }

         })
         .then(response => {

            var arrDados = {
               cd_produto : this.cd_produto
            };

            axios
            .post("ajax/produto/validaProduto.php",
             Object.assign({}, arrDados))
            .then(response => {

               var arrResposta = response.data;

               if(arrResposta.length == 0) {

                  M.toast(
                     {
                        html:'<i class="material-icons left">close</i> Não existe produto com este código!',
                        classes: 'red',
                        displayLength: '5000'
                     }
                  );

               } else {
                  //Inclui os produtos
                  var arrDados = {
                     id_documento : this.id_documento,
                     id_produto : arrResposta[0].id_produto
                  };

                  axios
                  .post("ajax/documento/incluirDocumentoItem.php",
                   Object.assign({}, arrDados))
                  .then(response => {
                     if (response.data.sucesso == true) {

                        M.toast({html: 'Produto incluído com sucesso!', classes: 'green', displayLength: '3000'});
                        this.getProdutos();
                        this.atualizaValorDocumento();

                     } else {

                        M.toast(
                           {
                              html: '<i class="material-icons left">close</i>O sistema não conseguiu incluir um produto na lista. Favor verificar sua conexão.',
                              classes: 'red',
                              displayLength: '5000'
                           }
                        );
                     }
                  });
               }
            });
         });
      },

      confirmaDocumento: function () {

         if(this.id_documento == ''){
            M.toast(
               {
                  html: '<i class="material-icons left">close</i>Para confirmar uma venda é necessário pelo menos 1 item.',
                  classes: 'red',
                  displayLength: '5000'
               }
            );
            return;
         }

         var arrDados = {
            id_documento : this.id_documento
         };

         axios
         .post("ajax/documento/confirmaDocumento.php",
            Object.assign({}, arrDados))
         .then(response => {

            if (response.data.sucesso == true) {

               M.toast({html: 'Venda registrada com sucesso!', classes: 'green', displayLength: '3000'});
               this.arrProdutos = [];
               this.id_documento = '';
               this.cd_produto = '';

            } else {

               M.toast(
                  {
                     html: '<i class="material-icons left">close</i>O sistema não conseguiu concluir sua requisição. Favor verificar sua conexão.',
                     classes: 'red',
                     displayLength: '5000'
                  }
               );
            }

         });

      },

      cancelaDocumento: function () {

         var arrDados = {
            id_documento : this.id_documento
         };

         axios
         .post("ajax/documento/cancelaDocumento.php",
            Object.assign({}, arrDados))
         .then(response => {

            this.arrProdutos = [];
            this.id_documento = '';
            this.cd_produto = '';

         });

      },

   },
   mounted () {

      $('.tabs').tabs();
      $('.modal').modal();
      $('.tooltipped').tooltip();

   }

})