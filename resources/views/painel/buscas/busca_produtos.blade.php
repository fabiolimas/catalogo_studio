<div id="productList" class="row">
    <div class="errobusca"></div>
    @foreach ($produtos as $produto)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="product-card" onclick="openCloneModal(${product.id}, event)">
                <img src="{{ Storage::url($produto->imagem)}}" class="product-image" alt="Imagem do produto">
                <div class="product-info">
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
    @endforeach
    {{ $produtos->links() }}
</div>
