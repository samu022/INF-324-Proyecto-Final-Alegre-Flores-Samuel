CREATE TABLE textura(
    nombre VARCHAR(20),
    r integer,
    g integer,
    b integer
);

-- - Cambiar nombre_textura_1 por nombre_textura_2 en la pantalla

CREATE TABLE cambio(
    nombre_textura_1 VARCHAR(20),
    nombre_textura_2 VARCHAR(20)
);

CREATE TABLE cambio_rgb(
    r1 integer,
    g1 integer,
    b1 integer,
    r2 integer,
    g2 integer,
    b2 integer
);