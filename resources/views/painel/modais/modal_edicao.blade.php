{{-- editar produto --}}
<div class="modal fade" id="editProductModal-{{ $loop->index + 1 }}" tabindex="-1" role="dialog"
    aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="post" action="{{ route('update-produto') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" id="editProductId" name="id" value="{{ $produto->id }}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductName">Nome do Produto</label>
                            <input type="text" class="form-control" id="editProductName" name="nome"
                                value="{{ $produto->nome }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductSize">Tamanho</label>
                            <input type="text" class="form-control" id="editProductSize" name="tamanho"
                                value="{{ $produto->tamanho }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductReference">Referência</label>
                            <input type="text" class="form-control" id="editProductReference"
                                name="referencia" value="{{ $produto->referencia }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductCategory">Categoria</label>
                            <select class="form-control" id="editProductCategory" name="categoria" required>
                                <option value="{{ $produto->categoria }}" selected>{{ $produto->categoria }}
                                </option>
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
                            <input type="text" class="form-control" id="editProductBrand" name="marca"
                                value="{{ $produto->marca }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductColor">Cor</label>
                            <input type="text" class="form-control" id="editProductColor" name="cor"
                                value="{{ $produto->cor }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductStock">Estoque</label>
                            <input type="number" class="form-control" id="editProductStock" name="estoque"
                                value="{{ $produto->estoque }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductHeelSize">Tamanho do Salto</label>
                            <input type="number" step="0.1" class="form-control"
                                id="editProductHeelSize" name="tamanho_salto"
                                value="{{ $produto->tamanho_salto }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editProductPrice">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice"
                                name="preco" value="{{ $produto->preco }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductPriceVenda">Preço Venda (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPriceVenda"
                                name="preco_venda" value="{{ $produto->preco_venda }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductImage">Imagem <img
                                    src="{{ Storage::url($produto->imagem) }}"
                                    style="width: 108px; cursor:pointer"></label>
                            <input type="file" class="form-control" id="editProductImage" name="imagem"
                                accept="image/*">


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="editBtn">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
