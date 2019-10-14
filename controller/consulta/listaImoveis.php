<div class="ui container center aligned">
        <?php if(!$arrayImoveis){ ?>
            <h2>Nenhum resultado encontrado</h2>
        <?php }else{ ?>
            <h2>Resultado dos Imóveis</h2>
            <hr>
            <div class="ui four cards">
                <?php foreach ($arrayImoveis as $imovel){ ?>
                    <div class="ui card">
                        <div class="image dimmable">
                            <?php if($imovel['FotoDestaquePequena']){ ?>
                                <img src="<?php echo $imovel['FotoDestaquePequena']; ?>">
                            <?php }else{ ?>
                                <img src="/image.png">
                            <?php }?>
                        </div>
                        <div class="content">
                            <div class="header"><?php echo $imovel['Categoria']; ?></div>
                            <div class="meta">
                                <a class="group"><?php echo $imovel['Cidade'].' - '.$imovel['Bairro']; ?></a>
                            </div>
                            <div class="description">
                                <p>
                                    <?php if($imovel['ValorVenda']){ ?>
                                        Venda: R$ <?php echo ($imovel['ValorVenda'] ? number_format($imovel['ValorVenda'],2,',','.') : ""); ?>
                                    <?php } ?>
                                </p>
                                <p>
                                    <?php if($imovel['ValorLocacao']){ ?>
                                        Locação: R$ <?php echo ($imovel['ValorLocacao'] ? number_format($imovel['ValorLocacao'],2,',','.') : ""); ?>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="ui divider"></div>
        <div>
            <div class="item right aligned"">
                <a href="?controller=ConsultaImovelController&method=index">Voltar para a consulta</a>
            </div>
        </div>
</div>