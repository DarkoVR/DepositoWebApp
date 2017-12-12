/*Crear base de datos*/
create database deposito;
use database deposito;
/*Crear tablas de la base de datos*/
create table unidad_medida(id_unidad_medida int primary key auto_increment, unidad_medida varchar(100));
create table categoria(id_categoria int primary key auto_increment,categoria varchar(100));
create table proveedor(id_proveedor int primary key auto_increment,proveedor varchar(100),logo varchar(100));
create table marca(id_marca int primary key auto_increment,marca varchar(100),id_proveedor int,id_categoria int, 
	foreign key (id_categoria) references categoria(id_categoria),foreign key (id_proveedor) references proveedor(id_proveedor));
create table producto(id_producto int primary key auto_increment, producto varchar(100),id_marca int, 
	foreign key (id_marca) references marca(id_marca));
create table presentacion(id_producto int , sku varchar(13),presentacion varchar(100),preciou numeric(10,2),
	cantidadm numeric(10,2),preciom numeric(10,2),imagen varchar(100),id_unidad_medida int, 
	foreign key (id_unidad_medida) references unidad_medida(id_unidad_medida),foreign key (id_producto) references producto(id_producto),
	primary key (id_producto,sku));
create table rol(id_rol int primary key auto_increment,rol varchar(100));
create table usuario(id_usuario int primary key auto_increment,email varchar(100),password varchar(32));
create table usuario_rol(id_rol int,id_usuario int,
	foreign key (id_rol) references rol(id_rol),foreign key (id_usuario) references usuario(id_usuario));
create table cliente(id_cliente int primary key auto_increment, nombre varchar(100),apaterno varchar(100),amaterno varchar(100),
	domicilio varchar(100),id_usuario int,foto varchar(100), foreign key (id_usuario) references usuario(id_usuario));
create table empleado(id_empleado int primary key auto_increment,nombre varchar(100),apaterno varchar(100),amaterno varchar(100),
	id_usuario int,foreign key (id_usuario) references usuario(id_usuario));
create table venta(id_venta int primary key auto_increment,id_cliente int,id_empleado int,
	foreign key (id_cliente) references cliente(id_cliente),foreign key (id_empleado) references empleado(id_empleado));
create table detalle_venta(id_venta int,sku varchar(13),cantidad int);
create table promocion(id_promocion int primary key auto_increment, fechai date, fechaf date);
create table promocion_producto(id_promocion int,sku varchar(13),descuento int,
	foreign key (id_promocion) references promocion(id_promocion),foreign key (sku) references presentacion(sku));
create table comentario(id_comentario int primary key auto_increment,nombre varchar(100),id_cliente int,email varchar(100),
	tipo_comentario varchar(100),comentario varchar(100),fecha date,foreign key (id_cliente) references cliente(id_cliente));
/*Crear inserciones de la base de datos*/
insert into unidad_medida(id_unidad_medida,unidad_medida) values (1,'Pieza'),
																 (2,'Caja'),
																 (3,'Litro'),
																 (4,'Mililitros'),
																 (5,'Gramos'),
																 (6,'Kilos');
insert into categoria(id_categoria,categoria) values (1,'Refresco'),
													 (2,'Jugo'),
													 (3,'Cerveza'),
													 (4,'Agua'),
													 (5,'Comestibles');		
insert into proveedor(id_proveedor,proveedor,logo) values (1,'Coca-Cola','coca.jpg'),
														  (2,'Pepsico','pepsico.jpg'),
														  (3,'Sabritas','sabritas.jpg'),
														  (4,'Corona','corona.jpg'),
														  (5,'Bonafont','bonafont.jpg');	
insert into marca(id_marca,marca,id_proveedor,id_categoria) values (1,'CocaCola',1,1),
																   (2,'Pepsi',2,1),
																   (3,'Sabritas',3,5),
																   (4,'DelValle',1,2),
																   (5,'Corona',4,3),
																   (6,'Bonafont',5,4);
insert into producto(id_producto,producto,id_marca) values (1,'CocaCola',1),
														   (2,'Fresca',1),
														   (3,'Manzana Lift',1),
														   (4,'Sprite',1),
														   (5,'Pepsi',2),
														   (6,'Mirinda',2),
														   (7,'Seven Up',2),
														   (8,'Manzanita Sol',2),
														   (9,'Cheetos',3),
														   (10,'Doritos',3),
														   (11,'DelValle',4),
														   (12,'Valle Frut',4),
														   (13,'Victoria',5),
														   (14,'Modelo',5),
														   (15,'Bonafont',6);														  
insert into presentacion(id_producto,sku,presentacion,id_unidad_medida,preciou,cantidadm,preciom) values (1,'BEBE000000000',400,4,'8','12','7'),
																											(1,'BEBE000000001',600,4,'12','12','9'),
																											(1,'BEBE000000002',1,3,'19','12','18'),
																											(2,'BEBE000000003',400,4,'7','12','5'),
																											(2,'BEBE000000004',600,4,'10','12','9'),
																											(2,'BEBE000000005',1,3,'15','12','12'),
																											(3,'BEBE000000006',400,4,'7','12','5'),
																											(3,'BEBE000000007',600,4,'10','12','9'),
																											(3,'BEBE000000008',1,3,'15','12','12'),
																											(4,'BEBE000000009',400,4,'7','12','5'),
																											(4,'BEBE000000010',600,4,'10','12','9'),
																											(4,'BEBE000000011',1,3,'15','12','12'),
																											(5,'BEBE000000012',400,4,'7','12','5'),
																											(5,'BEBE000000013',600,4,'10','12','9'),
																											(5,'BEBE000000014',1,3,'15','12','12'),
																											(6,'BEBE000000015',400,4,'7','12','5'),
																											(6,'BEBE000000016',600,4,'10','12','9'),
																											(6,'BEBE000000017',1,3,'15','12','12'),
																											(7,'BEBE000000018',400,4,'7','12','5'),
																											(7,'BEBE000000019',600,4,'10','12','9'),
																											(7,'BEBE000000020',1,3,'15','12','12'),
																											(8,'BEBE000000021',400,4,'7','12','5'),
																											(8,'BEBE000000022',600,4,'10','12','9'),
																											(8,'BEBE000000023',1,3,'15','12','12'),
																											(9,'BEBE000000024',67,5,'6','12','44'),
																											(9,'BEBE000000025',110,5,'11','12','9'),
																											(9,'BEBE000000026',170,5,'40','12','36'),
																											(10,'BEBE000000027',67,5,'6','12','44'),
																											(10,'BEBE000000028',110,5,'11','12','9'),
																											(10,'BEBE000000029',170,5,'40','12','36'),
																											(11,'BEBE000000030',413,4,'10','12','8'),
																											(12,'BEBE000000031',2,3,'16','12','14'),
																											(13,'BEBE000000032',473,4,'18','12','17'),
																											(14,'BEBE000000033',473,4,'18','12','17'),
																											(15,'BEBE000000034',400,4,'7','12','5'),
																											(15,'BEBE000000035',600,4,'10','12','9'),
																											(15,'BEBE000000036',1,3,'15','12','12');
insert into promocion(id_promocion,fechai,fechaf) values (1,'2017-07-04','2017-07-29'),
																  (2,'2017-07-04','2017-07-29');
insert into promocion_producto(id_promocion,sku,descuento) values (1,'BEBE000000000','3'),
																  (2,'BEBE000000003','10'),
															  	  (2,'BEBE000000004','1'),
															  	  (1,'BEBE000000006','15'),
															  	  (1,'BEBE000000009','5'),
															  	  (2,'BEBE000000010','15'),
															  	  (1,'BEBE000000011','10'),
															  	  (2,'BEBE000000013','10'),
															  	  (1,'BEBE000000015','3'),
															  	  (2,'BEBE000000019','10'),
															  	  (2,'BEBE000000020','5'),
															  	  (2,'BEBE000000024','5'),
															  	  (2,'BEBE000000030','5');
insert into rol(id_rol,rol) values (1,'cliente'),
								   (2,'administrador');		
insert into usuario(id_usuario,email,password) values (null,'LauritaRP@gmail.com','chocoflan'),
														 (null,'sisneros789@gmail.com','cisnenegro'),
														 (null,'AraceliBep@gmail.com','panquesito'),
														 (null,'okelagracia@gmail.com','garcia202'),
														 (null,'flanders788@gmail.com','flandi'),
														 (null,'chapo134@gmail.com','tunelesx3'),
														 (null,'maquinadefuego@gmail.com','123456'),
														 (null,'artesano34@gmail.com','password123'),
														 (null,'martin123@gmail.com','martinillo'),
														 (null,'juanlopezg@gmail.com','juanitolopezitos');
insert into cliente(id_cliente,nombre,apaterno,amaterno,domicilio,id_usuario,foto) values (null,'Joaquin','Guzman','Loera','Juan de dios',6,'default.png'),
																						  (null,'juan','Velasquez','Ayala','Benito Juarez #120',7,'default.png'),
																						  (null,'Artemio','Sanchez','Ortega','Miguel Hidalgo #300',8,'default.png'),
																						  (null,'Martin','Buchelli','Suazo','Presa del palote #103',9,'default.png'),
																						  (null,'Juan','Lopez','Juarez','Chetumal #304',10,'default.png');
insert into usuario_rol(id_rol,id_usuario) values (2,1),
											      (1,2),
											      (1,3),
											      (1,4),
											      (1,5);
insert into empleado(id_empleado,nombre,apaterno,amaterno,id_usuario) values (null,'Laura','Rodriguez','Perez',1),
																			 (null,'Juan','Sisneros','Fuentes',2),
																			 (null,'Araceli','Sanchez','Loyola',3),
																			 (null,'Ofelia','Garcia','Juarez',4),
																			 (null,'Juan','Flanders','Marcelo',5);								 																																																																													
