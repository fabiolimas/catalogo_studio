<div id="productList" class="row">
    <div class="errobusca"></div>
    @foreach ($produtos as $produto)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="product-card" >
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

            </div>
        </div>
        <button id="scrollTopButton" class="scroll-button" onclick="scrollToTop()"><i
                class="fas fa-arrow-up"></i></button>
        <button id="scrollBottomButton" class="scroll-button" onclick="scrollToBottom()"><i
                class="fas fa-arrow-down"></i></button>
                @include('painel.modais.modal_edicao')

                @include('painel.modais.modal_duplicar')
    @endforeach
    {{ $produtos->links() }}
</div>
