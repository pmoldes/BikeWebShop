DROP SCHEMA IF EXISTS DB_TIENDA;
CREATE SCHEMA IF NOT EXISTS DB_TIENDA DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
grant all privileges on DB_TIENDA.* to admin@localhost identified by "admin";
USE DB_TIENDA ;

-- -----------------------------------------------------
-- Table DB_TIENDA.usuarios
-- -----------------------------------------------------
DROP TABLE IF EXISTS DB_TIENDA.usuarios ;

CREATE TABLE IF NOT EXISTS DB_TIENDA.usuarios (
  us_id INT NOT NULL AUTO_INCREMENT,
  us_email VARCHAR(50) NULL,
  us_username VARCHAR(30) NULL,
  us_password VARCHAR(255) NULL,
  us_nombre VARCHAR(40) NULL,
  us_apellidos VARCHAR(100) NULL,
  us_direccion VARCHAR(100) NULL,
  us_codigo_postal VARCHAR(10) NULL,
  us_telefono VARCHAR(20) NULL,
  us_rol INT NULL,
  us_eliminado INT DEFAULT 0,
  PRIMARY KEY (us_id))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table DB_TIENDA.tiendas
-- -----------------------------------------------------
DROP TABLE IF EXISTS DB_TIENDA.tiendas ;

CREATE TABLE IF NOT EXISTS DB_TIENDA.tiendas (
  tienda_id INT NOT NULL AUTO_INCREMENT,
  tienda_nombre VARCHAR(45) NULL,
  tienda_direccion VARCHAR(100) NULL,
  tienda_email VARCHAR(50) NULL,
  tienda_telefono VARCHAR(20) NULL,
  fk_us_id INT NOT NULL,
  tienda_eliminado INT DEFAULT 0,
  PRIMARY KEY (tienda_id),
  INDEX fk_tiendas_usuarios1_idx (fk_us_id ASC),
  CONSTRAINT fk_tiendas_usuarios1
    FOREIGN KEY (fk_us_id)
    REFERENCES DB_TIENDA.usuarios (us_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table DB_TIENDA.producto
-- -----------------------------------------------------
DROP TABLE IF EXISTS DB_TIENDA.producto ;

CREATE TABLE IF NOT EXISTS DB_TIENDA.producto (
  producto_id INT NOT NULL AUTO_INCREMENT,
  producto_nombre VARCHAR(50) NULL,
  producto_modalidad VARCHAR(20) NULL COMMENT '	\n',
  producto_categoria VARCHAR(20) NULL,
  producto_descripcion VARCHAR(500) NULL,
  producto_precio FLOAT NULL,
  producto_cantidad INT NULL,
  producto_foto VARCHAR(200) NULL,
  producto_nuevo INT NULL,
  fk_us_id INT NOT NULL,
  producto_eliminado INT DEFAULT 0,
  PRIMARY KEY (producto_id),
  INDEX fk_producto_usuarios1_idx (fk_us_id ASC),
  CONSTRAINT fk_producto_usuarios1
  FOREIGN KEY (fk_us_id)
  REFERENCES DB_TIENDA.usuarios (us_id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table DB_TIENDA.comentarios
-- -----------------------------------------------------
DROP TABLE IF EXISTS DB_TIENDA.comentarios ;

CREATE TABLE IF NOT EXISTS DB_TIENDA.comentarios (
  comentario_id INT NOT NULL AUTO_INCREMENT,
  comentario_titulo VARCHAR(45) NULL,
  comentario_texto VARCHAR(500) NULL,
  comentario_autor VARCHAR(45) NULL,
  comentario_valoracion INT NULL,
  fk_producto_id INT NOT NULL,
  fk_us_id INT NOT NULL,
  comentario_eliminado INT DEFAULT 0,
  PRIMARY KEY (comentario_id),
  INDEX fk_comentarios_producto1_idx (fk_producto_id ASC),
  INDEX fk_comentarios_usuarios1_idx (fk_us_id ASC),
  CONSTRAINT fk_comentarios_producto1
    FOREIGN KEY (fk_producto_id)
    REFERENCES DB_TIENDA.producto (producto_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT fk_comentarios_usuarios1
  FOREIGN KEY (fk_us_id)
    REFERENCES DB_TIENDA.usuarios (us_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table DB_TIENDA.interes
-- -----------------------------------------------------
DROP TABLE IF EXISTS DB_TIENDA.interes ;

CREATE TABLE IF NOT EXISTS DB_TIENDA.interes (
  interes_id INT NOT NULL AUTO_INCREMENT,
  interes_precio FLOAT NULL,
  interes_fecha VARCHAR(9),
  fk_producto_id INT NOT NULL,
  fk_us_id_comprador INT NOT NULL,
  fk_us_id_vendedor INT NOT NULL,
  interes_eliminado INT DEFAULT 0,
  PRIMARY KEY (interes_id, fk_producto_id, fk_us_id_comprador, fk_us_id_vendedor),
  INDEX fk_Interes_producto1_idx (fk_producto_id ASC),
  INDEX fk_Interes_usuarios1_idx (fk_us_id_comprador ASC),
  INDEX fk_Interes_usuarios2_idx (fk_us_id_vendedor ASC),
  CONSTRAINT fk_producto_id
    FOREIGN KEY (fk_producto_id)
    REFERENCES DB_TIENDA.producto (producto_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_us_id_comprador
    FOREIGN KEY (fk_us_id_comprador)
    REFERENCES DB_TIENDA.usuarios (us_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_us_id_vendedor
    FOREIGN KEY (fk_us_id_vendedor)
    REFERENCES DB_TIENDA.usuarios (us_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
  )
ENGINE = InnoDB;


INSERT INTO DB_TIENDA.usuarios(us_id,us_email,us_username,us_password,us_nombre,us_apellidos,us_direccion,us_codigo_postal,us_telefono,us_rol)
  VALUES
    ('1','admin@admin.com','admin','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Administrador','Maximo','Administracion','00000','111222333','3'),
    ('2','tienda@tienda.com','tienda','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Carlos','Carlos','Ourense','00000','111222333','2'),
    ('3','tienducha@tienda.com','tienducha','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Jorge','Jorge','Vigo','00000','111222333','2'),
    ('4','user@user.com','user','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Tomas','Tomas','Lugo','00000','111222333','1'),
    ('5','random@hey.com','random','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Samuel','Samuel','Pontevedra','00000','111222333','1'),
    ('6','alejandro@kromoly.com','alex','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Alex','Alex','Santiago','00000','111222333','2'),
    ('7','javi@uourense.com','javi','$2y$10$0UQCDSRowRBnJXnOcS5QYeTjjo4xh8b/l6DTZZWZ35j4Bnacgk5/m','Oscar','Maximo','Coruña','00000','111222333','2');

INSERT INTO DB_TIENDA.tiendas(tienda_id, tienda_nombre, tienda_direccion, tienda_telefono, tienda_email, fk_us_id) 
VALUES 
    ('1','BiciTotal S.L.','Avenida Castelao 15, 36210, Vigo','934323243','info@bicitotal.es','2'),    
    ('2','VigoBike CO.','Carretera Camposantos, 23423, Porriño','698321223','info@vigobike.es','3'),    
    ('3','DadBikes S.A.','Otero Pedrayo 33, 34234, Ourense','932342345','info@dadbikes.es','7'),    
    ('4','Cromoly Distribution','Pi y Margall  115, 34232, Vigo','683832343','info@cromoly.es','6');
    
INSERT INTO DB_TIENDA.producto(producto_id, producto_nombre, producto_modalidad, producto_categoria,
                                  producto_descripcion, producto_precio, producto_cantidad, producto_foto, 
                                  producto_nuevo,fk_us_id) 
VALUES 

    ('1','Botas Alpine','Ropa','Calzado','Botas marca Alpine, diseñadas para ofecer la mayor comodidad en ciclismo de montaña','90','4','css/images/alpine.jpg','1','2'),
    ('2','Botas Alpine','Ropa','Calzado','Botas Alpine casi nuevas, unicamente 2 salidas. Vendo por falta de tiempo para salir en bici','50','1','css/images/alpine.jpg','0','4'),
    ('3','Guantes Fox','Ropa','Guantes','Guantes Fox tallas S,M,L y XL color unico. Ideales para cualquier tipo de ciclismo','20','10','css/images/foxgloves.jpg','1','3'),
    ('4','Rueda trasera Odyssey','BMX','Ruedas','Rueda trasera completa, llanta y buje Odyssey. 36 radios y piñon 10T. Perfecto estado y centrada','50','1','css/images/llantaamarilla.jpg','0','5'),
    ('5','Maillot','Ropa','Camisetas','Maillot generico, tallas M,L y XL. Comodo y fresco.','40','10','css/images/maillot.jpg','1','6'),
    ('6','Giant Rebel 3','Montaña','Bicicletas','Bicicleta Giant Rebel 3. Ideal para iniciarse en el mundo del BTT, componentes SHIMANO','399','5','css/images/revel3.jpg','1','6'),
    ('7','Giant Rebel 3','Montaña','Bicicletas','Bicicleta Giant Rebel 3. Buena bicleta para la practica del ciclismo de montaña, si estas pensando en iniciarte en este mundo esta es tu bicicleta.','379','4','css/images/revel3.jpg','1','2'),
    ('8','Sillin WTP','BMX','Sillines','Sillin We The People para BMX, anclaje pivotal. El sillin tiene uso pero no tiene la tela no tiene roturas.','20','1','css/images/sillin.jpg','0','5'),
    ('9','Manillar CULT Chase Hawk','BMX','Manillares','Manillar CULT modelo Chase Hawk, Altura 8,5 pulgadas, Peso 500gr','65','5','css/images/bars-black.jpg','1','3'),
    ('10','Manillar CULT Chase Hawk','BMX','Manillares','Manillar Cult Chase Hawk, 1 año de uso, rascazos propios del uso.','30','1','css/images/bars-black.jpg','0','4'),
    ('11','Tronchacadenas Super B','Mecanica','Herramientas','Tronchacadenas para cualquier tipo de cadena','10','14','css/images/SUPER_B_TRONCHACADENAS.jpg','1','7'),
    ('12','Bomba Zefal Air','Mecanica','Bombas','Bomba compacta ideal para llevar en la mochila','17','10','css/images/zefal_air.png','1','7'),
    ('13','Cubierta Michelin City','Fixed','Cubiertas','Cubierta Michelin para ciudad. Muy resistente. 26 pulgadas','20','6','css/images/michelin_city.jpg','1','7'),
    ('14','Pedales de plastico CULT','Fixed','Pedales','Pedales de plastico Cult Varios Colores, muy ligeros','20','10','css/images/cult_plastic_pedals.jpg','1','6'),
    ('15','Pedales de plastico CULT','Fixed','Pedales','Pedales Cult, varios colores. De plastico pero muy resistentes y ligeros.','18','7','css/images/cult_plastic_pedals.jpg','1','2'),
    ('16','Puños Odyssey Aaron Ross','BMX','Puños','Puños Odyssey by Aaron Ross','9','10','css/images/aaron_ross_grips.gif','1','2');


INSERT INTO DB_TIENDA.comentarios(comentario_id, comentario_titulo, comentario_texto, 
                          comentario_autor, comentario_valoracion, fk_producto_id, fk_us_id) 
VALUES 
  ('1','Muy recomendado','Me encantaron los pedales, van perfectos, son muy ligeros pero tambien resistentes, recomiendo su comopra sin dudarlo.','Tomas','5','14','4'),
  ('2','Buen producto','Buenos pedales, lo malo es que es cuanto se desgastan no agarran mucho, pero por el precio estan bien.','Samuel','4','14','5'),
  ('3','Cumple lo que promete','Esta bien, funciona y los materiales son decentes, podria ser algo mas pequeño','Samuel','5','12','5');


