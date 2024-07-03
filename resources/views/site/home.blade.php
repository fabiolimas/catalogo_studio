@extends('layouts.site')

@section('content')
<h2>Dashboard de Produtos</h2>
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Pesquisar produtos..." name="busca">
</div>


<button class="share-button" onclick="sharePhotos()"><i class="fas fa-share-alt"></i></button>
<div class="prodbuscas"></div>
<div id="productList" class="row">
    <div class="errobusca"></div>
@foreach($produtos as $produto)
<div class="col-12 col-sm-6 col-md-4">
<div class="product-card" onclick="openCloneModal(${product.id}, event)">
    <img src="{{Storage::url($produto->imagem)}}" class="product-image" alt="Imagem do produto">
    <div class="product-info">
        <div><strong>{{$produto->nome}}</strong></div>
        <div><strong>Tamanho:</strong> <span style="color:#fff">@</span>{{$produto->tamanho}}</div>
        <div><strong>Referência:</strong> {{$produto->referencia}}</div>
        <div><strong>Categoria:</strong> {{$produto->categoria}}</div>
        <div><strong>Cor:</strong> {{$produto->cor}}</div>
        <div><strong>Marca:</strong> {{$produto->marca}}</div>
        <div><strong>Estoque:</strong> {{$produto->estoque}}</div>
        @if(Auth::user())<div><strong>Preço:</strong> {{$produto->preco}}</div>@else @endif
        {{-- ${product.tamanho_salto ? `<div><strong>Tamanho do Salto:</strong> ${product.tamanho_salto}</div>` : ''} --}}
    </div>

</div>
</div>
<button id="scrollTopButton" class="scroll-button" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
<button id="scrollBottomButton" class="scroll-button" onclick="scrollToBottom()"><i class="fas fa-arrow-down"></i></button>



@endforeach
{{ $produtos->links() }}
</div>
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productName">Nome do Produto</label>
                            <input type="text" class="form-control" id="productName" name="nome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="productSize">Tamanho</label>
                            <input type="text" class="form-control" id="productSize" name="tamanho" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productReference">Referência</label>
                            <input type="text" class="form-control" id="productReference" name="referencia" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="productCategory">Categoria</label>
                            <select class="form-control" id="productCategory" name="categoria" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Infantil Masculino">Infantil Masculino</option>
                                <option value="Infantil Feminino">Infantil Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productBrand">Marca</label>
                            <input type="text" class="form-control" id="productBrand" name="marca" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="productColor">Cor</label>
                            <input type="text" class="form-control" id="productColor" name="cor" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productStock">Estoque</label>
                            <input type="number" class="form-control" id="productStock" name="estoque" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="productHeelSize">Tamanho do Salto</label>
                            <input type="number" step="0.1" class="form-control" id="productHeelSize" name="tamanho_salto">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productPrice">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="productPrice" name="preco" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="productImage">Imagem</label>
                            <input type="file" class="form-control" id="productImage" name="imagem" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')

    @stop
@stop
