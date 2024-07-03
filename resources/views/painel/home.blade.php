@extends('layouts.site')

@section('content')
<h2>Dashboard de Produtos</h2>
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Pesquisar produtos..." name="busca">
</div>
<button id="share-all-button" onclick="shareAllProducts()">Compartilhar Todos os Produtos</button>
<button class="add-button" data-toggle="modal" data-target="#addProductModal"><i class="fas fa-plus"></i></button>
<button class="share-button" onclick="sharePhotos()"><i class="fas fa-share-alt"></i></button>
<div class="prodbuscas"></div>
<div id="productList" class="row">
    <div class="errobusca"></div>
@foreach($produtos as $produto)
<div class="col-12 col-sm-6 col-md-4">
<div class="product-card" >
    <img src="{{Storage::url($produto->imagem)}}" class="product-image" alt="Imagem do produto" data-toggle="modal" data-target="#adicionar-{{$loop->index+1}}">
    <div class="product-info" data-toggle="modal" data-target="#adicionar-{{$loop->index+1}}">
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
    <div class="product-actions">

        <div class="row d-flex justify-content-center align-items-center" >
            <div class="col-md-3 ">
                <button class="btn btn-primary btn-sm mr-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#editProductModal-{{$loop->index+1}}" title="Editar"><i class="far fa-edit me-2" style="margin-right:2px"></i> Editar</button>
            </div>
        <div class="col-md-3"><a href="{{route('delete', $produto->id)}}" style="text-decoration:none"><button class="btn btn-danger btn-sm mr-2 d-flex justify-content-center align-items-center" title="Excluir"><i class="far fa-trash-alt " style="margin-right:2px"></i> Excluir</button></a></div>
        <div class="col-md-2"><a href="{{route('aumenta-estoque', $produto->id)}}"><button class="btn btn-success btn-sm mr-2 d-flex justify-content-center align-items-center"  title="Aumentar"><i class="far fa-plus-square"></i></button></a></div>
        <div class="col-md-2"><a href="{{route('diminui-estoque', $produto->id)}}"><button class="btn btn-warning btn-sm mr-2 d-flex justify-content-center align-items-center"  title="Diminuir"><i class="far fa-minus-square"></i></button></a></div>

    </div>
    </div>

</div>
</div>
<button id="scrollTopButton" class="scroll-button" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>
<button id="scrollBottomButton" class="scroll-button" onclick="scrollToBottom()"><i class="fas fa-arrow-down"></i></button>


{{-- editar produto --}}
<div class="modal fade" id="editProductModal-{{$loop->index+1}}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="post" action="{{route('update-produto')}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" id="editProductId" name="id" value="{{$produto->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductName">Nome do Produto</label>
                            <input type="text" class="form-control" id="editProductName" name="nome" value="{{$produto->nome}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductSize">Tamanho</label>
                            <input type="text" class="form-control" id="editProductSize" name="tamanho" value="{{$produto->tamanho}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductReference">Referência</label>
                            <input type="text" class="form-control" id="editProductReference" name="referencia" value="{{$produto->referencia}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductCategory">Categoria</label>
                            <select class="form-control" id="editProductCategory" name="categoria" required>
                                <option value="{{$produto->categoria}}" selected>{{$produto->categoria}}</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Infantil Masculino">Infantil Masculino</option>
                                <option value="Infantil Feminino">Infantil Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductBrand">Marca</label>
                            <input type="text" class="form-control" id="editProductBrand" name="marca" value="{{$produto->marca}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductColor">Cor</label>
                            <input type="text" class="form-control" id="editProductColor" name="cor" value="{{$produto->cor}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductStock">Estoque</label>
                            <input type="number" class="form-control" id="editProductStock" name="estoque" value="{{$produto->estoque}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductHeelSize">Tamanho do Salto</label>
                            <input type="number" step="0.1" class="form-control" id="editProductHeelSize" name="tamanho_salto" value="{{$produto->tamanho_salto}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductPrice">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="preco" value="{{$produto->preco}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductPrice">Preço Venda (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="preco_venda" value="{{$produto->preco_venda}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductImage">Imagem <img src="{{Storage::url($produto->imagem)}}" style="width: 108px; cursor:pointer"></label>
                            <input type="file" class="form-control" id="editProductImage" name="imagem" accept="image/*" >


                            {{-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="removeImage" name="remover_imagem">
                                <label class="form-check-label" for="removeImage">Remover imagem existente</label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Adicionar produto --}}
<div class="modal fade" id="adicionar-{{$loop->index+1}}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="post" action="{{route('adicionar-produto')}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="editProductId" name="id" value="{{$produto->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductName">Nome do Produto</label>
                            <input type="text" class="form-control" id="editProductName" name="nome" value="{{$produto->nome}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductSize">Tamanho</label>
                            <input type="text" class="form-control" id="editProductSize" name="tamanho" value="{{$produto->tamanho}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductReference">Referência</label>
                            <input type="text" class="form-control" id="editProductReference" name="referencia" value="{{$produto->referencia}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductCategory">Categoria</label>
                            <select class="form-control" id="editProductCategory" name="categoria" required>
                                <option value="{{$produto->categoria}}" selected>{{$produto->categoria}}</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Infantil Masculino">Infantil Masculino</option>
                                <option value="Infantil Feminino">Infantil Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductBrand">Marca</label>
                            <input type="text" class="form-control" id="editProductBrand" name="marca" value="{{$produto->marca}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductColor">Cor</label>
                            <input type="text" class="form-control" id="editProductColor" name="cor" value="{{$produto->cor}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductStock">Estoque</label>
                            <input type="number" class="form-control" id="editProductStock" name="estoque" value="{{$produto->estoque}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductHeelSize">Tamanho do Salto</label>
                            <input type="number" step="0.1" class="form-control" id="editProductHeelSize" name="tamanho_salto" value="{{$produto->tamanho_salto}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="editProductPrice">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="preco" value="{{$produto->preco}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editProductPrice">Preço Venda (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="preco_venda" value="{{$produto->preco_venda}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editProductImage">Imagem <img src="{{Storage::url($produto->imagem)}}" style="width: 108px; cursor:pointer" id="img-prev-1">
                            </label>
                            <input type="file" class="form-control" id="input-prev-1" name="imagem" accept="image/*">
                                <input type="hidden" value="{{$produto->imagem}}" name="imagemAtual">

                            {{-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="removeImage" name="remover_imagem">
                                <label class="form-check-label" for="removeImage">Remover imagem existente</label>
                            </div> --}}
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
                <form id="addProductForm" method="post" action="{{route('adicionar-produto')}}" enctype="multipart/form-data">
                    @csrf
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
                        <div class="form-group col-md-4">
                            <label for="editProductPrice">Preço Venda (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" name="preco_venda" >
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
<script>


function shareAllProducts() {
    const productCards = document.querySelectorAll('.product-card');
    let shareContent = '';
    let shareUrl = ''; // Uma URL representativa para compartilhar (pode ser a página atual ou uma URL específica)

    productCards.forEach(card => {
        const productName = card.querySelector('.product-name').textContent;
        shareContent += `Produto: ${productName}\n`;
        // Se quiser adicionar mais detalhes do produto, pode fazer algo assim:
        // const productDetails = card.querySelector('.product-info').innerText;
        // shareContent += `Produto: ${productName}\n${productDetails}\n\n`;
    });

    if (navigator.share) {
        navigator.share({
            title: 'Confira nossos produtos',
            text: shareContent,
            url: shareUrl // Pode ser a URL da página de produtos
        }).then(() => {
            console.log('Compartilhamento bem-sucedido!');
        }).catch((error) => {
            console.error('Erro ao compartilhar:', error);
        });
    } else {
        alert('A API de compartilhamento não é suportada no seu navegador.');
    }
}
</script>


    @stop
@stop
