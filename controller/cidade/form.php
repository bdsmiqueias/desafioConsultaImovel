<div class="ui container center aligned">
    <h2>Cadastro Cidade</h2>
    <div class="ui divider"></div>
    <div class="ui attached segment">
        <form class="ui form" action="?controller=CidadeController&<?php echo isset($cidade->id) ? "method=atualizar&id={$cidade->id}" : "method=salvar"; ?>" method="post" >
            <div class="cidade">
                <div class="field">
                    <div class="fields">
                        <div class="twelve wide field">
                            <input type="text" name="nome" placeholder="Nome da Cidade" value="<?php echo isset($cidade->nome) ? $cidade->nome : null; ?>" required>
                        </div>
                        <div class="four wide field">
                            <input type="text" name="uf" placeholder="UF" value="<?php echo isset($cidade->uf) ? $cidade->uf : null; ?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="cidade_id" value="<?php echo isset($cidade->id) ? $cidade->id : null; ?>" />
                <div class="ui two column doubling grid container middle aligned center aligned">
                    <div class="column left aligned"><button class="ui button green" type="submit">Salvar</button></div>
                    <div class="column right aligned"><a class="ui button primary" href="?controller=CidadeController&method=listar">Voltar para a lista</a></div>
                </div>
            </div>
        </form>
    </div>
</div>