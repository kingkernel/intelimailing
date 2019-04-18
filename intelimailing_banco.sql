create database intelimailing character set=utf8;

use intelimailing;
create table persons (
id int auto_increment,
nameperson varchar(50),
keyword varchar(65),
active boolean default 1,
primary key(id))engine=innodb charset=utf8;

delimiter //
	create procedure sp_add_persons (arg_nameperson varchar(50), arg_keyword varchar(65))
		begin
			insert into persons (nameperson, keyword) values (arg_nameperson, arg_keyword);
		end //
delimiter ;

call sp_add_persons("root", sha1(md5(sha1("123"))));

delimiter //
	create procedure sp_login(arg_user varchar(50), arg_passwd varchar(65))
		begin
			select count(*) as existe from persons where nameperson=arg_user and keyword=arg_passwd and active=1;
		end//
delimiter ;

-- procedure autenticação
delimiter //
	create procedure sp_sel_user(arg_user varchar(50), arg_passwd varchar(65))
		begin
			select * from persons where nameperson=arg_user and keyword=arg_passwd and active=1;
		end//
delimiter ;


create table prob_category(
id int auto_increment,
prob varchar(50),
primary key(id))engine=innodb charset=utf8;

insert into prob_category (prob) values ("Outros"),("Impressora não imprime"), ("Atualizar o SGV"),
("Sem internet"), ("Computador Travando"), ("Computador lento"),
("Troca de Equipamento"), ("Headset mudo"), ("Mudar usuário de lugar");

delimiter //
	create procedure sp_sel_prob_category()
		begin
			select * from prob_category;
		end //
delimiter ;

create table teccalled (
id int auto_increment,
prob int,
estatus enum("Aberto", "Em Atendimento", "Encerrado"),
openfor int,
opencalled datetime default now(),
description text(500),
primary key(id),
foreign key(prob) references prob_category(id),
foreign key(openfor) references persons(id))engine=innodb charset=utf8;

delimiter //
	create procedure sp_add_teccalled(arg_prob int, arg_openfor int, 
		description text(500))
		begin
			insert into teccalled (prob, openfor, estatus, description)
				values (arg_prob, arg_openfor, "Aberto", description);
		end //
delimiter ;
-- 
delimiter //
	create procedure sp_sel_teccalled()
		begin
			SELECT teccalled.id,
       persons.nameperson,
       prob_category.prob,
       teccalled.estatus,
       teccalled.opencalled,
       teccalled.description
  FROM (teccalled teccalled
        INNER JOIN prob_category prob_category
           ON (teccalled.prob = prob_category.id))
       INNER JOIN persons persons ON (teccalled.openfor = persons.id)
 WHERE (teccalled.estatus != 'Encerrado');
		end //
delimiter ;

delimiter //
	create procedure sp_up_teccalled(arg_estatus varchar(35), arg_id int)
		begin
			update teccalled set estatus=arg_estatus where id=arg_id;
		end //
delimiter ;

-- ####################################################################
--		tabelas de telefones
-- ####################################################################
create table invalidos(
id bigint auto_increment,
ddd int(2),
fone int(9),
telefone int(11),
diahora datetime,
primary key(id),
unique(telefone))engine=innodb charset=utf8;

create table naoatende(
id int auto_increment,
ddd int(2),
fone int(9),
telefone int(11),
diahora datetime,
primary key(id),
unique(telefone))engine=innodb charset=utf8;

create table comparativo(
id int auto_increment,
documento bigint,
tp_pessoa varchar(15),
fone1_completo bigint,
ddd1 int(2),
fone1 bigint,
fone2_completo bigint,
ddd2 int,
fone2 bigint,
nome varchar(100),
nascimento datetime,
sexo varchar(10),
tp_logr varchar(15),
logradouro varchar(150),
numero varchar(15),
complemento varchar(150),
uf varchar(2),
estado varchar(50),
cidade varchar(50),
bairro varchar(50),
cep int,
primary key(id))engine=innodb charset=utf8;
