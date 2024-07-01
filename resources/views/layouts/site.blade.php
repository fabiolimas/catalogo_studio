<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .scroll-button {
    position: fixed;
    bottom: 80px; /* Ajuste a partir do fundo para evitar a sobreposição */
    width: 50px;
    height: 50px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s;
    z-index: 1000;
}
.scroll-button:hover {
    background-color: #0056b3;
}
#scrollTopButton {
    right: 20px;
}
#scrollBottomButton {
    left: 20px;
}
.add-button, .share-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .add-button:hover {
            background-color: #0056b3;
        }
        .share-button {
            left: 20px;
            right: auto;
            background-color: #28a745;
        }
        .share-button:hover {
            background-color: #1e7e34;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding-bottom: 60px;
        }
        .container {
            padding: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .product-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            transition: box-shadow 0.3s;
            cursor: pointer;
        }
        .product-card:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }
        .product-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .modal-lg {
            max-width: 80%;
        }
        .modal-body form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .product-info div {
            margin-bottom: 5px;
        }
        .modal-header, .modal-footer {
            background-color: #007BFF;
            color: white;
        }
        .modal-footer {
            background-color: #f9f9f9;
            border-top: 1px solid #e5e5e5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }
        .modal-footer .btn {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            transition: background-color 0.3s, color 0.3s;
        }
        .modal-footer .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }
        .modal-footer .btn-secondary:hover {
            background-color: #e0e0e0;
            color: #000;
        }
        .modal-footer .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
        .modal-footer .btn-primary:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .scroll-button {
            position: fixed;
            bottom: 80px; /* Ajuste a partir do fundo para evitar a sobreposição */
            width: 50px;
            height: 50px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
            z-index: 1000;
        }
        .scroll-button:hover {
            background-color: #0056b3;
        }
        #scrollTopButton {
            right: 20px;
        }
        #scrollBottomButton {
            left: 20px;
        }
        @media (max-width: 576px) {
            .product-card {
                flex-direction: column;
                align-items: flex-start;
            }
            .product-info {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function shareImages(files, descriptions) {
            if (navigator.canShare && navigator.canShare({ files })) {
                navigator.share({
                    files,
                    title: 'Produtos',
                    //text: descriptions.join('\n\n'),
                }).then(() => {
                    console.log('Compartilhamento bem-sucedido');
                }).catch((error) => {
                    console.log('Erro ao compartilhar', error);
                });
            } else {
                Swal.fire({
                    title: 'Navegador não suporta compartilhamento de arquivos',
                    icon: 'info',
                    confirmButtonText: 'Fechar'
                });
            }
        }

        async function urlToFile(url) {
            const response = await fetch(url);
            const blob = await response.blob();
            const name = url.split('/').pop();
            return new File([blob], name, { type: blob.type });
        }

        function searchProducts() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const keywords = input.split(' ');
            const cards = document.querySelectorAll('.product-card');
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const matches = keywords.every(keyword => text.includes(keyword));
                card.style.display = matches ? '' : 'none';
            });
        }
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function scrollToBottom() {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }
    </script>

</body>
</html>
