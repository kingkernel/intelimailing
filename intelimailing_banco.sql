create database intelimailing character set=utf8;

use intelimailing;

create table invalidos(
id bigint auto_increment,
ddd int(2),
fone int(9),
telefone int(11)
primary key(id))engine=innodb charset=utf8;
