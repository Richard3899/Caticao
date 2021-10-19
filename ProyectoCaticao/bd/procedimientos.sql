use caticao;
-- Procedimientos almacenados de producto --
DROP procedure IF EXISTS `mostrar_productos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_productos` ()
BEGIN
select idProducto,
			p.nombre,
			p.descripcion,
			c.nombre,
            p.cantidad,
            p.precio
	from producto p inner join categoria c on p.idCategoria=c.idCategoria ;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_productos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_productos` (in nombreI varchar(50),
										in descripcionI varchar(50),
                                        in idCategoriaI int,
                                        in cantidadI int,
                                        in precioI decimal(10,2))
BEGIN
	insert into producto (nombre,
							descripcion,
							idCategoria,
                            cantidad,
                            precio)
			values (nombreI,descripcionI,idCategoriaI,cantidadI,precioI);
END$$

DELIMITER ;



DROP procedure IF EXISTS `obtener_producto`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_producto` (in idProductoO int)
BEGIN
	select * from producto where idProducto=idProductoO;
END$$

DELIMITER ;



DROP procedure IF EXISTS `actualizar_productos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_productos` (in idProductoA int,
										in nombreA varchar(50),
										in descripcionA varchar(50),
                                        in idCategoriaA int,
                                        in cantidadA int,
                                        in precioA decimal(10,2))
BEGIN
	update producto set nombre=nombreA,
						descripcion=descripcionA,
						idCategoria=idCategoriaA,
                        cantidad=cantidadA,
                        precio=precioA
				where idProducto=idProductoA;
END$$

DELIMITER ;


DROP procedure IF EXISTS `eliminar_productos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_productos` (in idProductoE int)
BEGIN
	delete from producto 
    where idProducto=idProductoE;
END$$

DELIMITER ;



-- Procedimientos almacenados de Combo Box --


DROP procedure IF EXISTS `mostrar_combomateria`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomateria` ()
BEGIN
select DISTINCT m.idMateria,
			m.Nombre
	from materia m left JOIN materiacostos mc on m.idMateria=mc.idMateria ;
END$$
DELIMITER ;


DROP procedure IF EXISTS `mostrar_combocostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combocostos` ()
BEGIN
select DISTINCT c.idCostos,
			c.Descripcion
	from costos c left join materiacostos mc on c.idCostos=mc.idCostos ;
END$$
DELIMITER ;

DROP procedure IF EXISTS `mostrar_combotipocostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combotipocostos` ()
BEGIN
select DISTINCT tc.idTipoCostos,
			tc.Descripcion
	from TipoCostos tc left join materiacostos mc on tc.idTipoCostos=mc.idTipoCostos ;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Materia prima --

DROP procedure IF EXISTS `mostrar_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_materiacostos` ()
BEGIN
select mc.idMateriaCostos,
			m.Nombre,
			c.Descripcion,
            tc.Descripcion,
            mc.PrecioUnit
	from MateriaCostos mc inner join materia m on mc.idMateria=m.idMateria
						  inner join costos c  on mc.idCostos=c.idCostos
                          inner join tipocostos tc  on mc.idTipoCostos=tc.idTipoCostos;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_materiacostos` (in idMateriaI int,
                                        in idCostosI int,
                                        in idTipoCostosI int,
                                        in PrecioUnitI decimal(10,2))
BEGIN
	insert into materiacostos (idMateria,
							idCostos,
                            idTipoCostos,
                            PrecioUnit)
			values (idMateriaI,idCostosI,idTipoCostosI,PrecioUnitI);
END$$

DELIMITER ;

DROP procedure IF EXISTS `obtener_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_materiacostos` (in idMateriaCostosO int)
BEGIN
	select * from materiacostos where idMateriaCostos=idMateriaCostosO;
END$$

DELIMITER ;


DROP procedure IF EXISTS `actualizar_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_materiacostos` (in idMateriaCostosA int,
										in idMateriaA varchar(50),
										in idCostosA varchar(50),
                                        in idTipoCostosA int,
                                        in PrecioUnitA decimal(10,2))
BEGIN
	update materiacostos set idMateriaCostos=idMateriaCostosA,
						idMateria=idMateriaA,
						idCostos=idCostosA,
                        idTipoCostos=idTipoCostosA,
                        PrecioUnit=PrecioUnitA
				where idMateriaCostos=idMateriaCostosA;
END$$

DELIMITER ;

                                    
DROP procedure IF EXISTS `eliminar_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_materiacostos` (in idMateriaCostosE int)
BEGIN
	delete from materiacostos 
    where idMateriaCostos=idMateriaCostosE;
END$$

DELIMITER ;
