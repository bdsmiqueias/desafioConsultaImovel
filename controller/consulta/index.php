<script type="text/javascript">
    $().ready(function () {

        $('#cidadeSelect').change(function(){
            if($(this).val()){
                $('.bairro').show();
                $('#bairroSelect').html('');
                $.ajax({
                    url: '/?controller=BairroController&method=ajaxAll&type=ajax',
                    type: 'POST',
                    async: true,
                    data: 'id_cidade=' + $(this).val(),
                    success: function (result) {
                        var bairros = result;
                        $('#bairroSelect').css('display','unset');
                        $.each(bairros, function (key, bairro) {
                            //console.log(item);
                            $('#bairroSelect').append('<option value="'+bairro.id+'">'+bairro.nome+'</option>');
                        });


                    }
                });
            }else{
                $('.bairro').hide();
            }
        });

        <?php if(!$arrayCidades){ ?>
            $("#menucidade").hide();
            $("#menubairro").hide();
        <?php } ?>

    })
</script>
<div class="ui container center aligned">
    <h2>Consulta de Imóveis</h2>
    <hr>
    <?php if(!$arrayCidades){ ?>
        <h3>OPS! Cidades e Bairros não encontrados</h3>
        <span>Ainda não possuímos Cidades e Bairros para fazermos nossa busca - Vamos cadastrar?<br/> <a href="?controller=CadastroController&method=criar" class="ui">Ir para o cadastro</a></span>
    <?php }else{ ?>
        <form class="ui form left aligned" action="?controller=ConsultaImovelController&method=buscaImovel" method="post">
            <div class=" inline field left aligned">
                <label>Selecione a Cidade</label>
                <select id="cidadeSelect" name="cidade[selected]">
                    <option value=""></option>
                    <?php foreach ($arrayCidades as $cidadeS){ ?>
                        <option value="<?php echo $cidadeS->id ?>"><?php echo $cidadeS->nome.' - '.$cidadeS->uf ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="bairro" hidden>
                <div class="ui divider"></div>

                <div class=" inline field left aligned">
                    <label>Selecione o Bairro</label>
                    <select id="bairroSelect" name="bairro[selected]" style="display: none"><select>
                </div>

                <div class="ui divider"></div>

                <div class=" inline field center aligned" style="width: 50%; margin: 0 auto;">
                    <button class="ui button primary" id="consultarImovel" type="submit">Consultar Imóveis</button>
                </div>
            </div>
        </form>

        <div>
            <div class="item right aligned"">
            <a href="?controller=CadastroController&method=criar">Cadastro rápido de Cidade e Bairro</a>
        </div>
    <?php } ?>


</div>