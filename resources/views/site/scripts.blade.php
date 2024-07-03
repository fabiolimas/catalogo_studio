<script>
    // Start Scroll
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }
    // end Scroll

    // Buscas


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // buscar produtos cliente

    $(document).ready(function() {
        function buscarProdutos() {
            var busca = $("#searchInput").val();
            // Obtém o valor da caixa de pesquisa
            $.ajax({
                url: "{{ route('busca-produtos') }}", // Arquivo PHP que processará a busca
                type: "get",
                data: {
                    busca: busca
                }, // Dados a serem enviados para o servidor
                success: function(response) {

                    console.log(response)
                    $("#productList").html(response);
                    $(".errobusca").html(response.status);

                },
                error: function(result) {
                    console.log(result);
                }
            });
        }
        $("#searchInput").keyup(function() {
            buscarProdutos()
        });

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //buscar produtos admin

    $(document).ready(function() {
        function buscarProdutosAdmin() {
            var busca = $("#searchInputAdmin").val();
            // Obtém o valor da caixa de pesquisa
            $.ajax({
                url: "{{ route('busca-produtos-admin') }}", // Arquivo PHP que processará a busca
                type: "get",
                data: {
                    busca: busca
                }, // Dados a serem enviados para o servidor
                success: function(response) {

                    console.log(response)
                    $("#productList").html(response);
                    $(".errobusca").html(response.status);

                },
                error: function(result) {
                    console.log(result);
                }
            });
        }
        $("#searchInputAdmin").keyup(function() {
            buscarProdutosAdmin()
        });

    });

    // fim buscas

    //edição

    $(document).ready(function() {

        $('#editBtn').click(function() {
            $.ajax({
                url: "{{ route('update-produto') }}",
                type: "get",
                data: {
                    id: $("#editProductId").val(),
                    nome: $("#editProductName").val(),
                    tamanho: $("#editProductSize").val(),
                    referencia: $("#editProductReference").val(),
                    categoria: $("#editProductCategory").val(),
                    marca: $("#editProductBrand").val(),
                    cor: $("#editProductColor").val(),
                    estoque: $("#editProductStock").val(),
                    tamanho: $("#editProductHeelSize").val(),
                    preco: $("#editProductPrice").val(),
                    preco_venda: $("#editProductPriceVenda").val(),
                    imagem: $("#editProductImage").val(),
                },
                success: function(response) {

                    console.log(response.status);

                    swal("Sucesso!", "{{ Session::get('success') }}", response.status, {

                            closeOnClickOutside: false, //não fecha o swal se clicar fora
                            dangerMode: true, //danger mode pra chamar atenção
                            closeOnEsc: false, // não deixa fechar no esc
                            buttons: {

                                confirmar: { // botao confirmar
                                    text: "Ok", // texto do botão
                                    value: "ok", // valor pra gente testar la em baixo
                                    className: "swal-button--confirm", // classe do botão css
                                },


                            },
                            icon: "success",
                        }

                    );


                },
                error: function(result) {
                    console.log(result);
                }
            });
        });





    });
</script>
