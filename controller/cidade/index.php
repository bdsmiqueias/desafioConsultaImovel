<div class="ui container center aligned">
    <?php if(!$arrayCidades){ ?>
        <h2>Nenhum resultado encontrado</h2>
    <?php }else{ ?>
        <h2>Resultado das Cidades</h2>
        <hr>
        <table class="ui left aligned table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>UF</th>
                <th class="right aligned">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arrayCidades as $cidade){ ?>
                <tr>
                    <td><?php echo $cidade->nome ?></td>
                    <td><?php echo $cidade->uf ?></td>
                    <td class="right aligned">
                        <a href="?controller=CidadeController&method=editar&id=<?php echo $cidade->id; ?>"><i class="edit icon"></i></a>
                        <a href="?controller=CidadeController&method=excluir&id=<?php echo $cidade->id; ?>"><i class="delete icon red"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <div class="ui divider"></div>
    <div class="ui two column doubling grid container middle aligned center aligned">
        <div class="column left aligned"><a class="ui button green" href="?controller=CidadeController&method=criar">Novo</a></div>
        <div class="column right aligned"><a class="ui button primary" href="?controller=ConsultaImovelController&method=index">Voltar para a consulta</a></div>
    </div>
</div>
</div>