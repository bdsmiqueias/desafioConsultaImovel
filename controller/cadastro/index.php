<h1>Cidades</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
        <tr>
            <th>Nome</th>
            <th><a href="?controller=CidadeController&method=criar" class="btn btn-success btn-sm">Novo</a></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($Cidades) {
            foreach ($Cidades as $cidade) {
                ?>
                <tr>
                    <td><?php echo $cidade->nome.($cidade->uf ? ' - '.$cidade->uf : ''); ?></td>
                    <td><?php  ?></td>
                    <td>
                        <a href="?controller=ContatosController&method=editar&id=<?php echo $cidade->id; ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="?controller=ContatosController&method=excluir&id=<?php echo $cidade->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">Nenhum registro encontrado</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>