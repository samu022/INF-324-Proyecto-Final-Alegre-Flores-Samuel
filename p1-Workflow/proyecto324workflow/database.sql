drop database workflowproyecto;
create database workflowproyecto;
use workflowproyecto;

create table flujo
(
    flujo varchar(3),
    proceso varchar(3),
    proceso_siguiente varchar(3),
    tipo varchar(1),
    rol varchar(15),
    pantalla varchar(30)
);

create table flujocondicional
(
    codFlujo varchar(3),
    codProceso varchar(3),
    codProcesoSi varchar(3),
    codProcesoNo varchar(3)
);

create table flujousuario
(
    numerotramite int,
    flujo varchar(3),
    proceso varchar(3),
    fecha_inicio datetime,
    fecha_fin datetime,
    usuario varchar(20)
);

-- - Para el primer flujo
INSERT INTO flujo
    VALUES('F1', 'P1', 'P2', 'I', 'empleado', 'ini_proceso_solic');

INSERT INTO flujo
    VALUES('F1', 'P2', 'P3', 'P', 'empleado', 'lista_productos');

INSERT INTO flujo
    VALUES('F1', 'P3', NULL, 'C', 'empleado', 'verificar_exstencia_producto');

INSERT INTO flujo
    VALUES('F1', 'P4', 'P5', 'P', 'empleado', 'llenado_formulario_producto');

INSERT INTO flujo
    VALUES('F1', 'P5', NULL, 'C', 'administrador', 'aprueba_pedido');

INSERT INTO flujo
    VALUES('F1', 'P6', 'P2', 'P', 'empleado', 'notificacion_error');

INSERT INTO flujo
    VALUES('F1', 'P7', 'P8', 'P', 'proveedor', 'recibe_pedido');

INSERT INTO flujo
    VALUES('F1', 'P8', NULL, 'C', 'proveedor', 'verifica_stock');

INSERT INTO flujo
    VALUES('F1', 'P9', 'P10', 'P', 'proveedor', 'alista_pedido');

INSERT INTO flujo
    VALUES('F1', 'P10', 'P11', 'P', 'empleado', 'recibe_pedido_e');

INSERT INTO flujo
    VALUES('F1', 'P11', 'P12', 'P', 'empleado', 'registra_pedido');

INSERT INTO flujo
    VALUES('F1', 'P12', NULL, 'F', 'administrador', 'recibe_notificacion');

INSERT INTO flujocondicional
    VALUES('F1', 'P3', 'P2', 'P4');

INSERT INTO flujocondicional
    VALUES('F1', 'P5', 'P7', 'P6');

INSERT INTO flujocondicional
    VALUES('F1', 'P8', 'P9', 'P6');

-- - Para el segundo flujo

INSERT INTO flujo
    VALUES('F2', 'P1', 'P2', 'I', 'cliente', 'ini_proceso_cliente');

INSERT INTO flujo
    VALUES('F2', 'P2', 'P3', 'P', 'cliente', 'observa_catalogo');

INSERT INTO flujo
    VALUES('F2', 'P3', 'P4', 'P', 'cliente', 'formulario_compra');

INSERT INTO flujo
    VALUES('F2', 'P4', NULL, 'C', 'empleado', 'verifica_existencia');

INSERT INTO flujo
    VALUES('F2', 'P5', 'P2', 'P', 'cliente', 'reporte_cliente');

INSERT INTO flujo
    VALUES('F2', 'P6', 'P7', 'P', 'empleado', 'registra_venta');

INSERT INTO flujo
    VALUES('F2', 'P7', 'P8', 'P', 'empleado', 'actualiza_inv');

INSERT INTO flujo
    VALUES('F2', 'P8', NULL, 'F', 'cliente', 'confirma_compra');


INSERT INTO flujocondicional
    VALUES('F2', 'P4', 'P6', 'P5');

-- **********************************************************************************
-- **********************************************************************************
-- **********************************************************************************
-- **********************************************************************************
-- INICIALIZADORES
INSERT INTO flujousuario
    VALUES (100, 'F1', 'P1', '2023/06/02 11:00', '2023/06/02 11:15', 'cjahuitas');

INSERT INTO flujousuario
    VALUES (101, 'F1', 'P2', '2023/06/02 11:00', Null, 'cjahuitas');

INSERT INTO flujousuario
    VALUES (102, 'F1', 'P7', '2023/06/02 11:00', Null, 'carlosmg');
INSERT INTO flujousuario
    VALUES (103, 'F1', 'P7', '2023/06/02 11:00', Null, 'djcq30');
-- **********************************************************************************
-- **********************************************************************************
-- **********************************************************************************
-- **********************************************************************************

create database tienda324;
use tienda324;
CREATE TABLE usuario(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    apellido_paterno VARCHAR(255) NOT NULL,
    apellido_materno VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, username, password, rol) VALUES
    ("Juan", "Legua", "Pérez", "jlegua", MD5("password123"), "administrador"),
    ("Diego", "Cruz", "Quintana", "djcq301", MD5("password123"), "proveedor"),
    ("Carlos", "Jahuita", "Sánchez", "cjahuitas", MD5("password123"), "cliente"),
    ("María", "Delgado", "Barrera", "mariadb", MD5("password123"), "cliente"),
    ("Sofía", "Cruz", "Ramírez", "sofiacr", MD5("password123"), "cliente"),
    ("Luis", "González", "Pérez", "luisgp", MD5("password123"), "empleado"),
    ("Ana", "Hernández", "López", "anahl", MD5("password123"), "empleado"),
    ("Pedro", "Sánchez", "Ramírez", "pedrosr", MD5("password123"), "empleado"),
    ("Carlos", "Martínez", "Gómez", "carlosmg", MD5("password123"), "proveedor");


CREATE TABLE Productos (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    categoria VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    marca VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO Productos (nombre, categoria, precio, stock, marca) VALUES
    ("Leche", "Lácteos", 2.50, 100, "Marca 1"),
    ("Pan", "Panadería", 1.00, 200, "Marca 2"),
    ("Arroz", "Granos", 3.50, 150, "Marca 3"),
    ("Aceite de Oliva", "Aceites y Vinagres", 5.75, 50, "Marca 4"),
    ("Jabón de Baño", "Higiene Personal", 2.25, 80, "Marca 5"),
    ("Cereal", "Desayuno", 4.20, 120, "Marca 6");

/*-----------------------*/
CREATE TABLE EmpleadoAdministrador (
    codTramite int,
    idProducto int,
    cantidad int,
    empleado VARCHAR(255)
);

CREATE TABLE APEmpleado (
    codTramite int,
    usuario VARCHAR(255),
    explicacion TEXT
);

CREATE TABLE Venta (
    codTramite int,
    usuario VARCHAR(255),
    empleado VARCHAR(255),
    idProducto int,
    cantidad int,
    precio_unitario DECIMAL(10, 2),
    fecha date 
);