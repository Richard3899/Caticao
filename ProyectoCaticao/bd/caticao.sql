create  database caticao;
use caticao;

create table TipoProveedor(
idTipoProveedor int auto_increment primary key ,
nombre varchar(45)
);

create table TipoDocumento(
idTipoDocumento int auto_increment primary key,
nombre varchar(45)
);

create table Proveedor(
idProveedor int auto_increment primary key not null,
nombre varchar(45) not null,
telefono int,
correo varchar(45),
tipoDocumento int,
idTipoProveedor int references TipoProveedor(idTipoProveedor),
idtipoDocumento int references TipoDocumento(idtipoDocumento)
);

create table TipoMedida(
idTipoMedida int auto_increment primary key not null,
descripcion varchar (45));

create table UnidadMedida(
idUnidadMedida int auto_increment primary key,
descripcion varchar(45),
idTipoMedida int references TipoMedida(idTipoMedida)
);

create table Persona(
idPersona int auto_increment primary key,
nombre varchar (45),
apellido varchar(45),
tipoPersona varchar(45),
direccion  varchar(45),
telefono int,
email varchar(45),
tipoDocumento int,
idTipoDocumento int references tipoDocumento(idTipoDocumento),
idProveedor int references Proveedor(idProveedor),
idUnidadMedida int references UnidadMedida(idUnidadMedida)
);
create table Usuario(
idUsuario int auto_increment primary key ,
usuario Varchar(45),
contraseña varchar(45),
idPersona int references Persona(idPersona)
);
create table TipoProducto(
idTipoProducto int auto_increment primary key,
descripcionTP varchar(45)
);
create table Almacen(
idAlmacen int auto_increment primary key,
descripcionA varchar(45)); 

create table TipoMovimiento(
idTipoMovimiento int auto_increment primary key,
descripcion varchar(45));

create table Movimiento(
idMovimiento int auto_increment primary key,
descripcion varchar (100),
fecha datetime,
idTipoMovimiento int references TipoMovimiento(idTipoMovimiento));

create table MovimientoProducto(
idMovimientoProducto int auto_increment primary key,
cantidad int,
numeroMovimiento int, 
valorUnitario decimal(18,2),
idProducto int references Producto(idProducto),
idMovimiento int references Movimiento(idMovimiento)
);
create table TipoMateria(
idTipoMateria int auto_increment primary key,
descripcion varchar(45));

create table Marca(
idMarca int auto_increment primary key,
descripcion varchar (45));

create table Materia(
idMateria int auto_increment primary key,
nombre varchar(45),
descripcion varchar(45),
cantidad int,
idTipoMateria int references TipoMateria(idTipoMateria),
idUnidadMedida int references UnidadMedida (idUnidadMedida),
idMarca int references Marca(idMarca)
);

create table TipoCostos(
idTipoCostos int auto_increment primary key,
descripcion varchar(45)
);


create table MateriaCostos(
idMateriaCostos int auto_increment primary key,
precioUnitario decimal(18,2),
idMateria int references Materia(idMateria),
idTipoCostos int references TipoCostos (idTipoCostos)
);

create table MovimientoMateria (
idMovimientoMateria int auto_increment primary key, 
cantidad int,
idMovimiento int references Movimiento(idMovimiento),
idMateria int references Materia(idMateria));

create table Receta(
idReceta int auto_increment primary key,
descripcion varchar (100),
idProducto int references Producto(idProducto)
);

create table Lote(
idLote int auto_increment  primary key,
numeroLote int, 
codigo int,
idReceta int references Receta(idReceta)
);

create table RecetaMateria(
idRecetaMateria int auto_increment primary key,
cantidad decimal(10,2),
idMateria int references Materia (idMateria),
idReceta int references Receta (idReceta)
);

create table Producto(
idProducto int auto_increment primary key,
nombre varchar(80),
descripcion varchar(45),
cantidad int,
precio decimal(18,2),
idTipoProducto int references TipoProducto(idTipoProducto),
idAlmacen int references Almacen(idAlmacen)
);

create table OrdenProduccion(
idOrdenProduccion int auto_increment primary key,
nombre varchar(80),
idReceta int references Receta(idReceta)
);

create table OrdenProduccionProceso(
idOrdenProducionProceso int auto_increment primary key,
descripcion varchar(80),
idOrdenProduccion int references OrdenProduccion(idOrdenProduccion),
idProceso int references Proceso (idProceso)
);
 
create table Maquina(
idMaquina int auto_increment primary key,
nombre varchar(80),
descripcion varchar(80)
);

create table Proceso(
idProceso int auto_increment primary key,
descripcion varchar(45),
idMaquina int references Maquina (idMaquina)
);

create table Depreciacion(
idDepreciacion int auto_increment primary key,
importe decimal(10,2),
vidaUtil int,
depreciacionAnual decimal(10,2),
depreciacionMensual decimal(10,2),
depreciacionHora decimal(10,2), 
tiempoDeUso decimal(10,2),
depreciacionPorBatch decimal(10,2),
idMaquina int references Maquina (idMaquina),
idTipoCostos int references TipoCostos (idTipoCostos)
);

create table ConsumoEnergia(
idConsumoEnergia int auto_increment primary key,
potenciaHP decimal(10,2),
potenciawatts decimal(10,2),
potenciaKw decimal(10,2),
horasTrabajoBatch decimal(10,2),
consumoKwh decimal(10,2),
tarifaKwh decimal(10,2),
pagoPorBatch decimal(10,2),
idMaquina int references Maquina (idMaquina),
idTipoCostos int references TipoCostos (idTipoCostos),
idUnidadMedida int references UnidadMedida(idUnidadMedida)
);

create table GastosAdmin(
idGastosAdmin int auto_increment primary key,
descripcion varchar(45),
precioUnitario decimal(10,2),
idUnidadMedida int references UnidadMedida(idUnidadMedida),
idTipoCostos int references TipoCostos (idTipoCostos)
);

create table ManodeObra(
idManodeObra int auto_increment primary key,
descripcion varchar(45),
precioUnitario decimal(10,2),
idUnidadMedida int references UnidadMedida(idUnidadMedida),
idTipoCostos int references TipoCostos (idTipoCostos)
);

create table ManodeObraProceso(
idManodeObraProceso int auto_increment primary key,
descripcion varchar(45),
idProceso int references Proceso (idProceso),
idManodeObra int references ManodeObra (idManodeObra)
);

create table MateriaProceso(
idMateriaProceso int auto_increment primary key,
descripcion varchar(45),
idProceso int references Proceso(idProceso),
idMateria int references Materia (idMateria)
);

create table GastosAdminProceso(
idGastosAdminProceso int auto_increment primary key,
descripcion varchar(45),
idProceso int references Proceso(idProceso),
idGastosAdmin int references GastosAdmin (idGastosAdmin)
);

create table ManodeObraReceta(
idManodeObraReceta int auto_increment primary key,
cantidad decimal(10,2),
idManodeObra int references ManodeObra (idManodeObra),
idReceta int references Receta (idReceta)
);

create table ConsumoEnergiaReceta(
idConsumoEnergiaReceta int auto_increment primary key,
idConsumoEnergia int references ConsumoEnergia (idConsumoEnergia),
idReceta int references Receta (idReceta)
);

create table DepreciacionReceta(
idDepreciacionReceta int auto_increment primary key,
idDepreciacion int references Depreciacion (idDepreciacion),
idReceta int references Receta (idReceta)
);

create table GastosAdminReceta(
idGastosAdminReceta int auto_increment primary key,
cantidad decimal(10,2),
idGastosAdmin int references GastosAdmin (idGastosAdmin),
idReceta int references Receta (idReceta)
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
alter table Materia add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);
alter table UnidadMedida add foreign key (idTipoMedida) references TipoMedida(idTipoMedida);
alter table Persona add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);

alter table MateriaCostos add foreign key (idTipoCostos) references TipoCostos(idTipoCostos);
alter table MateriaCostos add foreign key (idMateria) references Materia (idMateria);

alter table RecetaMateria add foreign key (idMateria) references Materia(idMateria);
alter table RecetaMateria add foreign key (idReceta) references Receta(idReceta);

alter table ManodeObraReceta add foreign key (idManodeObra) references ManodeObra(idManodeObra);
alter table ManodeObraReceta add foreign key (idReceta) references Receta(idReceta);

alter table ConsumoEnergiaReceta add foreign key (idReceta) references Receta(idReceta);
alter table ConsumoEnergiaReceta add foreign key (idConsumoEnergia) references ConsumoEnergia(idConsumoEnergia);

alter table DepreciacionReceta add foreign key (idReceta) references Receta(idReceta);
alter table DepreciacionReceta add foreign key (idDepreciacion) references Depreciacion(idDepreciacion);

alter table GastosAdminReceta add foreign key (idReceta) references Receta(idReceta);
alter table GastosAdminReceta add foreign key (idGastosAdmin) references GastosAdmin(idGastosAdmin);

alter table Receta add foreign key (idProducto) references Producto(idProducto);
alter table Lote add foreign key (idReceta) references Receta(idReceta);
alter table Depreciacion add foreign key (idMaquina) references Maquina(idMaquina);
alter table Depreciacion add foreign key (idTipoCostos) references TipoCostos(idTipoCostos);

alter table Proceso add foreign key (idMaquina) references Maquina(idMaquina);
alter table ConsumoEnergia add foreign key (idMaquina) references Maquina(idMaquina);
alter table ConsumoEnergia add foreign key (idTipoCostos) references TipoCostos(idTipoCostos);
alter table ConsumoEnergia add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);

alter table GastosAdmin add foreign key (idTipoCostos) references TipoCostos(idTipoCostos);
alter table GastosAdmin add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);

alter table MateriaProceso add foreign key (idMateria) references Materia(idMateria);
alter table GastosAdminProceso add foreign key (idGastosAdmin) references GastosAdmin(idGastosAdmin);

alter table MateriaProceso add foreign key (idProceso) references Proceso(idProceso);
alter table GastosAdminProceso add foreign key (idProceso) references Proceso(idProceso);

alter table ManodeObraProceso add foreign key (idProceso) references Proceso(idProceso);
alter table ManodeObraProceso add foreign key (idManodeObra) references ManodeObra(idManodeObra);

alter table ManodeObra add foreign key (idTipoCostos) references TipoCostos(idTipoCostos);
alter table ManodeObra add foreign key (idUnidadMedida) references UnidadMedida(idUnidadMedida);

alter table OrdenProduccion add foreign key (idReceta) references Receta (idReceta);
alter table OrdenProduccionProceso add foreign key (idProceso) references Proceso (idProceso);
alter table OrdenProduccionProceso add Foreign key (idOrdenProduccion) references OrdenProduccion (idOrdenProduccion);

insert into TipoProveedor values (1,'Proveedor Interno'),(2,'Proveedor Externo'),(3,'Proveedor Servicios'),(4,'Proveedor Bienes'),(5,'Proveedor de Recursos');
insert into tipoDocumento values (1,'RUC'),(2,'DNI'),(3,'CARNET EXTRANJERIA'),(4,'PASAPORTE');
insert into Proveedor values (1,'Gloria S.A.C',59483948,'logistica@trading.com',1020413232,1,1);
insert into TipoMedida values(1,'Materia Prima, Insumos y Producto'),(2,'Maquina'),(3,'Persona'),(4,'Servicios'),(5,'Depreciación');
insert into UnidadMedida values (1,'Kilogramos',1),(2,'Gramos',1),(3,'Litros',1),(4,'Mililitros',1),(5,'Unidad',1),(6,'Jornal',3),(7,'Kw/Hra',4),(8,'Global',5);
insert into Persona values (1,'Jose','Nalvarte','Empleado','SMP',960596970,'josenalvarte@gmail.com',10535401,1,1,5);
insert into Usuario values (1,'Keyla','admin',1);
insert into TipoProducto values (1,'Producto Intermedio'),(2,'Producto Terminado'),(3,'Perdida de producto');
insert into Almacen values (1,'SEDE CENTRAL');
insert into TipoMovimiento values (1,'Entrada Productos') ,(2,'Salida de Producto'),(3,'Preparación de Pedidos'),(4,'Envio'),(5,'Regularizaciones');
insert into Movimiento values (1,'Salida de Productos por Venta','2021-10-01 10:25:30',1);

insert into TipoMateria values (1,'Insumos'),(2,'Materia Prima'),(3,'Materiales y Equipos');
insert into Marca values (1,'Gloria'),(2,'Dulfina'),(3,'Fruttox'),(4,'Negrita'),(5,'Anchor'),(6,'Marina'),
(7,'Mason'),(8,'Andina'),(9,'Orinka'),(10,'Nestle'),(11,'Rio Valle'),(12,'Villa Natura'),(13,'Elaboración Propia');

/*Unidad de Medida y Cantidad Tabla GastosMateria*/
insert into Materia (idMateria,Nombre,descripcion,cantidad,idTipoMateria, idUnidadMedida,idMarca) 
values (1,'Leche descremada','En polvo',40,1,1,10),(2,'Cacao','Selecto',80,1,1,8),(3,'Pasas','Suaves',20,1,1,11),(4,'Pecanas','Suaves',20,1,1,12)
,(5,'Azucar','Blanca',20,1,1,2),(6,'Sal','De maras',20,1,1,9),(7,'Lecitina de soya','De calidad',20,1,3,7),(8,'Licor de cacao','Bueno',20,1,3,13),
(9,'Leche entera','En polvo',20,1,1,1),(10,'Manteca de cacao','bueno',20,1,1,13);

insert into TipoCostos values (1,'Variable'),(2,'Fijo');

insert into MateriaCostos values(1,'3.9',1,1);

insert into MovimientoMateria values (1,15,1,1);

insert into Maquina values(1,'Seleccionadora','Sirve para la selección del cacao');
insert into Proceso values(1,'Selección de granos',1),(2,'Tostado',1),(3,'Descascarillado',1),(4,'Molienda',1),(5,'Refinado',1)
						 ,(6,'Prensado',1),(7,'Refinado - Formulado',1),(8,'Temperado',1),(9,'Moldeado',1),(10,'Enfriado',1),(11,'Empaquetado y Etiquetado',1);

insert into Producto values (1,'Chocolate CATICAO de leche 38% con Pecanas','chocolate en barra',20,'7.5',1,1),
(2,'Chocolate CATICAO Dark 99% y stevia con Arándanos','chocolate en barra',30,'8.5',1,1), (3,'Chocolate CATICAO semidulce 70% con Nibs de Cacao','chocolate en barra',40,'6.5',1,1),
(4,'Chocolate CATICAO a la taza','chocolate de Taza',40,'8.5',1,1), (5,'Chocolate Instantáneo CATICAO 100% cacao en polvo','chocolate en Polvo',30,'10.5',2,1),
(6,'Chocolate CATICAO semidulce 70% con Kiwicha','chocolate en barra',50,'9',1,1), (7,'Chocolate CATICAO semidulce 70% con Mango','chocolate en barra',60,'10',1,1);
insert into Receta values(1,'Receta 1 - a 70% con pasas',1),(2,'Receta 2 - a 38% con leche',1);
insert into Lote values (1, 1,000001,1);
insert into RecetaMateria values(1,240,1,2);

insert into MovimientoProducto values (1, 2, 3, '8.5',1,1);
insert into OrdenProduccion values (1, 'Producción de Nibs', 1);
insert into OrdenProduccionProceso values (1,'Se realiza el proceso de descascarillado' , 1 ,2);

insert into GastosAdmin values (1,'Jefe de Planta' , 1800 ,4,2);
insert into ManodeObra values (1,'Selección' , 1800 ,4,2);
insert into MateriaProceso values (1,'Prueba',1 ,1);
insert into GastosAdminProceso values (1,'Prueba',1 ,1);