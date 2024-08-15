create database db_manager;

use db_manager;


-- // Parâmetro // --
create table CasPar (
	CasParCod character(65) not null,
	CasParDca datetime default now() not null,
	CasParDmd datetime default now() not null,
	CasParDsc character(65) not null,
	CasParBlq char(1) default 'N' not null,
	CasParSeq int null,
	CasParInt int null,
	CasParDec int null,
	CasParSep tinyint null,
	CasParVch varchar(4000) null,
	constraint PKCasPar primary key (CasParCod),
	index ICasPar01 (CasParBlq asc, CasParDsc asc)
)
;
-- // Programa // --
create table CasPrg (
	CasPrgCod character(65) not null,
	CasPrgDca datetime default now() not null,
	CasPrgDmd datetime default now() not null,
	CasPrgDsc character(65) not null,
	CasPrgBlq char(1) default 'N' not null,
	constraint PKCasPrg primary key (CasPrgCod),
	index ICasPrg01 (CasPrgBlq asc, CasPrgDsc asc)
)
;
-- // Módulo // --
create table CasMdl (
	CasMdlCod character(65) not null,
	CasMdlDca datetime default now() not null,
	CasMdlDmd datetime default now() not null,
	CasMdlDsc character(65) not null,
	CasMdlBlq char(1) default 'N' not null,
	constraint PKCasMdl primary key (CasMdlCod),
	index ICasMdl01 (CasMdlBlq asc, CasMdlDsc asc)
)
;
-- // Módulo & Programa // --
create table CasMpr (
	CasMdlCod character(65) not null,
	CasPrgCod character(65) not null,
	CasMprDca datetime default now() not null,
	CasMprDmd datetime default now() not null,
	constraint PKCasMpr primary key (CasMdlCod, CasPrgCod),
	constraint FKCasMpr01 foreign key (CasMdlCod) references CasMdl (CasMdlCod),
	constraint FKCasMpr02 foreign key (CasPrgCod) references CasPrg (CasPrgCod),
    index ICasMpr01 (CasMdlCod asc),
    index ICasMpr02 (CasPrgCod asc)
)
;
-- // Funcionalidade // --
create table CasFun (
	CasFunCod int not null,
	CasFunDca datetime default now() not null,
	CasFunDmd datetime default now() not null,
	CasFunDsc character(65) not null,
	CasFunBlq char(1) default 'N' not null,
	constraint PKCasFun primary key (CasFunCod),
	index ICasFun01 (CasFunBlq asc, CasFunDsc asc)
)
;
-- // Funcionalidade & Programa // --
create table CasFpr (
	CasFunCod int not null,
	CasPrgCod character(65) not null,
	CasFprDca datetime default now() not null,
	CasFprDmd datetime default now() not null,
	constraint PKCasFpr primary key (CasFunCod, CasPrgCod),
	constraint FKCasFpr01 foreign key (CasFunCod) references CasFun (CasFunCod),
	constraint FKCasFpr02 foreign key (CasPrgCod) references CasPrg (CasPrgCod),
    index ICasFpr01 (CasFunCod asc),
    index ICasFpr02 (CasPrgCod asc)
)
;
-- // Work Station // --
create table CasWks (
	CasWksCod int not null,
	CasWksDca datetime default now() not null,
	CasWksDmd datetime default now() not null,
	CasWksDsc character(65) not null,
	CasWksBlq char(1) default 'N' not null,
	CasWksMac character(17) default '00:00:00:00:00:00' not null,
	CasWksEip character(45) default '0.0.0.0' not null,
	CasWksChv character(255) default null,
	constraint PKCasWks primary key (CasWksCod),
	index ICasWks01 (CasWksBlq asc, CasWksDsc asc),
	index ICasWks02 (CasWksChv asc)
)
;
-- // Sessão Web // --
create table CasSwb (
	CasSwbCod character(65) not null,
	CasSwbDca datetime default now() not null,
	CasSwbDmd datetime default now() not null,
	CasSwbIdy character(255) not null,
	CasSwbBlq char(1) default 'N' not null,
	CasSwbWks varchar(65) null,
	CasSwbUsu varchar(65) null,
	CasSwbBrw varchar(65) null,
	CasSwbIni datetime null,
	CasSwbFin datetime null,
	CasSwbUsrCod int null,
	CasSwbWksCod int null,
	constraint PKCasSwb primary key (CasSwbCod),
	index ICasSwb01 (CasSwbDca asc),
    index ICasSwb02 (CasSwbIdy asc),
	index ICasSwb03 (CasSwbDca asc, CasSwbUsrCod asc),
	index ICasSwb04 (CasSwbDca asc, CasSwbWksCod asc)
)
;
-- // Sessão Web & Navegação // --
create table CasSwn (
	CasSwbCod character(65) not null,
	CasSwnCod int not null,
	CasSwnDca datetime default now() not null,
	CasSwnDmd datetime default now() not null,
	constraint PKCasSwn primary key (CasSwbCod, CasSwnCod),
	constraint FKCasSwn foreign key (CasSwbCod) references CasSwb (CasSwbCod),
	index ICasSwn01 (CasSwbCod asc, CasSwnCod desc),
    index ICasSwn02 (CasSwbCod asc)
)
;
-- // Sessão do Programa // --
create table CasSwp (
	CasSwbCod character(65) not null,
	CasPrgCod character(65) not null,
	CasSwpDca datetime default now() not null,
	CasSwpDmd datetime default now() not null,
	CasSwpVch varchar(4000) null,
	constraint PKCasSwp primary key (CasSwbCod, CasPrgCod),
	constraint FKCasSwp01 foreign key (CasSwbCod) references CasSwb (CasSwbCod),
	constraint FKCasSwp02 foreign key (CasPrgCod) references CasPrg (CasPrgCod),
    index ICasSwp01 (CasSwbCod asc),
    index ICasSwp02 (CasPrgCod asc)
)
;
-- // Usuário // --
create table CasUsr (
	CasUsrCod int not null,
	CasUsrDca datetime default now() not null,
	CasUsrDmd datetime default now() not null,
	CasUsrDsc character(65) not null,
	CasUsrBlq char(1) default 'N',
	CasUsrDmn character(255) not null,
	CasUsrLgn character(255) not null,
	CasUsrPwd character(255) not null,
    CasUsrChv character(255) null,
	constraint PKCasUsr primary key (CasUsrCod),
	index ICasUsr01 (CasUsrBlq asc, CasUsrDsc asc),
	index ICasUsr02 (CasUsrDmn asc, CasUsrLgn asc)
)
;
-- // Perfil de Acesso // --
create table CasPfi (
	CasPfiCod int not null,
	CasPfiDca datetime default now() not null,
	CasPfiDmd datetime default now() not null,
	CasPfiDsc character(65) not null,
	CasPfiBlq char(1) default 'N' not null,
	constraint PKCasPfi primary key (CasPfiCod),
	index ICasPfi01 (CasPfiBlq asc, CasPfiDsc asc)
)
;
-- // Perfil de Acesso do Usuário // --
create table CasPfu (
	CasPfiCod int not null,
	CasUsrCod int not null,
	CasPfuDca datetime default now() not null,
	CasPfuDmd datetime default now() not null,
	constraint PKCasPfu primary key (CasPfiCod, CasUsrCod),
	constraint FKCasPfu01 foreign key (CasPfiCod) references CasPfi (CasPfiCod),
	constraint FKCasPfu02 foreign key (CasUsrCod) references CasUsr (CasUsrCod),
    index ICasPfu01 (CasPfiCod),
    index ICasPfu02 (CasUsrCod)
)
;
-- // Autorização do Perfil de Acesso // --
create table CasApf (
	CasPfiCod int not null,
	CasUsrCod int not null,
	CasPrgCod character(65) not null,
	CasApfDca datetime default now() not null,
	CasApfDmd datetime default now() not null,
	constraint PKCasApf primary key (CasPfiCod, CasUsrCod, CasPrgCod),
	constraint FKCasApf01 foreign key (CasPfiCod, CasUsrCod) references CasPfu (CasPfiCod, CasUsrCod),
	constraint FKCasApf02 foreign key (CasPrgcod) references CasPrg (CasPrgCod),
    index ICasApf01 (CasPfiCod asc, CasUsrCod asc),
    index ICasApf02 (CasPrgcod asc)
)
;
-- // Autorização da Funcionalidade // --
create table CasAfu (
	CasPfiCod int not null,
	CasUsrCod int not null,
	CasPrgCod character(65) not null,
	CasFunCod int not null,
	CasAfuDca datetime default now() not null,
	CasAfuDmd datetime default now() not null,
	constraint PKCasAfu primary key (CasPfiCod, CasUsrCod, CasPrgCod, CasFunCod),
	constraint FKCasAfu01 foreign key (CasPfiCod, CasUsrCod, CasPrgCod) references CasApf (CasPfiCod, CasUsrCod, CasPrgCod),
	constraint FKCasAfu02 foreign key (CasFunCod, CasPrgCod) references CasFpr (CasFunCod, CasPrgCod),
    index ICasAfu01 (CasPfiCod asc, CasUsrCod asc, CasPrgCod asc),
    index ICasAfu02 (CasFunCod asc, CasPrgCod asc)
)
;
-- // Menu Raiz // --
create table CasMnu (
	CasMnuCod character(65) not null,
	CasMnuDca datetime default now() not null,
	CasMnuDmd datetime default now() not null,
	CasMnuDsc character(65) not null,
	CasMnuBlq char(1) default 'N' not null,
	CasMnuVch varchar(4000) null,
	CasMnuOrd int null,
	constraint PKCasMnu primary key (CasMnuCod),
	index ICasMnu01 (CasMnuBlq asc, CasMnuDsc asc),
	index ICasMnu02 (CasMnuCod asc, CasMnuOrd asc)
)
;
-- // Menu Árvore // --
create table CasMna (
	CasMnuCod character(65) not null,
	CasMnaCod int not null,
	CasMnaDca datetime default now() not null,
	CasMnaDmd datetime default now() not null,
	CasMnaDsc character(65) not null,
	CasMnaBlq char(1) default 'N' not null,
	CasMnaLnk varchar(999) null,
	CasMnaOrd int null,
	CasMnaGrp int null,
	constraint PKCasMna primary key (CasMnuCod, CasMnaCod),
	constraint FKCasMna01 foreign key (CasMnuCod) references CasMnu (CasMnuCod),
	index ICasMna01 (CasMnuCod asc, CasMnaCod desc),
	index ICasMna02 (CasMnuCod asc, CasMnaGrp asc, CasMnaOrd asc, CasMnaBlq asc, CasMnaDsc asc),
    index ICasMna03 (CasMnuCod asc)
)
;
-- // Identity  // --
create table CasIdy (
	CasIdyCod character(65) not null,
	CasIdyDca datetime default now() not null,
	CasIdyDmd datetime default now() not null,
	CasIdyDsc character(65) not null,
	CasIdyLck char(1) default 'N' not null,
	CasIdyTkn character(255) not null,
	CasIdyUpt datetime default now() not null,
	CasIdyExp datetime default now() not null,
    CasIdyAtz char(1) default 'N' not null,
	constraint PKCasIdy primary key (CasIdyCod),
	index ICasIdy01 (CasIdyLck asc, CasIdyDsc asc),
	index ICasIdy02 (CasIdyTkn asc)
)
;
-- // Convite // --
create table CasCvt (
	CasCvtCod character(65) not null,
	CasCvtDca datetime default now() not null,
	CasCvtDmd datetime default now() not null,
	CasCvtNme character(65) not null,
	CasCvtLgn character(255) not null,
    CasCvtPar varchar(4000) null,
    CasCvtLnk varchar(999) null,
	CasCvtBlq char(1) default 'N' not null,
	CasCvtBlqDtt datetime null,
	CasCvtEnv char(1) default 'N' not null,
	CasCvtEnvDtt datetime null,
	CasCvtCnf char(1) default 'N' not null,
	CasCvtCnfDtt datetime null,
	CasCvtChv character(255) not null,
	constraint PKCasCvt primary key (CasCvtCod),
	index ICasCvt01 (CasCvtBlq asc, CasCvtLgn asc),
	index ICasCvt02 (CasCvtChv asc)
)
;
-- // Fila Email // --
create table CasFem (
	CasFemCod int not null,
	CasFemDca datetime default now() not null,
	CasFemDmd datetime default now() not null,
	CasFemDsc character(65) not null,
	CasFemBlq char(1) default 'N' not null,
	CasFemGerFlg char(1) default 'N' not null,
	CasFemGerDtt datetime null,
	CasFemEnvFlg char(1) default 'N' not null,
	CasFemEnvDtt datetime null,
	CasFemPar varchar(4000) null,
	constraint PKCasFemCod primary key (CasFemCod),
	index ICasFem01 (CasFemBlq asc, CasFemDsc asc)
)
;
create table CasFemTo (
	CasFemCod int not null,
	CasFemToDca datetime default now() not null,
	CasFemToDmd datetime default now() not null,
	CasFemToMai character(255) not null,
	constraint PKCasFemTo primary key (CasFemCod, CasFemToMai),
	constraint FKCasFemTo01 foreign key (CasFemCod) references CasFem (CasFemCod)
)
;
create table CasFemCc (
	CasFemCod int not null,
	CasFemCcDca datetime default now() not null,
	CasFemCcDmd datetime default now() not null,
	CasFemCcMai character(255) not null,
	constraint PKCasFemCc primary key (CasFemCod, CasFemCcMai),
	constraint FKCasFemCc01 foreign key (CasFemCod) references CasFem (CasFemCod)
)
;
create table CasFemCco (
	CasFemCod int not null,
	CasFemCcoDca datetime default now() not null,
	CasFemCcoDmd datetime default now() not null,
	CasFemCcoMai character(255) not null,
	constraint PKCasFemCco primary key (CasFemCod, CasFemCcoMai),
	constraint FKCasFemCco01 foreign key (CasFemCod) references CasFem (CasFemCod)
)
;
create table CasFemAnx (
	CasFemCod int not null,
	CasFemAnxCod int not null,
	CasFemDcaAnx datetime default now() not null,
	CasFemDmdAnx datetime default now() not null,
	CasFemAnxDsc character(65) not null,
	CasFemAnxDir character(255) null,
	CasFemAnxNme character(255) null,
	CasFemAnxExt character(5) null,
	CasFemAnxSze character(20) null,
	constraint PKCasFemAnx primary key (CasFemCod, CasFemAnxCod),
	constraint FKCasFemAnx01 foreign key (CasFemCod) references CasFem (CasFemCod),
	index ICasFemAnx01 (CasFemAnxDsc asc)
)