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

create table invalidos(
id bigint auto_increment,
ddd int(2),
fone int(9),
telefone int(11)
primary key(id))engine=innodb charset=utf8;


