<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Adicionar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" method="post" action="{{ route('adicionar-produto') }}"
                        enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="productReference" name="referencia"
                                    required>
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
                                <input type="number" step="0.1" class="form-control" id="productHeelSize"
                                    name="tamanho_salto">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productPrice">Preço (R$)</label>
                                <input type="number" step="0.01" class="form-control" id="productPrice"
                                    name="preco" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="editProductPrice">Preço Venda (R$)</label>
                                <input type="number" step="0.01" class="form-control" id="editProductPrice"
                                    name="preco_venda">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productImage">Imagem</label>
                                <input type="file" class="form-control" id="productImage" name="imagem"
                                    accept="image/*" required>
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
