<script type="text/javascript">
    $().ready(function(){
        $('#cidadeProximo').click(function(){
            if(($('input[name="cidade[nome]"]').val()) || ($('#cidadeSelect option:selected').val())){
                $('.step').removeClass('active');
                $('.bairroStep').addClass('active');
                $('.cidade').hide();
                $('.bairro').show();
            }else{
                alert('Nome da cidade é obrigatório!')
            }
        });

        $('#bairroVoltar').click(function(){
            $('.step').removeClass('active');
            $('.cidadeStep').addClass('active');
            $('.cidade').show();
            $('.bairro').hide();
        });
    })
</script>
<div class="ui container center aligned">
    <h2>Cadastro</h2>
    <div class="ui divider"></div>
    <div class="ui steps">
        <div class="cidadeStep active step">
            <div class="content">
                <div class="title">Cadastro de Cidade</div>
                <div class="description">Cadastre ou selecione uma cidade</div>
            </div>
        </div>
        <div class="bairroStep step">
            <div class="content">
                <div class="title">Cadastro de Bairro</div>
                <div class="description">Cadastre um novo bairro</div>
            </div>
        </div>
    </div>
    <div class="ui attached segment">
        <form class="ui form" action="?controller=CadastroController&<?php echo isset($bairros->id) ? "method=atualizar&id={$bairros->id}" : "method=salvar"; ?>" method="post" >
            <div class="cidade">
                <div class="field">
                    <?php if($arrayCidades){ ?>
                        <label>Selecione uma Cidade - UF</label>
                        <div class="fields">
                            <div class="field">
                                <select id="cidadeSelect" name="cidade[selected]">
                                    <option value=""></option>
                                    <?php foreach ($arrayCidades as $cidadeS){ ?>
                                        <option value="<?php echo $cidadeS->id ?>"><?php echo $cidadeS->nome.' - '.$cidadeS->uf ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="ui horizontal divider">
                            Ou
                        </div>
                    <?php } ?>
                    <label>Cadastre uma Cidade - UF</label>
                    <div class="fields">
                        <div class="twelve wide field">
                            <input type="text" name="cidade[nome]" placeholder="Nome da Cidade" value="<?php echo isset($cidade->nome) ? $cidade->nome : null; ?>">
                        </div>
                        <div class="four wide field">
                            <input type="text" name="cidade[uf]" placeholder="UF" value="<?php echo isset($cidade->uf) ? $cidade->uf : null; ?>">
                        </div>
                    </div>
                </div>
                <div>
                    <a id="cidadeProximo" class="ui button primary">Próximo</a>
                </div>
                <input type="hidden" name="cidade[id]" id="cidade_id" value="<?php echo isset($cidade->id) ? $cidade->id : null; ?>" />
            </div>
            <div class="bairro" hidden>
                <div class="field">
                    <label>Bairro</label>
                    <div class="fields">
                        <div class="sixteen wide field">
                            <input type="text" name="bairro[nome]" placeholder="Nome do Bairro" required value="<?php echo isset($bairro->nome) ? $bairro->nome : null; ?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="bairro[id]" id="bairro_id" value="<?php echo isset($bairro->id) ? $bairro->id : null; ?>" />
                <div>
                    <a id="bairroVoltar" class="ui button primary">Voltar</a>
                    <button id="bairroSalvar" class="ui button submit green" type="submit">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>