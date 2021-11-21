
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
ce.consumoKwh,ce.tarifaKwh,ce.pagoPorBatch
	from ConsumoEnergia ce  inner join  maquina m on m.idMaquina= ce.idMaquina;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_consumoenergia`;
DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_consumoenergia` (in tarifaKwhI decimal(10,2),
											 in idMaquinaI int)
                                        
BEGIN
	insert into consumoenergia (potenciaHP,potenciawatts,potenciaKw,horasTrabajoBatch,consumoKwh,tarifaKwh,pagoPorBatch,idMaquina)
			values (1,potenciaHP*745,potenciawatts/1000,0.40,potenciaKw*horasTrabajoBatch,tarifaKwhI,consumoKwh*tarifaKwhI,idMaquinaI);
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
                                        in tarifaKwhA decimal(10,2))
BEGIN
	update consumoenergia set idConsumoEnergia=idConsumoEnergiaA,
						tarifaKwh=tarifaKwhA,
                        pagoPorBatch=consumoKwh*tarifaKwhA
				where idConsumoEnergia=idConsumoEnergiaA;
END$$

DELIMITER ;


update consumoenergia set idConsumoEnergia=1,
						tarifaKwh=1
				where idConsumoEnergia=1;

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
	   d.tiempoDeUso,d.depreciacionPorBatch
	from depreciacion d  inner join  maquina m on m.idMaquina= d.idMaquina;
END$$
DELIMITER ;


DROP procedure IF EXISTS `insertar_depreciacion`;
DELIMITER $$
USE `caticao`$$
CREATE PROCEDURE `insertar_depreciacion` (   in importeI decimal(10,2),
											 in vidaUtilI int,
                                             in idMaquinaI int)
                                        
BEGIN
	insert into depreciacion (importe,vidaUtil,depreciacionAnual,depreciacionMensual,depreciacionHora,
                                tiempoDeUso,depreciacionPorBatch,idMaquina)
			values (importeI,vidaUtilI,importeI/vidaUtilI,depreciacionAnual/12,depreciacionMensual/(25*24),
                    0.4,depreciacionHora*tiempoDeUso,idMaquinaI);
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
                                        in vidaUtilA int)
BEGIN
	update depreciacion set idDepreciacion=idDepreciacionA,
						importe=importeA,
                        vidaUtil=vidaUtilA,
                        depreciacionAnual=importeA/vidaUtilA,
                        depreciacionMensual=depreciacionAnual/12,
                        depreciacionHora=depreciacionMensual/(25*24),
                        depreciacionPorBatch=depreciacionHora*tiempoDeUso
				where idDepreciacion=idDepreciacionA;
END$$

DELIMITER ;


update depreciacion set idDepreciacion=6,
						importe=1,
                        vidaUtil=1,
                        depreciacionAnual=1,
                        depreciacionMensual=1,
                        depreciacionHora=1,
                        depreciacionPorBatch=1
				where idDepreciacion=6;

select * from depreciacion;

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

CALL actualizar_maquina('3','Molienda','Sirve para moler los granos de cacao');
                                    
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









-- Procedimientos almacenados de Mano de Obra  ----------------------------------------------------------------------------

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

DELIMITER $$
USE `caticao`$$
create PROCEDURE `Mostrar_DatosGraficoBarra` ()
BEGIN
select idProducto, nombre, cantidad from producto;
END$$
DELIMITER ;




