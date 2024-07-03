// Start Scroll
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function scrollToBottom() {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
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
