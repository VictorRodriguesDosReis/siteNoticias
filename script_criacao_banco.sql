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

create table tb_imagem (
	cd_imagem mediumint(8) not null auto_increment,
    cd_noticia int(5) not null,
    ds_caminho varchar(100) not null,
    constraint pk_imagem
		primary key (cd_imagem),
	constraint fk_imagem_noticia
		foreign key (cd_noticia)
			references tb_noticia(cd_noticia)
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

create table tb_visualizacao_dia (
	cd_noticia int(5) not null,
    qt_visualizacao int(5) not null default 1,
    constraint fk_dia_noticia
		foreign key (cd_noticia)
			references tb_noticia(cd_noticia)
);

create table tb_visualizacao_semana (
	cd_noticia int(5) not null,
    qt_visualizacao int(5) not null default 1,
    constraint fk_semana_noticia
		foreign key (cd_noticia)
			references tb_noticia(cd_noticia)
);

create table tb_visualizacao_mes (
	cd_noticia int(5) not null,
    qt_visualizacao int(5) not null default 1,
    constraint fk_mes_noticia
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
	noticia longtext, caminhoImagem varchar(100), codigoUsuario int(2))
begin
	insert into tb_noticia (ds_titulo, ds_subtitulo, ds_noticia, dt_criacao, cd_autor) 
		values (titulo, subtitulo, noticia, now(), codigoUsuario);
	
    -- Verifica se tem imagem de capa para a notícia
    if caminhoImagem <> '' then
		set @codigoNoticia = last_insert_id();

		insert into tb_imagem(ds_caminho, cd_noticia) 
			values (caminhoImagem, @codigoNoticia);
            
	end if;

	select @codigoNoticia as codigo;
end $$

-- Insere um novo comentário no banco
create procedure p_I_Comentario (nome varchar(20), comentario varchar(255), codigoNoticia mediumint(8))
begin
	insert into tb_comentario(nm_leitor, ds_comentario, cd_noticia)
		values (nome, comentario, codigoNoticia);
        
	select nm_leitor nomeLeitor, dt_criacao dataCriacao, ds_comentario comentario
		from tb_comentario
			where cd_comentario = last_insert_id();
end $$


-- UPDATE
-- Atualiza a quantidade de visitas feita a notícia
create procedure p_U_Visualizacao(codigo int(5))
begin
	-- Verifica se já existe alguma linha da notícia nas tabelas de visualização
	set @existeDia = (select count(*) from tb_visualizacao_dia where cd_noticia = codigo);
    set @existeSemana = (select count(*) from tb_visualizacao_semana where cd_noticia = codigo);
    set @existeMes = (select count(*) from tb_visualizacao_mes where cd_noticia = codigo);
    
    -- Se não existe nenhuma linha ele criará uma com a quantidade de visualizações em 1
    -- Porém caso já exista apenas será atualizado a quantidade de visualizações acrescentando mais 1
    -- Será feito isso para as tabelas de visualização de dia, semana e mês
    if @existeDia = 0 then
		insert into tb_visualizacao_dia(cd_noticia) values (codigo);
    else
		update tb_visualizacao_dia 
			set qt_visualizacao = qt_visualizacao + 1
				where cd_noticia = codigo;
    end if;
    
    if @existeSemana = 0 then
		insert into tb_visualizacao_semana(cd_noticia) values (codigo);
    else
		update tb_visualizacao_semana 
			set qt_visualizacao = qt_visualizacao + 1
				where cd_noticia = codigo;
    end if;
    
	if @existeMes = 0 then
		insert into tb_visualizacao_mes(cd_noticia) values (codigo);
    else
		update tb_visualizacao_mes 
			set qt_visualizacao = qt_visualizacao + 1
				where cd_noticia = codigo;
    end if;
    
end $$

-- Atualiza as informações da notícia
create procedure p_U_Noticia(titulo varchar(100), subtitulo varchar(250), 
	noticia longtext, caminhoImagem varchar(100), codigoUsuario int(2), codigoNoticia int(5))
begin
	update tb_noticia 
		set ds_titulo = titulo, ds_subtitulo = subtitulo,
			ds_noticia = noticia
				where cd_autor = codigoUsuario and cd_noticia = codigoNoticia;
                
	-- Verifica se tem uma nova imagem de capa para a notícia
    if caminhoImagem <> '' then
		set@temImagemCapa = (select count(*) from tb_imagem where cd_noticia = codigoNoticia);
        
        -- Verifica se já existe imagem de capa
		if (@temImagemCapa = 0) then
			insert into tb_imagem(cd_noticia, ds_caminho)
				values(codigoNoticia, caminhoImagem);
		
        else
			update tb_imagem 
				set ds_caminho = caminhoImagem, cd_noticia = codigoNoticia
					where cd_noticia = codigoNoticia;
                
		end if;
            
	end if;
                
	select ds_titulo titulo, ds_subtitulo subtitulo, dt_alteracao dataEdicao
		from tb_noticia 
			where cd_autor = codigoUsuario and cd_noticia = codigoNoticia;
    
end $$	

-- Desativa a noticia impossibilitando de ser apresentada no site
create procedure p_U_DesativaNoticia(codigoUsuario int(2), codigoNoticia int(5))
begin
	update tb_noticia set ic_ativo = 0
		where cd_autor = codigoUsuario and cd_noticia = codigoNoticia;
end $$


-- SELECT
-- Verifica se existe o usuario no banco
create procedure p_S_LoginAutor(email varchar(254), senha char(32))
begin
	select cd_autor as codigo, nm_autor as nome from tb_autor where ds_email = email and ds_senha = senha;
end $$

-- Retorna uma determinada quantidade de notícia iniciando pelo ponto desejado
create procedure p_S_NoticiaParcialFiltrado(codigoInicio int(5), quantidade int(5))
begin
	select cd_noticia codigo, ds_titulo titulo, ds_subtitulo subtitulo, dt_alteracao data
		from tb_noticia 
			where cd_noticia < codigoInicio and ic_ativo = 1
				order by dt_alteracao desc limit quantidade;
end $$

-- Retorna a quantidade solicitada de notícias mais recentes
create procedure p_S_NoticiaParcial(quantidade int(5))
begin
	select cd_noticia codigo, ds_titulo titulo, ds_subtitulo subtitulo, dt_alteracao data
		from tb_noticia 
			where ic_ativo = 1
				order by dt_alteracao desc limit quantidade;
end $$

-- Retorna a quantidade solicitada de notícias mais recentes do autor
create procedure p_S_NoticiaParcialAutor(quantidade int(5), codigo int(2))
begin
	select cd_noticia codigo, ds_titulo titulo, ds_subtitulo subtitulo, dt_alteracao data
		from tb_noticia
			where cd_autor = codigo and ic_ativo = 1
				order by dt_alteracao desc limit quantidade;
end $$

-- Retorna uma determinada quantidade de notícia do autor, iniciando pelo ponto desejado
create procedure p_S_NoticiaParcialFiltradoAutor(codigoInicio int(5), quantidade int(5), codigo int(2))
begin
	select cd_noticia codigo, ds_titulo titulo, ds_subtitulo subtitulo, dt_alteracao data
		from tb_noticia 
			where cd_noticia < codigoInicio and cd_autor = codigo and ic_ativo = 1
				order by dt_alteracao desc limit quantidade;
end $$

-- Retorna informações da notícia solicitada
create procedure p_S_NoticiaCompleta(codigo int(5))
begin            
	select ds_titulo titulo, ds_subtitulo subtitulo, ds_noticia noticia, 
		(select nm_autor from tb_autor a where a.cd_autor = n.cd_autor) autor, dt_criacao, dt_alteracao
		from tb_noticia n
			where cd_noticia = codigo and ic_ativo = 1;
end $$

-- Retorna informações da notícia solicitada pelo autor
create procedure p_S_NoticiaCompletaAutor(codigoNoticia int(5), codigoAutor int(2))
begin
	select n.cd_noticia codigo, n.ds_titulo titulo, n.ds_subtitulo subtitulo, n.ds_noticia noticia, i.ds_caminho imagemCapa
		from tb_noticia n inner join tb_imagem i 
			on n.cd_noticia = i.cd_noticia
				where n.cd_autor = codigoAutor and n.cd_noticia = codigoNoticia and ic_ativo = 1;
end $$

-- Retorna os comentários da notícia solicitada
create procedure p_S_Comentarios(codigo int(5))
begin
	select nm_leitor leitor, ds_comentario comentario, dt_criacao
		from tb_comentario 
			where cd_noticia = codigo and ic_ativo = 1
				order by cd_comentario desc;
end $$

-- Seleciona as 5 notícias mais visualizadas do dia
create procedure p_S_PrincipaisNoticiasDia(quantidade tinyint(1))
begin
	select n.ds_titulo titulo, n.ds_subtitulo subtitulo, n.cd_noticia codigo
		from tb_visualizacao_dia vd
			inner join tb_noticia n on vd.cd_noticia = n.cd_noticia
				where ic_ativo = 1
					order by vd.qt_visualizacao desc limit quantidade; 
end $$

-- Seleciona as 5 notícias mais visualizadas da semana
create procedure p_S_PrincipaisNoticiasSemana(quantidade tinyint(1))
begin
	select n.ds_titulo titulo, n.ds_subtitulo subtitulo, n.cd_noticia codigo
		from tb_visualizacao_semana vs
			inner join tb_noticia n on vs.cd_noticia = n.cd_noticia
				where ic_ativo = 1
					order by vs.qt_visualizacao desc limit quantidade; 
end $$

-- Seleciona as 5 notícias mais visualizadas do mês
create procedure p_S_PrincipaisNoticiasMes(quantidade tinyint(1))
begin
	select n.ds_titulo titulo, n.ds_subtitulo subtitulo, n.cd_noticia codigo
		from tb_visualizacao_mes vm
			inner join tb_noticia n on vm.cd_noticia = n.cd_noticia
				where ic_ativo = 1
					order by vm.qt_visualizacao desc limit quantidade; 
end $$

-- Seleciona uma quantidade determinada de principais notícias da semana com imagem
create procedure p_S_PrincipaisComImagem(quantidade tinyint(1))
begin
	select n.cd_noticia codigo, n.ds_titulo titulo, n.ds_subtitulo subtitulo, i.ds_caminho imagem
	from tb_noticia n, tb_imagem i, tb_visualizacao_semana vs
		where n.cd_noticia = vs.cd_noticia and
			  n.cd_noticia = i.cd_noticia and 
              n.ic_ativo = 1
				group by vs.cd_noticia
                order by vs.qt_visualizacao desc
                limit quantidade;
end $$

-- Seleciona um quantidade determinada das notícias recentes
create procedure p_S_NoticiaRecenteComImagem(quantidade tinyint(1))
begin
	select n.cd_noticia codigo, n.ds_titulo titulo, i.ds_caminho imagem
		from tb_noticia n, tb_imagem i
			where n.cd_noticia = i.cd_noticia and
				  n.ic_ativo = 1
					group by n.cd_noticia
					order by n.cd_noticia desc
					limit quantidade;
end $$

delimiter ;



-- EVENTOS
-- Habilita a criação de evento
SET @@global.event_scheduler = 1;

-- Todo inicio de dia o evento limpa a tb_visualizacao_dia 
create event e_limpar_visualizacao_dia
	on schedule every 1 day
		starts current_date
		do
			truncate db_site_noticia.tb_visualizacao_dia;

-- A cada uma semana (contando do dia da criacao deste evento) ele limpa a tb_visualizacao_semana 
create event e_limpar_visualizacao_semana
	on schedule every 1 week
		starts current_date
		do
			truncate db_site_noticia.tb_visualizacao_semana;
            
-- A cada um mês (contando do dia da criacao deste evento) ele limpa a tb_visualizacao_mes 
create event e_limpar_visualizacao_mes
	on schedule every 1 month
		starts current_date
		do
			truncate db_site_noticia.tb_visualizacao_mes;