
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



-- Procedimientos almacenados de Materia prima --

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





-- Procedimientos almacenados de Combo Box ----------------------------------------------------------------------------------------------


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
            tc.descripcion,
            um.descripcion,
            mc.precioUnitario
	from MateriaCostos mc inner join materia m on mc.idMateria=m.idMateria
						  inner join unidadmedida um  on um.idUnidadMedida=m.idUnidadMedida
						  inner join marca mr on mr.idMarca = m.idMarca
                          inner join tipocostos tc  on mc.idTipoCostos=tc.idTipoCostos;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_materiacostos`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_materiacostos` (in idMateriaI int,
                                        in idTipoCostosI int,
                                        in precioUnitarioI decimal(10,2))
BEGIN
	insert into materiacostos (idMateria,
                            idTipoCostos,
                            precioUnitario)
			values (idMateriaI,idTipoCostosI,precioUnitarioI);
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
                                        in idTipoCostosA int,
                                        in precioUnitarioA decimal(10,2))
BEGIN
	update materiacostos set idMateriaCostos=idMateriaCostosA,
						idMateria=idMateriaA,
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
        CONCAT(TRUNCATE(rm.cantidad,2) , ' - ' , um.descripcion ) as 'Peso Neto',mc.precioUnitario,
        TRUNCATE(rm.cantidad*mc.precioUnitario,2) as Costo
           
	from recetamateria rm inner join receta r on rm.idReceta=r.idReceta
					      inner join materia m on m.idMateria=rm.idMateria
                          inner join unidadmedida um  on um.idUnidadMedida=m.idUnidadMedida
                          inner join marca mr on mr.idMarca = m.idMarca
                          left join materiacostos mc on mc.idMateria = m.idMateria;
                          
END$$
DELIMITER ;



DROP procedure IF EXISTS `mostrar_recetainsumostotal`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_recetainsumostotal` ()
BEGIN
select SUM(TRUNCATE(rm.cantidad*mc.precioUnitario,2)) as Costo
           
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
                                        in idRecetaI int
                                        )
BEGIN
	insert into recetamateria (cantidad,idMateria,idReceta)
			values (cantidadI,idMateriaI,idRecetaI);
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
                                        in idRecetaA int				
                                            )
BEGIN
	update recetamateria set idRecetaMateria=idRecetaMateriaA,
						cantidad=cantidadA,
						idMateria=idMateriaA,
                        idReceta=idRecetaA
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



-- Procedimientos almacenados de Combo Box de Costos Indirectos --------------------------------------------------------------------


DROP procedure IF EXISTS `mostrar_combomaquina`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomaquina` ()
BEGIN
select DISTINCT idMaquina,nombre
	from maquina
;
END$$
DELIMITER ;


DROP procedure IF EXISTS `mostrar_combomaquinaenergia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomaquinaenergia` ()
BEGIN
select DISTINCT m.idMaquina,m.nombre
	from maquina m left join consumoenergia ce on ce.idMaquina= m.idMaquina
	where ce.idMaquina is NULL;
END$$
DELIMITER ;


DROP procedure IF EXISTS `mostrar_combomaquinadepreciacion`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomaquinadepreciacion` ()
BEGIN
select DISTINCT m.idMaquina,m.nombre
	from maquina m left join depreciacion d on d.idMaquina= m.idMaquina
	where d.idMaquina is NULL;

END$$
DELIMITER ;


-- Procedimientos almacenados de Consumo de energia -----------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_consumoenergia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_consumoenergia` ()
BEGIN
select ce.idConsumoEnergia, m.nombre, ce.potenciaHP,ce.potenciawatts,ce.potenciaKw,ce.horasTrabajoBatch,
ce.consumoKwh,tc.descripcion,ce.tarifaKwh,ce.pagoPorBatch
	from ConsumoEnergia ce  inner join  maquina m on m.idMaquina= ce.idMaquina
							inner join  tipocostos tc on tc.idTipoCostos= ce.idTipoCostos;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_consumoenergia`;
DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_consumoenergia` (in tarifaKwhI decimal(10,2),
											 in idMaquinaI int,in idTipoCostosI int)
                                        
BEGIN
	insert into consumoenergia (potenciaHP,potenciawatts,potenciaKw,horasTrabajoBatch,consumoKwh,idTipoCostos,tarifaKwh,pagoPorBatch,idMaquina)
			values (1,potenciaHP*745,potenciawatts/1000,0.40,potenciaKw*horasTrabajoBatch,idTipoCostosI,tarifaKwhI,consumoKwh*tarifaKwhI,idMaquinaI);
END$$

DELIMITER ;


DROP procedure IF EXISTS `obtener_consumoenergia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_consumoenergia` (in idConsumoEnergiaO int)
BEGIN
	select * from consumoenergia where idConsumoEnergia=idConsumoEnergiaO;
END$$

DELIMITER ;


DROP procedure IF EXISTS `actualizar_consumoenergia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_consumoenergia` (in idConsumoEnergiaA int,
											  in tarifaKwhA decimal(10,2),
                                              in idTipoCostosI int)
BEGIN
	update consumoenergia set idConsumoEnergia=idConsumoEnergiaA,
						tarifaKwh=tarifaKwhA,
                        idTipoCostos=idTipoCostosI,
                        pagoPorBatch=consumoKwh*tarifaKwhA
				where idConsumoEnergia=idConsumoEnergiaA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_consumoenergia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_consumoenergia` (in idConsumoEnergiaE int)
BEGIN
	delete from consumoenergia 
    where idConsumoEnergia=idConsumoEnergiaE;
END$$

DELIMITER ;


DROP procedure IF EXISTS `mostrar_consumoenergiatotal`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_consumoenergiatotal` ()
BEGIN
select SUM(TRUNCATE(pagoPorBatch,2)) as Costo
           
	from consumoenergia;
                         
END$$
DELIMITER ;




-- Procedimientos almacenados de Consumo de energia -----------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_depreciacion`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_depreciacion` ()
BEGIN
select d.idDepreciacion, m.nombre,d.importe,d.vidautil,d.depreciacionAnual,d.depreciacionMensual,d.depreciacionHora,
	   d.tiempoDeUso,tc.descripcion,d.depreciacionPorBatch
	from depreciacion d  inner join  maquina m on m.idMaquina= d.idMaquina
						 inner join  tipocostos tc on tc.idTipoCostos= d.idTipoCostos;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_depreciacion`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_depreciacion` (   in importeI decimal(10,2),
											 in vidaUtilI int,
                                             in idMaquinaI int,
                                             in idTipoCostosI int)
                                        
BEGIN
	insert into depreciacion (importe,vidaUtil,depreciacionAnual,depreciacionMensual,depreciacionHora,
                                tiempoDeUso,idTipoCostos,depreciacionPorBatch,idMaquina)
			values (importeI,vidaUtilI,importeI/vidaUtilI,depreciacionAnual/12,depreciacionMensual/(25*24),
                    0.4,idTipoCostosI,depreciacionHora*tiempoDeUso,idMaquinaI);
END$$
DELIMITER ;


DROP procedure IF EXISTS `obtener_depreciacion`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_depreciacion` (in idDepreciacionO int)
BEGIN
	select * from depreciacion where idDepreciacion=idDepreciacionO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_depreciacion`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_depreciacion` (in idDepreciacionA int,
                                        in importeA decimal(10,2),
                                        in vidaUtilA int,
                                        in idTipoCostosA int)
BEGIN
	update depreciacion set idDepreciacion=idDepreciacionA,
						importe=importeA,
                        vidaUtil=vidaUtilA,
                        depreciacionAnual=importeA/vidaUtilA,
                        depreciacionMensual=depreciacionAnual/12,
                        depreciacionHora=depreciacionMensual/(25*24),
                        idTipoCostos=idTipoCostosA,
                        depreciacionPorBatch=depreciacionHora*tiempoDeUso
				where idDepreciacion=idDepreciacionA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_depreciacion`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_depreciacion` (in idDepreciacionE int)
BEGIN
	delete from depreciacion 
    where idDepreciacion=idDepreciacionE;
END$$
DELIMITER ;


DROP procedure IF EXISTS `mostrar_depreciaciontotal`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_depreciaciontotal` ()
BEGIN
select SUM(TRUNCATE(depreciacionPorBatch,2)) as Costo
           
	from depreciacion;
                         
END$$
DELIMITER ;


-- Procedimientos almacenados de Maquina ---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_maquina`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_maquina` ()
BEGIN
select idMaquina,nombre,descripcion
	from maquina;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_maquina`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_maquina` (   in nombreI varchar(80),
                                        in descripcionI varchar(80)
                                        )
BEGIN
	insert into maquina (nombre,descripcion)
			values (nombreI,descripcionI);
END$$
DELIMITER ;



DROP procedure IF EXISTS `obtener_maquina`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_maquina` (in idMaquinaO int)
BEGIN
	select * from maquina where idMaquina=idMaquinaO;
END$$

DELIMITER ;


DROP procedure IF EXISTS `actualizar_maquina`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_maquina` (in idMaquinaA int, nombreA varchar(80),
										in descripcionA varchar(80))
BEGIN
	update maquina set  idMaquina=idMaquinaA,nombre=nombreA,
						descripcion=descripcionA
						
				where idMaquina=idMaquinaA;
END$$

DELIMITER ;


                                    
DROP procedure IF EXISTS `eliminar_maquina`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_maquina` (in idMaquinaE int)
BEGIN
	delete from maquina
    where idMaquina=idMaquinaE;
END$$
DELIMITER ;







-- Procedimientos almacenados de Gastos Administrativos y Otros  ----------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_gastosadmin`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_gastosadmin` ()
BEGIN
select ga.idGastosAdmin,
            ga.descripcion,
            um.descripcion,
            tc.descripcion,
            ga.precioUnitario
	from gastosadmin ga inner join unidadmedida um  on um.idUnidadMedida=ga.idUnidadMedida
                          inner join tipocostos tc on tc.idTipoCostos=ga.idTipoCostos;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_gastosadmin`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_gastosadmin` (in descripcionI varchar(45),
                                        in precioUnitarioI decimal(10,2),
                                        in idTipoCostosI int,
                                        in idUnidadMedidaI int)
BEGIN
	insert into gastosadmin (descripcion,precioUnitario,idTipoCostos,idUnidadMedida)
			         values (descripcionI,precioUnitarioI,idTipoCostosI,idUnidadMedidaI);
END$$
DELIMITER ;


DROP procedure IF EXISTS `obtener_gastosadmin`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_gastosadmin` (in idGastosAdminO int)
BEGIN
	select * from gastosadmin where idGastosAdmin=idGastosAdminO;
END$$

DELIMITER ;


DROP procedure IF EXISTS `actualizar_gastosadmin`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_gastosadmin` (in idGastosAdminA int,
										in descripcionA varchar(30),
										in precioUnitarioA decimal(10,2),
                                        in idTipoCostosA int,
                                        in idUnidadMedidaA int)
BEGIN
	update gastosadmin set  idGastosAdmin=idGastosAdminA,
						descripcion=descripcionA,
						precioUnitario=precioUnitarioA,
                        idTipoCostos=idTipoCostosA,
                        idUnidadMedida=idUnidadMedidaA
				where idGastosAdmin=idGastosAdminA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_gastosadmin`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_gastosadmin` (in idGastosAdminE int)
BEGIN
	delete from gastosadmin
    where idGastosAdmin=idGastosAdminE;
END$$
DELIMITER ;



-- Procedimientos almacenados de Combo Box de Mano de Obra---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_combomanodeobra`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combomanodeobra` ()
BEGIN
select DISTINCT idManodeObra,descripcion
	from manodeobra
;
END$$
DELIMITER ;


use caticao;


-- Procedimientos almacenados de Mano de Obra  -----------------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_manodeobra`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_manodeobra` ()
BEGIN
select mo.idManodeObra,
            mo.descripcion,
            um.descripcion,
            tc.descripcion,
            mo.precioUnitario
	from manodeobra mo inner join unidadmedida um  on um.idUnidadMedida=mo.idUnidadMedida
                          inner join tipocostos tc on tc.idTipoCostos=mo.idTipoCostos;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_manodeobra`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_manodeobra` (in descripcionI varchar(45),
                                        in precioUnitarioI decimal(10,2),
                                        in idTipoCostosI int,
                                        in idUnidadMedidaI int)
BEGIN
	insert into manodeobra (descripcion,precioUnitario,idTipoCostos,idUnidadMedida)
			         values (descripcionI,precioUnitarioI,idTipoCostosI,idUnidadMedidaI);
END$$
DELIMITER ;


DROP procedure IF EXISTS `obtener_manodeobra`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_manodeobra` (in idManodeObraO int)
BEGIN
	select * from manodeobra where idManodeObra=idManodeObraO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_manodeobra`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_manodeobra` (in idManodeObraA int,
										in descripcionA varchar(30),
										in precioUnitarioA decimal(10,2),
                                        in idTipoCostosA int,
                                        in idUnidadMedidaA int)
BEGIN
	update manodeobra set  idManodeObra=idManodeObraA,
						descripcion=descripcionA,
						precioUnitario=precioUnitarioA,
                        idTipoCostos=idTipoCostosA,
                        idUnidadMedida=idUnidadMedidaA
				where idManodeObra=idManodeObraA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_manodeobra`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_manodeobra` (in idManodeObraE int)
BEGIN
	delete from manodeobra
    where idManodeObra=idManodeObraE;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Materia prima ---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_materiaproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_materiaproceso` ()
BEGIN
select mp.idMateriaProceso,CONCAT(m.nombre , ' - ' , mr.descripcion) as nombre,
            p.descripcion,
            mp.descripcion
	from MateriaProceso mp inner join materia m on m.idMateria=mp.idMateria
						  inner join marca mr on mr.idMarca = m.idMarca
                          inner join proceso p  on p.idProceso=mp.idProceso;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_materiaproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_materiaproceso` (in idMateriaI int,
                                        in idProcesoI int,
                                       in descripcionI varchar(45))
BEGIN
	insert into materiaproceso (idMateria,
                            idProceso,
                            descripcion)
			values (idMateriaI,idProcesoI,descripcionI);
END$$
DELIMITER ;

DROP procedure IF EXISTS `obtener_materiaproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_materiaproceso` (in idMateriaProcesoO int)
BEGIN
	select * from materiaproceso where idMateriaProceso=idMateriaProcesoO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_materiaproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_materiaproceso` (in idMateriaProcesoA int,
										in idMateriaA int,
                                        in idProcesoA int,
                                        in descripcionA varchar(45))
BEGIN
	update materiaproceso set idMateriaProceso=idMateriaProcesoA,
						idMateria=idMateriaA,
                        idProceso=idProcesoA,
                        descripcion=descripcionA
				where idMateriaProceso=idMateriaProcesoA;
END$$
DELIMITER ;


                                    
DROP procedure IF EXISTS `eliminar_materiaproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_materiaproceso` (in idMateriaProcesoE int)
BEGIN
	delete from materiaproceso
    where idMateriaProceso=idMateriaProcesoE;
END$$
DELIMITER ;



-- Procedimientos almacenados de Combo Box de Proceso---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_proceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_proceso` ()
BEGIN
select DISTINCT idProceso,descripcion
	from proceso
;
END$$
DELIMITER ;


-- Procedimientos almacenados de Combo Box de Gastos Administrativos---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_combogastosadmin`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_combogastosadmin` ()
BEGIN
select DISTINCT idGastosAdmin,descripcion
	from gastosadmin
;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Materia prima ---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_gastosadminproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_gastosadminproceso` ()
BEGIN
select gap.idGastosAdminProceso, ga.descripcion,
            p.descripcion,gap.descripcion
	from gastosadminproceso gap inner join gastosadmin ga on ga.idGastosAdmin=gap.idGastosAdmin
                          inner join proceso p  on p.idProceso=gap.idProceso;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_gastosadminproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_gastosadminproceso` (in idGastosAdminI int,
                                        in idProcesoI int,
                                       in descripcionI varchar(45))
BEGIN
	insert into gastosadminproceso (idGastosAdmin,
                            idProceso,
                            descripcion)
			values (idGastosAdminI,idProcesoI,descripcionI);
END$$
DELIMITER ;

DROP procedure IF EXISTS `obtener_gastosadminproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_gastosadminproceso` (in idGastosAdminProcesoO int)
BEGIN
	select * from gastosadminproceso where idGastosAdminProceso=idGastosAdminProcesoO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_gastosadminproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_gastosadminproceso` (in idGastosAdminProcesoA int,
										in idGastosAdminA int,
                                        in idProcesoA int,
                                        in descripcionA varchar(45))
BEGIN
	update gastosadminproceso set idGastosAdminProceso=idGastosAdminProcesoA,
						idGastosAdmin=idGastosAdminA,
                        idProceso=idProcesoA,
                        descripcion=descripcionA
				where idGastosAdminProceso=idGastosAdminProcesoA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_gastosadminproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_gastosadminproceso` (in idGastosAdminProcesoE int)
BEGIN
	delete from gastosadminproceso
    where idGastosAdminProceso=idGastosAdminProcesoE;
END$$
DELIMITER ;




-- Procedimientos almacenados de Costo de Mano de obra y proceso ---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_manodeobraproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_manodeobraproceso` ()
BEGIN
select mop.idManodeObraProceso, mo.descripcion,
            p.descripcion,mop.descripcion
	from manodeobraproceso mop inner join manodeobra mo on mo.idManodeObra=mop.idManodeObra
                               inner join proceso p  on p.idProceso=mop.idProceso;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_manodeobraproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_manodeobraproceso` (in idManodeObraI int,
                                        in idProcesoI int,
                                       in descripcionI varchar(45))
BEGIN
	insert into manodeobraproceso (idManodeObra,
                            idProceso,
                            descripcion)
			values (idManodeObraI,idProcesoI,descripcionI);
END$$
DELIMITER ;

DROP procedure IF EXISTS `obtener_manodeobraproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_manodeobraproceso` (in idManodeObraProcesoO int)
BEGIN
	select * from manodeobraproceso where idManodeObraProceso=idManodeObraProcesoO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_manodeobraproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_manodeobraproceso` (in idManodeObraProcesoA int,
										in idManodeObraA int,
                                        in idProcesoA int,
                                        in descripcionA varchar(45))
BEGIN
	update manodeobraproceso set idManodeObraProceso=idManodeObraProcesoA,
						idManodeObra=idManodeObraA,
                        idProceso=idProcesoA,
                        descripcion=descripcionA
				where idManodeObraProceso=idManodeObraProcesoA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_manodeobraproceso`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_manodeobraproceso` (in idManodeObraProcesoE int)
BEGIN
	delete from manodeobraproceso
    where idManodeObraProceso=idManodeObraProcesoE;
END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Mano de obra y proceso ---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_manodeobrareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_manodeobrareceta` ()
BEGIN
select mor.idManodeObraReceta,r.descripcion,
            mo.descripcion,mo.precioUnitario, TRUNCATE(mor.cantidad,2) as cantidad,
            TRUNCATE(mor.cantidad*mo.precioUnitario,2) as Costo
	from manodeobrareceta mor inner join manodeobra mo on mo.idManodeObra=mor.idManodeObra
                               inner join receta r  on r.idReceta=mor.idReceta;
END$$
DELIMITER ;

DROP procedure IF EXISTS `insertar_manodeobrareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_manodeobrareceta` (in idManodeObraI int,
                                        in idRecetaI int,
                                       in cantidadI decimal(10,2))
BEGIN
	insert into manodeobrareceta (idManodeObra,
                            idReceta,
                            cantidad)
			values (idManodeObraI,idRecetaI,cantidadI);
END$$
DELIMITER ;

DROP procedure IF EXISTS `obtener_manodeobrareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_manodeobrareceta` (in idManodeObraRecetaO int)
BEGIN
	select * from manodeobrareceta where idManodeObraReceta=idManodeObraRecetaO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_manodeobrareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_manodeobrareceta` (in idManodeObraRecetaA int,
										in idManodeObraA int,
                                        in idRecetaA int,
                                        in cantidadA decimal(10,2))
BEGIN
	update manodeobrareceta set idManodeObraReceta=idManodeObraRecetaA,
						idManodeObra=idManodeObraA,
                        idReceta=idRecetaA,
                        cantidad=cantidadA
				where idManodeObraReceta=idManodeObraRecetaA;
END$$
DELIMITER ;


DROP procedure IF EXISTS `eliminar_manodeobrareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_manodeobrareceta` (in idManodeObraRecetaE int)
BEGIN
	delete from manodeobrareceta
    where idManodeObraReceta=idManodeObraRecetaE;
END$$
DELIMITER ;

DROP procedure IF EXISTS `mostrar_recetamanodeobratotal`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_recetamanodeobratotal` ()
BEGIN
select SUM(TRUNCATE(mor.cantidad*mo.precioUnitario,2)) as Costo
           
	from manodeobrareceta mor inner join receta r on r.idReceta=mor.idReceta
					      inner join manodeobra mo on mo.idManodeObra=mor.idManodeObra;
				
END$$
DELIMITER ;


-- Procedimientos almacenados de Combo Box de Consumo de energia--------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_comboconsumoenergia`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_comboconsumoenergia` ()
BEGIN
select DISTINCT ce.idConsumoEnergia,CONCAT('Consumo de energia de ',m.nombre) as nombre
	from consumoenergia ce inner join maquina m on m.idMaquina= ce.idMaquina;

END$$
DELIMITER ;



-- Procedimientos almacenados de Costo de Mano de obra y proceso ---------------------------------------------------------------------------------

DROP procedure IF EXISTS `mostrar_consumoenergiareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_consumoenergiareceta` ()
BEGIN
select cer.idConsumoEnergiaReceta,r.descripcion, CONCAT('Consumo de energia de ',m.nombre) as nombre,ce.pagoPorBatch
	from consumoenergiareceta cer inner join consumoenergia ce on ce.idConsumoEnergia=cer.idConsumoEnergia
                                  inner join receta r  on r.idReceta=cer.idReceta
                                  inner join maquina m on m.idMaquina= ce.idMaquina;
END$$
DELIMITER ;

DROP procedure IF EXISTS `insertar_consumoenergiareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_consumoenergiareceta` (in idConsumoEnergiaI int,
                                                  in idRecetaI int
                                                                  )
BEGIN
	insert into consumoenergiareceta (idConsumoEnergia,
                            idReceta )
			values (idConsumoEnergiaI,idRecetaI);
END$$
DELIMITER ;


DROP procedure IF EXISTS `obtener_consumoenergiareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `obtener_consumoenergiareceta` (in idConsumoEnergiaRecetaO int)
BEGIN
	select * from consumoenergiareceta where idConsumoEnergiaReceta=idConsumoEnergiaRecetaO;
END$$
DELIMITER ;


DROP procedure IF EXISTS `actualizar_consumoeneregiareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `actualizar_consumoeneregiareceta` (in idConsumoEnergiaRecetaA int,
										in idConsumoEnergiaA int,
                                        in idRecetaA int)
BEGIN
	update consumoenergiareceta set idConsumoEnergiaReceta=idConsumoEnergiaRecetaA,
									idConsumoEnergia=idConsumoEnergiaA,
									idReceta=idRecetaA
				where idConsumoEnergiaReceta=idConsumoEnergiaRecetaA;
END$$
DELIMITER ;

CALL actualizar_manodeobrareceta('5','2', '1');

DROP procedure IF EXISTS `eliminar_consumoenergiareceta`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `eliminar_consumoenergiareceta` (in idConsumoEnergiaRecetaE int)
BEGIN
	delete from consumoenergiareceta
    where idConsumoEnergiaReceta=idConsumoEnergiaRecetaE;
END$$
DELIMITER ;

DROP procedure IF EXISTS `mostrar_recetaconsumoenergiatotal`;

DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `mostrar_recetaconsumoenergiatotal` ()
BEGIN
select SUM(TRUNCATE(ce.pagoPorBatch,2)) as Costo
    from consumoenergiareceta cer inner join receta r on r.idReceta=cer.idReceta
					              inner join consumoenergia ce on ce.idConsumoEnergia=cer.idConsumoEnergia;
END$$
DELIMITER ;
























DELIMITER $$
USE `caticao`$$
create PROCEDURE `Mostrar_DatosGraficoBarra` ()
BEGIN
select idProducto, nombre, cantidad from producto;
END$$
DELIMITER ;

DELIMITER $$
USE `caticao`$$
create PROCEDURE `Mostrar_DatosGraficoHorizontal` ()
BEGIN
select idMateria, nombre, cantidad from materia;
END$$
DELIMITER ;


DELIMITER $$
USE `caticao`$$
create PROCEDURE `Mostrar_DatosGraficoPie` ()
BEGIN
select idMateria, nombre, cantidad from materia;
END$$
DELIMITER ;
use caticao;




DELIMITER $$
USE `caticao`$$
create PROCEDURE `Mostrar_DatosGraficodoughnut` ()
BEGIN

select rm.idmateria,r.descripcion,rm.cantidad 
from recetamateria rm inner join receta r on rm.idreceta=r.idreceta;
END$$
DELIMITER ;
use caticao;
