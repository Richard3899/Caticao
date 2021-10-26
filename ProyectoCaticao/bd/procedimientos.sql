
use caticao;

-- Procedimientos almacenados de Combo Box de Costos --

DROP procedure IF EXISTS `mostrar_combomarca`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomarca` ()
BEGIN
select DISTINCT mr.idMarca,
		        mr.descripcion 
	from marca mr
    left JOIN materia m on m.idMarca=mr.idMarca
;
END$$
DELIMITER ;

DROP procedure IF EXISTS `mostrar_combounidadmedida`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combounidadmedida` ()
BEGIN
select DISTINCT um.idUnidadMedida,
			    um.descripcion
from unidadmedida um left join materia m on m.idUnidadMedida=um.idUnidadMedida;
END$$
DELIMITER ;

DROP procedure IF EXISTS `mostrar_combotipomateria`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combotipomateria` ()
BEGIN
select DISTINCT tm.idTipoMateria,
			tm.descripcion
	from tipomateria tm left join materia m on m.idTipoMateria=tm.idTipoMateria ;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Materia prima --

DROP procedure IF EXISTS `mostrar_materia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_materia` ()
BEGIN
select m.idMateria,
			m.nombre,
			m.descripcion,
            mc.descripcion,
            um.descripcion,
            tm.descripcion,
            m.Cantidad
	from materia m inner join marca mc on mc.idMarca=m.idMarca
						  inner join unidadmedida um  on um.idUnidadMedida=m.idUnidadMedida
                          inner join tipomateria tm  on tm.idTipoMateria=m.idTipoMateria;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_materia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_materia` (
                                        in nombreI varchar(45),
                                        in descripcionI varchar(45),
                                        in cantidadI decimal(10,2),
                                        in idTipoMateriaI int,
                                        in idUnidadMedidaI int,
                                        in idMarcaI int)
BEGIN
	insert into materia (   nombre,
                            descripcion,
                            cantidad,idTipoMateria,idUnidadMedida,idMarca)
			values (nombreI,descripcionI,cantidadI,idTipoMateriaI,idUnidadMedidaI,idMarcaI);
END$$

DELIMITER ;



DROP procedure IF EXISTS `obtener_materia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_materia` (in idMateriaO int)
BEGIN
	select * from materia where idMateria=idMateriaO;
END$$

DELIMITER ;


DROP procedure IF EXISTS `actualizar_materia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_materia` (in idMateriaA int, nombreA varchar(30),
										in descripcionA varchar(30),
										in cantidadA decimal(10,2),
                                        in idTipoMateriaA int,
                                        in idUnidadMedidaA int,
                                        in idMarcaA int)
BEGIN
	update materia set  idMateria=idMateriaA,nombre=nombreA,
						descripcion=descripcionA,
						cantidad=cantidadA,
                        idTipoMateria=idTipoMateriaA,
                        idUnidadMedida=idUnidadMedidaA,
                        idMarca=idMarcaA
				where idMateria=idMateriaA;
END$$

DELIMITER ;

                                    
DROP procedure IF EXISTS `eliminar_materia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_materia` (in idMateriaE int)
BEGIN
	delete from materia
    where idMateria=idMateriaE;
END$$

DELIMITER ;



-- Procedimientos almacenados de producto --





-- Procedimientos almacenados de Combo Box --


DROP procedure IF EXISTS `mostrar_combomateria`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomateria` ()
BEGIN
select DISTINCT m.idMateria,
			CONCAT(m.nombre , ' - ' , mr.descripcion) as nombre
	from materia m 
    left JOIN materiacostos mc on m.idMateria=mc.idMateria
    inner join marca mr on mr.idMarca = m.idMarca
    where mc.idMateria is NULL
;
END$$
DELIMITER ;

DROP procedure IF EXISTS `mostrar_combomateriaeditar`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomateriaeditar` ()
BEGIN
select DISTINCT m.idMateria,
			CONCAT(m.nombre , ' - ' , mr.descripcion) as nombre
	from materia m 
    left JOIN materiacostos mc on m.idMateria=mc.idMateria
    inner join marca mr on mr.idMarca = m.idMarca
;
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
	from TipoCostos tc left join materiacostos mc on tc.idTipoCostos=mc.idTipoCostos
    ;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Materia prima --

DROP procedure IF EXISTS `mostrar_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_materiacostos` ()
BEGIN
select mc.idMateriaCostos,CONCAT(m.nombre , ' - ' , mr.descripcion) as nombre,
			c.descripcion,
            tc.descripcion,
            um.descripcion,
            mc.precioUnitario
	from MateriaCostos mc inner join materia m on mc.idMateria=m.idMateria
						  inner join unidadmedida um  on um.idUnidadMedida=m.idUnidadMedida
						  inner join marca mr on mr.idMarca = m.idMarca
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
                                        in precioUnitarioI decimal(10,2))
BEGIN
	insert into materiacostos (idMateria,
							idCostos,
                            idTipoCostos,
                            precioUnitario)
			values (idMateriaI,idCostosI,idTipoCostosI,precioUnitarioI);
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
                                        in precioUnitarioA decimal(10,2))
BEGIN
	update materiacostos set idMateriaCostos=idMateriaCostosA,
						idMateria=idMateriaA,
						idCostos=idCostosA,
                        idTipoCostos=idTipoCostosA,
                        precioUnitario=precioUnitarioA
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



-- Procedimientos almacenados de Combo Box de Producto --

DROP procedure IF EXISTS `mostrar_comboproducto`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_comboproducto` ()
BEGIN
select DISTINCT idProducto,nombre
	from producto
;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Materia prima --

DROP procedure IF EXISTS `mostrar_agregarreceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_agregarreceta` ()
BEGIN
select      r.idReceta,p.nombre,p.descripcion,
            r.descripcion
           
	from receta r inner join producto p on p.idProducto=r.idProducto
;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_agregarreceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_agregarreceta` (in descripcionI varchar(45),
                                        in idProductoI int
                                        )
BEGIN
	insert into receta (descripcion,
                            idProducto)
			values (descripcionI,idProductoI);
END$$

DELIMITER ;


DROP procedure IF EXISTS `obtener_agregarreceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_agregarreceta` (in idRecetaO int)
BEGIN
	select * from receta where idReceta=idRecetaO;
END$$

DELIMITER ;


DROP procedure IF EXISTS `actualizar_agregarreceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_agregarreceta` (in idRecetaA int,
										in descripcionA varchar(100),
										in idProductoA int
                                            )
BEGIN
	update receta set idReceta=idRecetaA,
						descripcion=descripcionA,
						idProducto=idProductoA
				where idReceta=idRecetaA;
END$$

DELIMITER ;

                                    
DROP procedure IF EXISTS `eliminar_agregarreceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_agregarreceta` (in idRecetaE int)
BEGIN
	delete from receta 
    where idReceta=idRecetaE;
END$$

DELIMITER ;


-- Procedimientos almacenados de Combo Box de Recetainsumos --

DROP procedure IF EXISTS `mostrar_comboreceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_comboreceta` ()
BEGIN
select DISTINCT idReceta,descripcion
	from receta
;
END$$
DELIMITER ;


DROP procedure IF EXISTS `mostrar_combomateriarecetainsumos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomateriarecetainsumos` ()
BEGIN
select  distinct m.idMateria,
			CONCAT(m.nombre , ' - ' , mr.descripcion) as nombre
	from materia m 
	inner join materiacostos mc on mc.idMateria=m.idMateria
    inner join marca mr on mr.idMarca = m.idMarca
    inner join recetamateria rm on rm.idMateria= rm.idMateria;

END$$
DELIMITER ;

-- Procedimientos almacenados de Receta Insumos --

DROP procedure IF EXISTS `mostrar_recetainsumos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_recetainsumos` ()
BEGIN
select  rm.idRecetaMateria,r.descripcion,CONCAT(m.nombre , ' - ' , mr.descripcion) as nombre,
		CONCAT(m.cantidad , ' - ' , um.descripcion) as 'Cantidad en Sotck',
        CONCAT(TRUNCATE(rm.cantidad,0) , ' - ' , um1.descripcion) as 'Peso Neto',mc.precioUnitario,
        TRUNCATE((rm.cantidad/1000)*mc.precioUnitario,2) as Costo
           
	from recetamateria rm inner join receta r on rm.idReceta=r.idReceta
					      inner join materia m on m.idMateria=rm.idMateria
                          inner join unidadmedida um  on um.idUnidadMedida=m.idUnidadMedida
                          inner join unidadmedida um1  on um1.idUnidadMedida=rm.idUnidadMedida
                          inner join marca mr on mr.idMarca = m.idMarca
                          left join materiacostos mc on mc.idMateria = m.idMateria;
                          
END$$
DELIMITER ;



DROP procedure IF EXISTS `mostrar_recetainsumostotal`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_recetainsumostotal` ()
BEGIN
select SUM(TRUNCATE((rm.cantidad/1000)*mc.precioUnitario,2)) as Costo
           
	from recetamateria rm inner join receta r on rm.idReceta=r.idReceta
					      inner join materia m on m.idMateria=rm.idMateria
                          inner join materiacostos mc on mc.idMateria = m.idMateria;
                         
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_recetainsumos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_recetainsumos` (in cantidadI decimal(10,2),
                                        in idMateriaI int,
                                        in idRecetaI int,
                                        in idUnidadMedidaI int
                                        )
BEGIN
	insert into recetamateria (cantidad,idMateria,idReceta,idUnidadMedida)
			values (cantidadI,idMateriaI,idRecetaI,idUnidadMedidaI);
END$$

DELIMITER ;


DROP procedure IF EXISTS `obtener_recetainsumos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_recetainsumos` (in idRecetaMateriaO int)
BEGIN
	select * from recetamateria where idRecetaMateria=idRecetaMateriaO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_recetainsumos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_recetainsumos` (in idRecetaMateriaA int,
										in cantidadA decimal(10,2),
										in idMateriaA int,
                                        in idRecetaA int,
                                        in idUnidadMedidaA int
                                            )
BEGIN
	update recetamateria set idRecetaMateria=idRecetaMateriaA,
						cantidad=cantidadA,
						idMateria=idMateriaA,
                        idReceta=idRecetaA,
                        idUnidadMedida=idUnidadMedidaA
				where idRecetaMateria=idRecetaMateriaA;
END$$
DELIMITER ;

                                    
DROP procedure IF EXISTS `eliminar_recetainsumos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_recetainsumos` (in idRecetaMateriaE int)
BEGIN
	delete from recetamateria
    where idRecetaMateria=idRecetaMateriaE;
END$$
DELIMITER ;
