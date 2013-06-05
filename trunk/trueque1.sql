/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     01/05/2013 01:46:53 p.m.                     */
/*==============================================================*/


drop table if exists SOLICITUD;
drop table if exists ARTICULO;
drop table if exists USUARIO;
drop table if exists UBICACION;
drop table if exists IMAGEN;


/*==============================================================*/
/* Table: ARTICULO                                              */
/*==============================================================*/
create table ARTICULO
(
   ID_ARTICULO          int not null AUTO_INCREMENT,
   ID_USUARIO           int,
   ID_UBICACION         int not null,
   ID_IMAGEN            int not null,
   NOMBRE_PRODUCTO      varchar(20),
   CATEGORIA            varchar(20),
   DESCRIPCION          varchar(200),
   FECHA_PUBLICACION    date,
   primary key (ID_ARTICULO)
);

/*==============================================================*/
/* Table: SOLICITUD                                             */
/*==============================================================*/
create table SOLICITUD
(
   ID_SOLICITUD         int not null AUTO_INCREMENT,
   ID_ARTICULO          int not null,
   ID_USUARIO           int,
   USU_ID_USUARIO       int,
   ART_ID_ARTICULO      int not null,
   MENSAJE              varchar(200),
   ESTADO               varchar(20),
   primary key (ID_SOLICITUD)
);

/*==============================================================*/
/* Table: UBICACION                                             */
/*==============================================================*/
create table UBICACION
(
   ID_UBICACION         int not null,
   CIUDAD               varchar(22),
   primary key (ID_UBICACION)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO
(
   ID_USUARIO           int not null AUTO_INCREMENT,
   ID_UBICACION         int ,
   NOMBRE_USUARIO       varchar(20),
   APELLIDO_USUARIO     varchar(20),
   FECHA_N              date,
   TELEFONO             int,
   PREGUNTA             varchar(100),
   RESPUESTA            varchar(100),
   CORREO               varchar(50),
   NICK                 varchar(20),
   PASS                 varchar(20),
   tipo                 varchar(20) default 'Usuario',
   primary key (ID_USUARIO)
);

/*==============================================================*/
/* Table: IMAGEN                                               */
/*==============================================================*/
create table IMAGEN
(
   ID_IMAGEN           	int not null AUTO_INCREMENT,
   RUTA_IMAGEN          varchar(100) NOT NULL,
   
   primary key (ID_IMAGEN)
);


alter table ARTICULO add constraint FK_RELATIONSHIP_4 foreign key (ID_UBICACION)
      references UBICACION (ID_UBICACION) on delete cascade on update cascade;

alter table ARTICULO add constraint FK_TIENE foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO) on delete cascade on update cascade;

alter table SOLICITUD add constraint FK_ENVIA foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO) on delete cascade on update cascade;

alter table SOLICITUD add constraint FK_RECIBE foreign key (USU_ID_USUARIO)
      references USUARIO (ID_USUARIO) on delete cascade on update cascade;

alter table SOLICITUD add constraint FK_TIENE_ARTICULO_OFRECIDO2 foreign key (ID_ARTICULO)
      references ARTICULO (ID_ARTICULO) on delete cascade on update cascade;

alter table SOLICITUD add constraint FK_TIENE_ARTICULO_SOLICITADO foreign key (ART_ID_ARTICULO)
      references ARTICULO (ID_ARTICULO) on delete cascade on update cascade;

alter table USUARIO add constraint FK_RELATIONSHIP_2 foreign key (ID_UBICACION)
      references UBICACION (ID_UBICACION) on delete cascade on update cascade;

alter table ARTICULO add constraint FK_RELATIONSHIP_5 foreign key (ID_IMAGEN)
      references IMAGEN (ID_IMAGEN) on delete cascade on update cascade;
	  
/*==============================================================*/
/*																*/
/*Insercion de datos											*/
/*																*/
/*==============================================================*/

/*===========================IMAGEN===========================*/

INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10001, 'assets/images/articulos/horno.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10002, 'assets/images/articulos/pcacer.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10003, 'assets/images/articulos/motowave.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10004, 'assets/images/articulos/motobws.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10005, 'assets/images/articulos/camasony.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10006, 'assets/images/articulos/relojiw.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10007, 'assets/images/articulos/tvsony.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10008, 'assets/images/articulos/galaxys3.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10009, 'assets/images/articulos/r9.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10010, 'assets/images/articulos/guayos.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10011, 'assets/images/articulos/xbox.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10012, 'assets/images/articulos/xbox1.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10013, 'assets/images/articulos/ps3.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10014, 'assets/images/articulos/tb7.jpg');
INSERT INTO `imagen`(`ID_IMAGEN`, `RUTA_IMAGEN`) VALUES (10015, 'assets/images/articulos/alg.jpg');


/*===========================UBICACION==========================*/
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (0,'Seleccione una ciudad');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (1,'Bogotá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (2,'Medellín');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (3,'Cali');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (4,'Barranquilla');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (5,'Cartagena');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (6,'Cúcuta');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (7,'Soledad');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (8,'Ibagué');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (9,'Bucaramanga');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (10,'Soacha');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (11,'Santa Marta');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (12,'Pereira');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (13,'Villavicencio');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (14,'Bello');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (15,'Valledupar');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (16,'Pasto');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (17,'Montería');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (18,'Manizales');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (19,'Buenaventura');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (20,'Neiva');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (21,'Palmira');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (22,'Armenia');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (23,'Popayán');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (24,'Sincelejo');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (25,'Floridablanca');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (26,'Itagüí');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (27,'Riohacha');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (28,'Envigado');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (29,'Tuluá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (30,'Dosquebradas');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (31,'Barrancabermeja');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (32,'Tumaco');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (33,'Tunja');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (34,'Girón');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (35,'Apartadó');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (36,'Florencia');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (37,'Uribia');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (38,'Maicao');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (39,'Turbo');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (40,'Piedecuesta');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (41,'Yopal');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (42,'Ipiales');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (43,'Cartago');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (44,'Fusagasugá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (45,'Facatativá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (46,'Magangué');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (47,'Pitalito');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (48,'Chía');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (49,'Zipaquirá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (50,'Malambo');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (51,'Santa Cruz de Lorica');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (52,'Rionegro');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (53,'Buga');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (54,'Quibdó');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (55,'Jamundí');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (56,'Sogamoso');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (57,'Duitama');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (58,'Yumbo');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (59,'Caucasia');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (60,'Girardot');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (61,'Ciénaga');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (62,'Ocaña');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (63,'Manaure');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (64,'Sabanalarga');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (65,'Tierralta');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (66,'Aguachica');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (67,'Santander de Quilichao');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (68,'Cereté');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (69,'Sahagún');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (70,'Arauca');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (71,'Villa del Rosario');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (72,'Garzón');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (73,'Candelaria');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (74,'Mosquera');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (75,'Montelíbano');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (76,'Calarcá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (77,'Espinal');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (78,'La Dorada');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (79,'Caldas');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (80,'Los Patios');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (81,'Madrid');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (82,'El Carmen de Bolívar');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (83,'Funza');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (84,'Chigorodó');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (85,'Santa Rosa de Cabal');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (86,'Turbaco');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (87,'San Andrés');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (88,'Arjona');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (89,'Copacabana');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (90,'Planeta Rica');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (91,'Acacías');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (92,'San Vicente del Caguán');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (93,'Chiquinquirá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (94,'San José del Guaviare');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (95,'Ciénaga de Oro');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (96,'Corozal');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (97,'La Plata');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (98,'La Estrella');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (99,'Riosucio');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (100,'Granada');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (101,'Zona Bananera');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (102,'Necoclí');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (103,'Puerto Asís');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (104,'Florida');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (105,'Fundación');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (106,'El Cerrito');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (107,'Baranoa');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (108,'Pamplona');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (109,'Plato');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (110,'San Marcos');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (111,'El Banco');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (112,'Cajicá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (113,'Puerto Boyacá');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (114,'Villamaría');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (115,'Pradera');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (116,'Carepa');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (117,'Chinchiná');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (118,'Girardota');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (119,'Marinilla');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (120,'Tame');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (121,'Agustín Codazzi');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (122,'La Ceja');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (123,'Valle del Guamuez');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (124,'Sabaneta');
INSERT INTO `ubicacion`(`ID_UBICACION`, `CIUDAD`) VALUES (125,'Orito');


/*===========================USUARIOS===========================*/

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1101,23,'DAVID','QUINTANA','1988-12-12',3124569876,'NOMBRE DE MI MADRE','BLANCA','davidq@unicauca.edu.co','quintana123','davidquintana');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1102,45,'EDWAR','GIRALDO','1987-10-10',302409,'NOMBRE PERRO','BRUNO','edwargiraldo@unicauca.edu.co','alejo491','bruno');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1103,98,'LUIS','JIMENEZ','1978-05-12',321234324,'NOMBRE NOVIA','ISIS','lfjimenez@unicauca.edu.co','lfjimenez','jklssaas');

INSERT INTO `usuario`
(`ID_USUARIO`,`tipo`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1104,'admin',21,'PAOLA','GIRON','1967-10-01',3123324324,'NOMBRE PERRA','DONA','paogiron@unicauca.edu.co','paolagiron','dona');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1105,23,'JUAN','PINTO','1991-10-04',3153243234,'NOMBRE MADRE','EDITH','jdpinto@unicauca.edu.co','jdpinto','jdpinto');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1106,56,'FELIPE','ESCRIBANO','1988-11-11',3121232313,'ANIMAL FAVORITO','PANDA','fescribano@unicauca.edu.co','pandita123','ojeras');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1107,78,'ROBINSON','RAMOS','1990-09-01',3189998888,'NOMBRE DEPORTE','FUTBOL','rramos@unicauca.edu.co','miau','qwqsdaf');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1108,21,'CARLOS','BALDIVIESO','1979-08-09',3125677657,'COLOR FAVORITO','ROJO','cbaldivieso@unicauca.edu.co','baldi','dfdsafdf');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1109,90,'ANDRES','VASQUEZ','1990-10-12',3123213212,'ANIMAL FAVORITO','GALLO','afvasquez@unicauca.edu.co','afvasquez','dsfasdsadddfds');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1110,45,'ISIS','PISO','1991-02-12',3123254534,'ANIMAL FAVORITO','TORTUGA','ipiso@unicauca.edu.co','isis12321','asddssasd');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1111,65,'WALTER','ANTE','1990-07-10',3145546789,'MUSICA FAVORITA','MUSICA DE TOMAR','wante@unicauca.edu.co','fierroduro','343243');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1112,11,'FERNAANDO','BRAVO','1985-02-04',3123222222,'PROGRAMA FAVORITO','DRACULA','fbravo@unicauca.edu.co','fbravo','dsalklkl');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1113,18,'ANGELA','GUERRERO','1992-09-08',3187778888,'MATERIA FAVORITA','OPERATIVOS','aguerrero@unicauca.edu.co','aguerrero','dsfds8989');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1114,45,'HAROLD','SILVA','1896-01-10',3158889992,'PASATIEMPO','SER UN VIVIDOR','hsilva@unicauca.edu.co','hsilva567','ds989sdfjjc');

INSERT INTO `usuario`
(`ID_USUARIO`,`ID_UBICACION`,`NOMBRE_USUARIO`,`APELLIDO_USUARIO`,`FECHA_N`,`TELEFONO`,`PREGUNTA`,`RESPUESTA`,`CORREO`,`NICK`,`PASS`)
VALUES (1115,98,'FRANSICO','REYES','1987-10-11',3124543321,'DONDE ESTUDIO','SENA','fereyes@unicauca.edu.co','pachito','pachito456');

/*===========================ARTICULO===========================*/

INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0101,1101,10001,1, 'HORNO MICROONDAS', 'ELECTRODOMESTICOS', 'EN MUY BUEN ESTADO','2010/01/01');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0102,1102,10002,2, 'PC PORTATIL ACER ASPIRE 4339-2619', 'TECNOLOGIA', '3 MESES DE USO','2005/02/28');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0103,1103,10003,4, 'MOTO HONDA WAVE C-100 MD-2010', 'VEHICULOS', 'UNICO DUEÑO','2000/10/10');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0104,1104,10004,6, 'MOTO YAMAHA BWS MD-2008', 'VEHICULOS', 'RECIEN REPARADA DE MOTOR','2010/02/02');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0105,1105,10005,8, 'CAMARA SONY ALPHA NEX-5 ', 'TECNOLOGIA', 'FORRO ORIGINAL','2011/01/01');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0106,1106,10006,10, 'RELOJ ICE WATCH', 'ACCESORIOS', 'SOLO CAMBIO POR OTRO RELOJ','2010/02/02');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0107,1107,10007,12, 'TV SONY BRAVIA LCD 32 ', 'ELECTRODOMESTICOS', '1 MES DE USO',sysdate());
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0108,1108,10008,14, 'CELULAR GALAXY S3', 'TECNOLOGIA', 'COMO NUEVO',sysdate());
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0109,1109,10009,16, 'CARRO R9 MD-1995', 'VEHICULOS', 'SEGURO AL DIA',sysdate());
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0110,1110,10010,18, 'GUAYOS ADIDAS PREDATOR', 'ACCESORIOS', 'ALTA GAMA',sysdate());
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0111,1111,10011,20, 'X-BOX 360', 'TECNOLOGIA', 'EN MUY BUEN ESTADO','2002/02/02');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0112,1112,10012,22, 'X-BOX 360', 'TECNOLOGIA', 'EN MUY BUEN ESTADO','2010/02/10');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0113,1113,10013,24, 'PLAY STATION 3', 'TECNOLOGIA', 'EN MUY BUEN ESTADO','2013/02/02');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0114,1114,10014,26, 'TABLET7 CAPACITIVA ANDROID 4 ', 'TECNOLOGIA', 'PERFECTO ESTADO','2012/02/02');
INSERT INTO `articulo`(`ID_ARTICULO`, `ID_USUARIO`,`ID_IMAGEN`, `ID_UBICACION`, `NOMBRE_PRODUCTO`, `CATEGORIA`, `DESCRIPCION`,`FECHA_PUBLICACION`) VALUES (0115,1115,10015,28, 'ALGEBRA DE BALDOR', 'LIBROS', 'COMO NUEVO',sysdate());


/*===========================SOLICITUD===========================*/

INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9001, 0101, 1101, 1115, 0115 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9002, 0102, 1102, 1114, 0114 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9003, 0103, 1103, 1113, 0113 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9004, 0104, 1104, 1112, 0112 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9005, 0105, 1105, 1111, 0111 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9006, 0106, 1106, 1110, 0110 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9007, 0107, 1107, 1109, 0109 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9008, 0108, 1108, 1108, 0108 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9009, 0109, 1109, 1107, 0107 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9010, 0110, 1110, 1106, 0106 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9011, 0111, 1111, 1105, 0105 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9012, 0112, 1112, 1104, 0104 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9013, 0113, 1113, 1103, 0103 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9014, 0114, 1114, 1102, 0102 ,'deseo intercambiar el articulo');
INSERT INTO `solicitud`(`ID_SOLICITUD`, `ID_ARTICULO`, `ID_USUARIO`, `USU_ID_USUARIO`, `ART_ID_ARTICULO`, `MENSAJE`) VALUES (9015, 0115, 1115, 1101, 0101 ,'deseo intercambiar el articulo');

