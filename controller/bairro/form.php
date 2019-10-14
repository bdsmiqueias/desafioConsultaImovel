<div class="ui container center aligned">
    <h2>Cadastro Bairro</h2>
    <div class="ui divider"></div>
    <?php if(!$arrayCidades){ ?>
        Nenhuma cidade para víncular - Vamos cadastrar?<br/> <a href="?controller=CidadeController&method=criar" class="ui">Ir para o cadastro de cidade</a></span>
    <?php }else{ ?>
    <div class="ui attached segment">
        <form class="ui form" action="?controller=BairroController&<?php echo isset($bairro->id) ? "method=atualizar&id={$bairro->id}" : "method=salvar"; ?>" method="post" >

                <div class="field">

                        <div class="inline fields">
                            <div class="ten wide field">
                                <label> Cidade</label>
                                <select id="cidadeSelect" name="id_cidade" value="<?php echo isset($bairro->id_cidade) ? $bairro->id_cidade : null; ?>" required>
                                    <option value=""></option>
                                    <?php foreach ($arrayCidades as $cidadeS){ ?>
                                        <option <?php echo isset($bairro->id_cidade) ? (($bairro->id_cidade == $cidadeS->id) ? 'selected' : '') : ''; ?> value="<?php echo $cidadeS->id ?>"><?php echo $cidadeS->nome.' - '.$cidadeS->uf ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <div class="inline fields">
                        <div class="ten wide field">
                            <label> Nome &nbsp;&nbsp;</label>
                            <input type="text" name="nome" placeholder="Nome do Bairro" value="<?php echo isset($bairro->nome) ? $bairro->nome : null; ?>" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="cidade_id" value="<?php echo isset($bairro->id) ? $bairro->id : null; ?>" />
                <div class="ui two column doubling grid container middle aligned center aligned">
                    <div class="column left aligned"><button class="ui button green" type="submit">Salvar</button></div>
                    <div class="column right aligned"><a class="ui button primary" href="?controller=BairroController&method=listar">Voltar para a lista</a></div>
                </div>
        </form>
    </div>
    <?php } ?>
</div>