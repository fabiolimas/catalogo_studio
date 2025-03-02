@extends('layouts.site')

@section('content')

    <h2>Dashboard de Produtos</h2>
    <div class="search-bar">
        <input type="text" id="searchInputAdmin" placeholder="Pesquisar produtos..." name="busca">
    </div>

    <button class="add-button" data-toggle="modal" data-target="#addProductModal"><i class="fas fa-plus"></i></button>
    <button class="share-button" onclick="sharePhotos()" style="z-index:9999"><i class="fas fa-share-alt"></i></button>

    <div id="productList" class="row">
        <div class="errobusca"></div>
        @foreach ($produtos as $produto)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="product-card">
                    <img src="{{ Storage::url($produto->imagem) }}" class="product-image" alt="Imagem do produto"
                        data-toggle="modal" data-target="#adicionar-{{ $loop->index + 1 }}">
                    <div class="product-info" data-toggle="modal" data-target="#adicionar-{{ $loop->index + 1 }}">
                        <div><strong>{{ $produto->nome }}</strong></div>
                        <div><strong>Tamanho:</strong> <span style="color:#fff">@</span>{{ $produto->tamanho }}</div>
                        <div><strong>Referência:</strong> {{ $produto->referencia }}</div>
                        <div><strong>Categoria:</strong> {{ $produto->categoria }}</div>
                        <div><strong>Cor:</strong> {{ $produto->cor }}</div>
                        <div><strong>Marca:</strong> {{ $produto->marca }}</div>
                        <div><strong>Estoque:</strong> {{ $produto->estoque }}</div>
                        @if (Auth::user())
                            <div><strong>Preço:</strong> {{ $produto->preco }}</div>
                        @else
                        @endif

                        {{-- ${product.tamanho_salto ? `<div><strong>Tamanho do Salto:</strong> ${product.tamanho_salto}</div>` : ''} --}}
                    </div>
                    <div class="product-actions">

                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-3 ">
                                <button class="btn btn-primary btn-sm mr-2 d-flex justify-content-center align-items-center"
                                    data-toggle="modal" data-target="#editProductModal-{{ $loop->index + 1 }}"
                                    title="Editar"><i class="far fa-edit me-2" style="margin-right:2px"></i> Editar</button>
                            </div>
                            <div class="col-md-3"><a href="{{ route('delete', $produto->id) }}"
                                    style="text-decoration:none"><button
                                        class="btn btn-danger btn-sm mr-2 d-flex justify-content-center align-items-center"
                                        title="Excluir"><i class="far fa-trash-alt " style="margin-right:2px"></i>
                                        Excluir</button></a></div>
                            <div class="col-md-2"><a href="{{ route('aumenta-estoque', $produto->id) }}"><button
                                        class="btn btn-success btn-sm mr-2 d-flex justify-content-center align-items-center"
                                        title="Aumentar"><i class="far fa-plus-square"></i></button></a></div>
                            <div class="col-md-2"><a href="{{ route('diminui-estoque', $produto->id) }}"><button
                                        class="btn btn-warning btn-sm mr-2 d-flex justify-content-center align-items-center"
                                        title="Diminuir"><i class="far fa-minus-square"></i></button></a></div>

                        </div>
                    </div>

                </div>
            </div>
            <button id="scrollTopButton" class="scroll-button" onclick="scrollToTop()"><i
                    class="fas fa-arrow-up"></i></button>
            <button id="scrollBottomButton" class="scroll-button" onclick="scrollToBottom()"><i
                    class="fas fa-arrow-down"></i></button>



            @include('painel.modais.modal_edicao')

            @include('painel.modais.modal_duplicar')
        @endforeach

    </div>
    {{ $produtos->links() }}
    @include('painel.modais.modal_adicionar_novo')

    <script>

async function sharePhotos() {


            const cards = document.querySelectorAll('.product-card');
            const imageMap = new Map();

            Array.from(cards).forEach(card => {
                if (card.style.display !== 'none') {
                    const img = card.querySelector('.product-image');
                    const src = img.src;
                    const productInfo = card.querySelector('.product-info').innerText;
                    const productName = card.querySelector('.product-info div strong').innerText;
                    const size = productInfo.match(/Tamanho:\s(\S+)/)[1];
                    if (!imageMap.has(src)) {
                        imageMap.set(src, { image: img, sizes: new Set(), productName: productName });
                    }
                    imageMap.get(src).sizes.add(size);
                }
            });

            const images = [];
            const descriptions = [];
            for (let [src, { image, sizes, productName }] of imageMap) {
                images.push(await urlToFile(src));
                descriptions.push(`No modelo ${productName} temos os tamanhos: ${Array.from(sizes).join(', ')}`);
            }



            if (images.length > 0) {
               shareImages(images, descriptions);




            } else {
                Swal.fire({
                    title: 'Nenhuma foto para compartilhar',
                    icon: 'info',
                    confirmButtonText: 'Fechar'
                });
            }
        }




        function shareImages(files, descriptions) {
            if (navigator.canShare && navigator.canShare({ files })) {
                navigator.share({
                    files,
                    title: 'Produtos',
                    text: descriptions.join('\n\n'),
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

        function shareDescricao(descriptions) {
            if (navigator.canShare) {
                navigator.share({

                    title: 'Produtos',
                    text: descriptions.join('\n\n'),
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
    </script>

@stop
