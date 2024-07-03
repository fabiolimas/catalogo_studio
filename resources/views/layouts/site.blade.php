<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Produtos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/script.js')}}"></script>
</head>
<body>
    <div class="container">
        @include('site.scripts')
        @yield('content')
    </div>
    @yield('scripts')

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


             @if(Session::has('success'))

             <script>

             swal("Sucesso!","{{Session::get('success')}}", "success",{

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
             </script>

             @elseif(Session::has('fail'))
             <script>

                 swal("Ops!", "{{Session::get('fail')}}","error",{

                     closeOnClickOutside: false, //não fecha o swal se clicar fora
                     dangerMode: true, //danger mode pra chamar atenção
                     closeOnEsc: false, // não deixa fechar no esc
                     buttons: {

                confirmar: { // botao confirmar
                    text: "Falha!", // texto do botão
                    value: "ok", // valor pra gente testar la em baixo
                    className: "swal-button--confirm", // classe do botão css
                },


             },
             icon: "danger", // icone do swal
             }

             );
             </script>
             @endif

</body>
</html>
