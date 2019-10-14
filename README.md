# Consulta de imóveis
------------------------------------------------------------------------------

## Banco de dados
Nome do base de dados "consultaimovel"
```sh
create table cidade (
	id int unsigned auto_increment,
	nome varchar(255) not null,
    uf varchar(10) not null,
    PRIMARY KEY (`id`),
	UNIQUE KEY `nome_uf` (`nome`,`uf`)
);
```

```sh
create table bairro (
	id int unsigned auto_increment,
	nome varchar(255) not null,
    id_cidade int unsigned not null,
    PRIMARY KEY (`id`),
	UNIQUE KEY `nome_cidade` (`nome`,`id_cidade`)
);
```

```sh
alter table bairro add constraint bairro_id_cidade_cidade_id foreign key (id_cidade) references cidade(id);
```




## Conexão

Configurar a conexão com a base de dados no arquivo em /config/Conexao.php

```sh
'mysql:host=localhost;port=3306;dbname=consultaimovel', 'user', ''
```



------------------------------------------------------------------------------
