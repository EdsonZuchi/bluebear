create table users (
    id int not null auto_increment,
    ipv4 varchar(45) not null,
    primary key(id)
);

create table ceps (
    id int not null auto_increment, 
    cep int not null,
    logradouro varchar(255),
    complemento text,
    bairro varchar(60),
    localidade varchar(100),
    uf varchar(2),
    ibge int,
    primary key(id)
);

create table favorite_ceps (
    id int not null auto_increment,
    id_user int not null, 
    id_cep int not null,
    primary key(id),
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_cep) REFERENCES ceps(id)
);