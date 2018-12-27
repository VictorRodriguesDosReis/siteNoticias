create database if not exists db_site_noticia
default character set utf8
default collate utf8_general_ci;

use db_site_noticia;

create table tb_autor (
	cd_autor int(2) not null auto_increment,
    nm_autor varchar(35) not null,
    ds_email varchar(254) not null unique,
    ds_senha char(32) not null,
    constraint pk_autor
		primary key (cd_autor)
);

create table tb_noticia (
	cd_noticia int(5) not null auto_increment,
    ds_titulo varchar(100) not null,
    ds_subtitulo varchar(250),
    ds_noticia longtext not null,
    dt_criacao datetime not null,
    dt_alteracao timestamp,
    ic_ativo tinyint(1) not null default 1,
    cd_autor int(2) not null,
    constraint pk_noticia
		primary key (cd_noticia),
	constraint fk_noticia_autor
		foreign key (cd_autor)
			references tb_autor(cd_autor)
);

create table tb_comentario (
	cd_comentario mediumint(8) not null auto_increment,
    nm_leitor varchar(20) not null,
    ds_comentario varchar(255) not null,
    dt_criacao timestamp not null,
    ic_ativo tinyint(1) not null default 1,
    cd_noticia int(5) not null,
    constraint pk_comentario
		primary key (cd_comentario),
	constraint fk_comentario_noticia
		foreign key (cd_noticia)
			references tb_noticia(cd_noticia)
);



-- PROCEDURES
delimiter $$
-- INSERT
-- Insere um novo usuario(Autor) ao banco
create procedure p_I_Autor(nome varchar(35), email varchar(254), senha char(32))
begin
	insert into tb_autor(nm_autor, ds_email, ds_senha) 
		values (nome, email, senha);
	select last_insert_id() as codigo;
end $$

-- Insere uma nova noticia ao banco
create procedure p_I_Noticia(titulo varchar(100), subtitulo varchar(250), 
	noticia longtext, codigoUsuario int(2))
begin
	insert into tb_noticia (ds_titulo, ds_subtitulo, ds_noticia, dt_criacao, cd_autor) 
		values (titulo, subtitulo, noticia, now(), codigoUsuario);
end $$

-- Insere um novo comentário no banco
create procedure p_I_Comentario (nome varchar(20), comentario varchar(255), codigoNoticia mediumint(8))
begin
	insert into tb_comentario(nm_leitor, ds_comentario, cd_noticia)
		values (nome, comentario, codigoNoticia);
end $$

-- SELECT
-- Verifica se existe o usuario no banco
create procedure p_S_LoginAutor(email varchar(254), senha char(32))
begin
	select cd_autor as codigo, nm_autor as nome from tb_autor where ds_email = email and ds_senha = senha;
end $$

-- Retorna uma determinada quantidade de notícia iniciando pelo ponto desejado
create procedure p_S_NoticiaParcial(codigoInicio int(5), quantidade int(5))
begin
	select cd_noticia codigo, ds_titulo titulo, ds_subtitulo subtitulo, dt_alteracao data
		from tb_noticia 
			where cd_noticia >= codigoInicio order by dt_alteracao desc limit quantidade;
end $$

-- Retorna informações da notícia solicitada
create procedure p_S_NoticiaCompleta(codigo int(5))
begin            
	select ds_titulo titulo, ds_subtitulo subtitulo, ds_noticia noticia, 
		(select nm_autor from tb_autor a where a.cd_autor = n.cd_autor) autor, dt_criacao, dt_alteracao
		from tb_noticia n
			where cd_noticia = codigo;
end $$

-- Retorna os comentários da notícia solicitada
create procedure p_S_Comentarios(codigo int(5))
begin
	select nm_leitor leitor, ds_comentario comentario, dt_criacao
		from tb_comentario 
			where cd_noticia = codigo;
end $$

delimiter ;