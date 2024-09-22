CREATE DATABASE IF NOT EXISTS inventario_web;

CREATE TABLE IF NOT EXISTS producto (
    idProd INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL CHECK (precio >= 0),
    existencia INT NOT NULL DEFAULT 0,
    PRIMARY KEY (idProd)
);

//Registros de prueba
INSERT INTO producto (nombre, precio, existencia) VALUES 
('Gato de Juguete', 15.99, 10),
('Rascador de Gatos', 25.50, 5),
('Comida para Gatos', 20.00, 50);

//PL para obtener productos//
DELIMITER //

CREATE PROCEDURE ObtenerProductos()
BEGIN
    SELECT * FROM producto;
END //

DELIMITER ;

//Ejecutar PL//
CALL ObtenerProductos();

//PL para insertar productos//
DELIMITER //

CREATE PROCEDURE InsertarProducto(
    IN p_nombre VARCHAR(100),
    IN p_precio DECIMAL(10,2),
    IN p_existencia INT
)
BEGIN
    IF p_precio < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El precio no puede ser negativo';
    ELSE
        INSERT INTO producto (nombre, precio, existencia) 
        VALUES (p_nombre, p_precio, p_existencia);
    END IF;
END //

DELIMITER ;

//Ejecutar PL//
CALL InsertarProducto('Gato de Juguete', 15.99, 10);

//PL para eliminar productos//
DELIMITER //

CREATE PROCEDURE EliminarProducto(IN p_idProd INT)
BEGIN
    DECLARE num_rows INT;

    SELECT COUNT(*) INTO num_rows FROM producto WHERE idProd = p_idProd;

    IF num_rows = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El producto no existe';
    ELSE
        DELETE FROM producto WHERE idProd = p_idProd;
    END IF;
END //

DELIMITER ;

//Ejecutar PL//
CALL EliminarProducto(1);
