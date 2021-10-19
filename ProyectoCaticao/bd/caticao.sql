create  database caticao;
use caticao;

create table TipoProveedor(
idTipoProveedor int auto_increment primary key ,
Nombre varchar(45)
);
create table tipoDocumento(
idTipoDocumento int auto_increment primary key,
Nombre varchar(45)
);
create table Proveedor(
idProveedor int auto_increment primary key not null,
Nombre varchar(45) not null,
Telefono int,
correo varchar(45),
TipoDocumento int,
idTipoProveedor int references TipoProveedor(idTipoProveedor),
idtipoDocumento int references TipoDocumento(idtipoDocumento)
);
create table TipoMedida(
idTipoMedida int auto_increment primary key not null,
descripcion varchar (45));

create table UnidadMedida(
idUnidadMedida int auto_increment primary key,
descripcion_Unidad varchar(45),
idTipoMedida int references TipoMedida(idTipoMedida)
);


create table Persona(
idPersona int auto_increment primary key,
Nombre varchar (45),
Apellido varchar(45),
Tipo_Persona varchar(45),
Direccion  varchar(45),
Telefono int,
Email varchar(45),
TipoDocumento int,
idTipoDocumento int references tipoDocumento(idTipoDocumento),
idProveedor int references Proveedor(idProveedor),
idUnidadMedida int references UnidadMedida(idUnidadMedida)
);
create table Usuario(
idUsuario int auto_increment primary key ,
Usuario Varchar(45),
Contraseña varchar(45),
idPersona int references Persona(idPersona)
);
create table TipoProducto(
idTipoProducto int auto_increment primary key,
descripcion varchar(45)
);
create table Almacen(
idAlmacen int auto_increment primary key,
descripcion varchar(45)); 

create table Lote(
idLote int auto_increment  primary key,
NroLote int, 
codigo int);



create table TipoMovimiento(
idTipoMovimiento int auto_increment primary key,
TipoMovimiento varchar(45));

create table Movimiento(
idMovimiento int auto_increment primary key,
Descripcion varchar (100),
Fecha datetime,
idTipoMovimiento int references TipoMovimiento(idTipoMovimiento));

create table MovimientoProducto(
idMovimientoProducto int auto_increment primary key,
CantidadM int,
NumeroM int, 
ValorU decimal(18,2),
MovimientoProducto varchar(45),
idProducto int references Producto(idProducto),
idMovimiento int references Movimiento(idMovimiento)
);
create table TipoMateria(
idTipoMateria int auto_increment primary key,
Descripcion_TipoMateria varchar(45));

create table Marca(
idMarca int auto_increment primary key,
Descripcion_Marca varchar (45));

create table TipoCostos(
idTipoCostos int auto_increment primary key,
Descripcion varchar(45));



create table Servicios(
idServicios int auto_increment primary key,
Descripcion varchar(45));

create table TipoGastos(
idTipoGastos int auto_increment primary key,
Descripcion varchar(45));

create table Gastos(
idGastos int auto_increment primary key,
Descripcion varchar(45),
idTipoGastos int references TipoGastos(idTipoGastos)
);

create table GastosMateria(
idGastosMateria int auto_increment primary key,
PrecioUnit decimal (18,2),
Cantidad int,
idGastos int references Gastos(idGastos)
);
create table GastosServicios(
idGastosServicios int auto_increment primary key,
idGastos int references Gastos(idGastos),
idServicios int references Servicios(idServicios)
);


create table Materia(
idMateria int auto_increment primary key,
Nombre varchar(45),
Descripción varchar(45),
Cantidad int,
idTipoMateria int references TipoMateria(idTipoMateria),
idAlmacen int references Almacen(idAlmacen),
idUnidadMedida int references UnidadMedida (idUnidadMedida),
idProveedor int references Proveedor(idProveedor),
idMarca int references Marca(idMarca)
);
create table Costos (
idCostos int auto_increment primary key,
Descripcion varchar(45)
);

create table MateriaCostos(
idMateriaCostos int auto_increment primary key,
PrecioUnit decimal(18,2),
idCostos int references Costos(idCostos),
idMateria int references Materia(idMateria),
idTipoCostos int references TipoCostos (idTipoCostos)
);

create table MovimientoMateria (
idMovimientoMateria int auto_increment primary key, 
Cantidad int,
idMovimiento int references Movimiento(idMovimiento),
idMateria int references Materia(idMateria));


create table TipoProceso(
idTipoProceso int auto_increment primary key,
Descripcion varchar(45)
);

create table Proceso(
idProceso int auto_increment primary key,
Descripcion varchar(45),
idTipoProceso int references TipoProducto(idTipoProceso),
idUnidadMedida int references UnidadMedida(idUnidadMedida)
);

create table Receta(
idReceta int auto_increment primary key,
Descripcion varchar (45),
idMateria int references Materia (idMateria)
);

create table Receta_Materia(
idReceta_Materia int auto_increment primary key,
Cantidad varchar (45),
idMateria int references Materia (idMateria),
idReceta int references Receta (idReceta)
);

create table Producto(
idProducto int auto_increment primary key,
Nombre varchar(80),
Descripcion varchar(45),
Cantidad int,
Precio decimal(18,2),
idTipoProducto int references TipoProducto(idTipoProducto),
idAlmacen int references Almacen(idAlmacen),
idReceta int references Receta(idReceta),
idLote int references Lote(idLote)
);


alter table Usuario add foreign key (idPersona) references Persona(idPersona);
alter table Persona add foreign key (idTipoDocumento) references tipoDocumento(idTipoDocumento);
alter table Proveedor add foreign key (idTipoProveedor) references TipoProveedor(idTipoProveedor);
alter table Persona add foreign key (idProveedor) references Proveedor(idProveedor);
alter table Producto add foreign key (idTipoProducto) references TipoProducto(idTipoProducto);
alter table Producto add foreign key (idAlmacen) references Almacen(idAlmacen);
alter table MovimientoProducto add foreign key (idProducto) references Producto (idProducto);
alter table Movimiento add foreign key (idTipoMovimiento) references TipoMovimiento(idTipoMovimiento);
alter table MovimientoProducto add foreign key (idMovimiento) references Movimiento (idMovimiento);
alter table MovimientoMateria add foreign key (idMovimiento) references Movimiento (idMovimiento);
alter table MovimientoMateria add foreign key (idMateria) references Materia (idMateria);
alter table Materia add foreign key (idMarca) references Marca (idMarca);
alter table Materia add foreign key (idTipoMateria) references TipoMateria(idTipoMateria);
alter table Materia add foreign key (idAlmacen) references Almacen(idAlmacen);
alter table Materia add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);
alter table UnidadMedida add foreign key (idTipoMedida) references TipoMedida(idTipoMedida);
alter table Persona add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);
alter table Materia add foreign key (idProveedor) references Proveedor(idProveedor);
alter table Proceso add foreign key (idTipoProceso) references TipoProceso(idTipoProceso);
alter table Proceso add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);
alter table MateriaCostos add foreign key (idTipoCostos) references TipoCostos(idTipoCostos);
alter table MateriaCostos add foreign key (idCostos) references Costos (idCostos);
alter table MateriaCostos add foreign key (idMateria) references Materia (idMateria);
alter table GastosServicios add foreign key (idServicios) references Servicios (idServicios);
alter table Gastos add foreign key (idTipoGastos) references TipoGastos(idTipoGastos);
alter table GastosServicios add foreign key (idGastos) references Gastos (idGastos);
alter table GastosMateria add foreign key (idGastos) references Gastos (idGastos);
alter table Producto add Foreign key (idLote) references Lote (idLote);
alter table Producto add foreign key (idReceta) references Receta (idReceta);
alter table Receta_Materia add foreign key (idMateria) references Materia(idMateria);
alter table Receta_Materia add foreign key (idReceta) references Receta(idReceta);



insert into TipoProveedor values (1,'Proveedor Interno'),(2,'Proveedor Externo'),(3,'Proveedor Servicios'),(4,'Proveedor Bienes'),(5,'Proveedor de Recursos');
insert into tipoDocumento values (1,'RUC'),(2,'DNI'),(3,'CARNET EXTRANJERIA'),(4,'PASAPORTE');
insert into Proveedor values (1,'Gloria S.A.C',59483948,'logistica@trading.com',1020413232,1,1);
insert into TipoMedida values(1,'Materia Prima,Insumos y Producto'),(2,'Maquina'),(3,'Persona'),(4,'Servicios'),(5,'Depreciación');
insert into UnidadMedida values (1,'Kilogramos',1),(2,'Gramos',1),(3,'Litros',1),(4,'Unidad',1),(5,'Jormal',3),(6,'Kw/Hra',4),(7,'Golbal',5);
insert into Persona values (1,'Jose','Nalvarte','Empleado','SMP',960596970,'josenalvarte@gmail.com',10535401,1,1,5);
insert into Usuario values (1,'Keyla','admin',1);
insert into TipoProducto values (1,'Barra'),(2,'Polvo');
insert into Almacen values (1,'SEDE CENTRAL');
insert into Lote values (1, 1,000001);
insert into TipoMovimiento values (1,'Entrada Productos') ,(2,'Salida de Producto'),(3,'Preparación de Pedidos'),(4,'Envio'),(5,'Regularizaciones');
insert into Movimiento values (1,'Salida de Productos por Venta','2021-10-01 10:25:30',1);

insert into TipoMateria values (1,'Insumos'),(2,'Materia Prima');
insert into Marca values (1,'Gloria'),(2,'Dulfina'),(3,'Fruttox');
insert into TipoCostos values (1,'Variable'),(2,'Fijo');

insert into Servicios values(1,'Servicios de Elictricidad'),(2,'Servicio de Agua'); 
insert into TipoGastos values(1,'Gastos Administrativos'),(2,'Gastos Servicios'),(3,'Gastos Equipos');
insert into Gastos values (1,'Jefe de Planta',1),(2,'Marketing Publicidad',1),(3,'Alcohol',3);
/*Unidad de Medida y Cantidad Tabla GastosMateria*/
insert into GastosServicios values(1,1,1);
insert into GastosMateria values (1,1800,1,1);
insert into Materia (idMateria,Nombre,Descripción,cantidad,idTipoMateria,idAlmacen, idUnidadMedida, idProveedor,idMarca) 
values (1,'Leche','Preparación de Chocolate',12,1,1,1,1,1);
insert into Costos values (1,'Costo de Materia Prima'),(2,'Costos de Servicios'),(3,'Costo de Depreciación'),(4,'Costo de Mano de obra');
insert into MateriaCostos values(1,'10',1,1,1);
insert into MovimientoMateria values (1,15,1,1);
insert into TipoProceso values(1,'Mano de Obra'),(2,'Maquinaria');
insert into Proceso values(1,'Materia Prima y Recepción',1,1),(2,'Envasado',1,1);
insert into Receta values(1,'Receta 1',1);
insert into Receta_Materia values(1,10,1,1),(2,20,1,1);
insert into Producto values (1,'Chocolate CATICAO de leche 38% con Pecanas','chocolate en barra',20,'7.5',1,1,1,1),
(2,'Chocolate CATICAO Dark 99% y stevia con Arándanos','chocolate en barra',30,'8.5',1,1,1,1), (3,'Chocolate CATICAO semidulce 70% con Nibs de Cacao','chocolate en barra',40,'6.5',1,1,1,1),
(4,'Chocolate CATICAO a la taza','chocolate de Taza',40,'8.5',1,1,1,1), (5,'Chocolate Instantáneo CATICAO 100% cacao en polvo','chocolate en Polvo',30,'10.5',2,1,1,1),
(6,'Chocolate CATICAO semidulce 70% con Kiwicha','chocolate en barra',50,'9',1,1,1,1), (7,'Chocolate CATICAO semidulce 70% con Mango','chocolate en barra',60,'10',1,1,1,1);
insert into MovimientoProducto values (1, 2, 3, '8.5', 'Venta Producto',1,1);


select*from Receta_Materia;

select*from Materia;
select*from producto;


select p.nombre, p.apellido, t.nombre 
from Persona as p inner join tipoDocumento as t  on p.idTipoDocumento=t.idTipoDocumento ;

create view InventarioMateria as
select m.idMateria,m.Nombre as 'Nombre del Producto' , m.descripción,m.cantidad,ma.Descripcion_Marca as Marca,u.descripcion_Unidad as 'Unidad Medida', ti.Descripcion_TipoMateria as 'Tipo de Materia'
from materia as m inner join marca as ma on m.idMarca=ma.idMarca
INNER join unidadmedida as u on m.idUnidadMedida=u.idUnidadMedida
inner join tipomateria as ti on m.idTipoMateria=ti.idTipoMateria;



