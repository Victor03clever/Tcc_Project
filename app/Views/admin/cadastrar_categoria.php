
   

    <main>
        <section class="container mt-5 mb-5">
            <h2 class="titulo-secao mb-4">Cadastrar categoria de produto</h2>
            <form action="<?=URL?>admin/categoria" method="POST">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="descricao">Nome*</label>
                        <input type="text" class="form-control" id="descricao" placeholder="Digite o nome da categoria...">
                        <div class="feedback-descricao"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="descricao">Descrição*</label>
                        <input type="text" class="form-control" id="descricao" placeholder="Digite a descrição da categoria...">
                        <div class="feedback-descricao"></div>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="status">Status*</label>
                        <select class="form-control" id="status">
                            <option value="true">Ativo</option>
                            <option value="false">Desativado</option>
                        </select>
                    </div>
                </div><br>
                <button type="submit" class="btn btn-success" id="btn-cadastrar-categoria">Salvar <i class="bi bi-plus-lg"></i></button>
            </form>
        </section>
    </main>
