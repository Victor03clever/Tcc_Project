


    <main>
        <section class="container mt-5 mb-5">
            <h2 class="titulo-secao mb-4">Cadastrar categoria de produto</h2>
            <form action="<?=URL?>admin/categoria/cadastrar" method="POST">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="nome">Nome*</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da categoria...">
                        <div class="feedback-descricao"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="descricao">Descrição*</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição da categoria...">
                        <div class="feedback-descricao"></div>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="status">Status*</label>
                        <select class="form-control" id="status" name="staus">
                            <option value="1">Ativo</option>
                            <option value="0">Desativado</option>
                        </select>
                    </div>
                </div><br>
                <button type="submit" class="btn btn-success" name="btn_save" value="salvar">Salvar</button>
            </form>
        </section>
    </main>
