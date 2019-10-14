<div class="ui container center aligned">
    <?php if(!$arrayBairroCidades){ ?>
        <h2>Nenhum resultado encontrado</h2>
    <?php }else{ ?>
        <h2>Resultado dos Bairros</h2>
        <div class="ui divider"></div>
        <?php foreach ($arrayBairroCidades as $arrayBairroCidade){ ?>
            <?php if(array_key_exists('bairros',$arrayBairroCidade)){ ?>
                <h3><?php echo $arrayBairroCidade['cidade']->nome; ?></h3>
                <table class="ui left aligned table">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="right aligned">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($arrayBairroCidade['bairros'] as $bairro){ ?>
                        <tr>
                            <td><?php echo $bairro->nome ?></td>
                            <td class="right aligned">
                                <a href="?controller=BairroController&method=editar&id=<?php echo $bairro->id; ?>"><i class="edit icon"></i></a>
                                <a href="?controller=BairroController&method=excluir&id=<?php echo $bairro->id; ?>"><i class="delete icon red"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <div class="ui two column doubling grid container middle aligned center aligned">
        <div class="column left aligned"><a class="ui button green" href="?controller=BairroController&method=criar">Novo</a></div>
        <div class="column right aligned"><a class="ui button primary" href="?controller=ConsultaImovelController&method=index">Voltar para a consulta</a></div>
    </div>
</div>