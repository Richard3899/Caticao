-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema caticao
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema caticao
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `caticao` DEFAULT CHARACTER SET latin1 ;
USE `caticao` ;

-- -----------------------------------------------------
-- Table `caticao`.`almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`almacen` (
  `idAlmacen` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idAlmacen`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`costos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`costos` (
  `idCostos` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idCostos`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipogastos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipogastos` (
  `idTipoGastos` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoGastos`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`gastos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`gastos` (
  `idGastos` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `idTipoGastos` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idGastos`),
  CONSTRAINT `gastos_ibfk_1`
    FOREIGN KEY (`idTipoGastos`)
    REFERENCES `caticao`.`tipogastos` (`idTipoGastos`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`gastosmateria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`gastosmateria` (
  `idGastosMateria` INT(11) NOT NULL AUTO_INCREMENT,
  `precioUnitario` DECIMAL(18,2) NULL DEFAULT NULL,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `idGastos` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idGastosMateria`),
  CONSTRAINT `gastosmateria_ibfk_1`
    FOREIGN KEY (`idGastos`)
    REFERENCES `caticao`.`gastos` (`idGastos`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`servicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`servicios` (
  `idServicios` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idServicios`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`gastosservicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`gastosservicios` (
  `idGastosServicios` INT(11) NOT NULL AUTO_INCREMENT,
  `idGastos` INT(11) NULL DEFAULT NULL,
  `idServicios` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idGastosServicios`),
  CONSTRAINT `gastosservicios_ibfk_1`
    FOREIGN KEY (`idServicios`)
    REFERENCES `caticao`.`servicios` (`idServicios`),
  CONSTRAINT `gastosservicios_ibfk_2`
    FOREIGN KEY (`idGastos`)
    REFERENCES `caticao`.`gastos` (`idGastos`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`lote` (
  `idLote` INT(11) NOT NULL AUTO_INCREMENT,
  `numeroLote` INT(11) NULL DEFAULT NULL,
  `codigo` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idLote`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`marca` (
  `idMarca` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idMarca`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipomateria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipomateria` (
  `idTipoMateria` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoMateria`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipomedida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipomedida` (
  `idTipoMedida` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoMedida`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`unidadmedida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`unidadmedida` (
  `idUnidadMedida` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `idTipoMedida` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idUnidadMedida`),
  CONSTRAINT `unidadmedida_ibfk_1`
    FOREIGN KEY (`idTipoMedida`)
    REFERENCES `caticao`.`tipomedida` (`idTipoMedida`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`materia` (
  `idMateria` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `idTipoMateria` INT(11) NULL DEFAULT NULL,
  `idUnidadMedida` INT(11) NULL DEFAULT NULL,
  `idMarca` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idMateria`),
  CONSTRAINT `materia_ibfk_1`
    FOREIGN KEY (`idMarca`)
    REFERENCES `caticao`.`marca` (`idMarca`),
  CONSTRAINT `materia_ibfk_2`
    FOREIGN KEY (`idTipoMateria`)
    REFERENCES `caticao`.`tipomateria` (`idTipoMateria`),
  CONSTRAINT `materia_ibfk_3`
    FOREIGN KEY (`idUnidadMedida`)
    REFERENCES `caticao`.`unidadmedida` (`idUnidadMedida`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipocostos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipocostos` (
  `idTipoCostos` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoCostos`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`materiacostos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`materiacostos` (
  `idMateriaCostos` INT(11) NOT NULL AUTO_INCREMENT,
  `precioUnitario` DECIMAL(18,2) NULL DEFAULT NULL,
  `idCostos` INT(11) NULL DEFAULT NULL,
  `idMateria` INT(11) NULL DEFAULT NULL,
  `idTipoCostos` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idMateriaCostos`),
  CONSTRAINT `materiacostos_ibfk_1`
    FOREIGN KEY (`idTipoCostos`)
    REFERENCES `caticao`.`tipocostos` (`idTipoCostos`),
  CONSTRAINT `materiacostos_ibfk_2`
    FOREIGN KEY (`idCostos`)
    REFERENCES `caticao`.`costos` (`idCostos`),
  CONSTRAINT `materiacostos_ibfk_3`
    FOREIGN KEY (`idMateria`)
    REFERENCES `caticao`.`materia` (`idMateria`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipomovimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipomovimiento` (
  `idTipoMovimiento` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoMovimiento`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`movimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`movimiento` (
  `idMovimiento` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  `fecha` DATETIME NULL DEFAULT NULL,
  `idTipoMovimiento` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idMovimiento`),
  CONSTRAINT `movimiento_ibfk_1`
    FOREIGN KEY (`idTipoMovimiento`)
    REFERENCES `caticao`.`tipomovimiento` (`idTipoMovimiento`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`movimientomateria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`movimientomateria` (
  `idMovimientoMateria` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `idMovimiento` INT(11) NULL DEFAULT NULL,
  `idMateria` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idMovimientoMateria`),
  CONSTRAINT `movimientomateria_ibfk_1`
    FOREIGN KEY (`idMovimiento`)
    REFERENCES `caticao`.`movimiento` (`idMovimiento`),
  CONSTRAINT `movimientomateria_ibfk_2`
    FOREIGN KEY (`idMateria`)
    REFERENCES `caticao`.`materia` (`idMateria`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipoproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipoproducto` (
  `idTipoProducto` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoProducto`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`receta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`receta` (
  `idReceta` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `idMateria` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idReceta`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`producto` (
  `idProducto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(80) NULL DEFAULT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `precio` DECIMAL(18,2) NULL DEFAULT NULL,
  `idTipoProducto` INT(11) NULL DEFAULT NULL,
  `idAlmacen` INT(11) NULL DEFAULT NULL,
  `idReceta` INT(11) NULL DEFAULT NULL,
  `idLote` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idProducto`),
  CONSTRAINT `producto_ibfk_1`
    FOREIGN KEY (`idTipoProducto`)
    REFERENCES `caticao`.`tipoproducto` (`idTipoProducto`),
  CONSTRAINT `producto_ibfk_2`
    FOREIGN KEY (`idAlmacen`)
    REFERENCES `caticao`.`almacen` (`idAlmacen`),
  CONSTRAINT `producto_ibfk_3`
    FOREIGN KEY (`idLote`)
    REFERENCES `caticao`.`lote` (`idLote`),
  CONSTRAINT `producto_ibfk_4`
    FOREIGN KEY (`idReceta`)
    REFERENCES `caticao`.`receta` (`idReceta`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`movimientoproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`movimientoproducto` (
  `idMovimientoProducto` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `numeroMovimiento` INT(11) NULL DEFAULT NULL,
  `valorUnitario` DECIMAL(18,2) NULL DEFAULT NULL,
  `idProducto` INT(11) NULL DEFAULT NULL,
  `idMovimiento` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idMovimientoProducto`),
  CONSTRAINT `movimientoproducto_ibfk_1`
    FOREIGN KEY (`idProducto`)
    REFERENCES `caticao`.`producto` (`idProducto`),
  CONSTRAINT `movimientoproducto_ibfk_2`
    FOREIGN KEY (`idMovimiento`)
    REFERENCES `caticao`.`movimiento` (`idMovimiento`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipodocumento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipodocumento` (
  `idTipoDocumento` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoDocumento`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipoproveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipoproveedor` (
  `idTipoProveedor` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoProveedor`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`proveedor` (
  `idProveedor` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  `correo` VARCHAR(45) NULL DEFAULT NULL,
  `tipoDocumento` INT(11) NULL DEFAULT NULL,
  `idTipoProveedor` INT(11) NULL DEFAULT NULL,
  `idtipoDocumento` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idProveedor`),
  CONSTRAINT `proveedor_ibfk_1`
    FOREIGN KEY (`idTipoProveedor`)
    REFERENCES `caticao`.`tipoproveedor` (`idTipoProveedor`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`persona` (
  `idPersona` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `apellido` VARCHAR(45) NULL DEFAULT NULL,
  `tipoPersona` VARCHAR(45) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  `telefono` INT(11) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `tipoDocumento` INT(11) NULL DEFAULT NULL,
  `idTipoDocumento` INT(11) NULL DEFAULT NULL,
  `idProveedor` INT(11) NULL DEFAULT NULL,
  `idUnidadMedida` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idPersona`),
  CONSTRAINT `persona_ibfk_1`
    FOREIGN KEY (`idTipoDocumento`)
    REFERENCES `caticao`.`tipodocumento` (`idTipoDocumento`),
  CONSTRAINT `persona_ibfk_2`
    FOREIGN KEY (`idProveedor`)
    REFERENCES `caticao`.`proveedor` (`idProveedor`),
  CONSTRAINT `persona_ibfk_3`
    FOREIGN KEY (`idUnidadMedida`)
    REFERENCES `caticao`.`unidadmedida` (`idUnidadMedida`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`tipoproceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`tipoproceso` (
  `idTipoProceso` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoProceso`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`proceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`proceso` (
  `idProceso` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `idTipoProceso` INT(11) NULL DEFAULT NULL,
  `idUnidadMedida` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idProceso`),
  CONSTRAINT `proceso_ibfk_1`
    FOREIGN KEY (`idTipoProceso`)
    REFERENCES `caticao`.`tipoproceso` (`idTipoProceso`),
  CONSTRAINT `proceso_ibfk_2`
    FOREIGN KEY (`idUnidadMedida`)
    REFERENCES `caticao`.`unidadmedida` (`idUnidadMedida`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`recetamateria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`recetamateria` (
  `idReceta_Materia` INT(11) NOT NULL AUTO_INCREMENT,
  `Cantidad` DECIMAL(10,2) NULL DEFAULT NULL,
  `idMateria` INT(11) NULL DEFAULT NULL,
  `idReceta` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idReceta_Materia`),
  CONSTRAINT `recetamateria_ibfk_1`
    FOREIGN KEY (`idMateria`)
    REFERENCES `caticao`.`materia` (`idMateria`),
  CONSTRAINT `recetamateria_ibfk_2`
    FOREIGN KEY (`idReceta`)
    REFERENCES `caticao`.`receta` (`idReceta`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `caticao`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `caticao`.`usuario` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NULL DEFAULT NULL,
  `contraseña` VARCHAR(45) NULL DEFAULT NULL,
  `idPersona` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  CONSTRAINT `usuario_ibfk_1`
    FOREIGN KEY (`idPersona`)
    REFERENCES `caticao`.`persona` (`idPersona`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
