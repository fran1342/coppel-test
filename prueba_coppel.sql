drop database if exists prueba_coppel_db;
create database prueba_coppel_db;
use prueba_coppel_db;

create table departamentos(
    departamento_id int auto_increment primary key,
    departamento_nombre varchar(50) not null,
);

insert into departamentos values(null,"Domesticos"),
(null,"Electronica"),
(null,"Mueble Suelto"),
(null,"Salas, Recamaras, Comedores");

create table clases(
    clase_id int auto_increment primary key,
    clase_nombre varchar(50) not null
    fk_departamento int,
    foreign key(fk_departamento) references departamentos(departamento_id)
);

insert into clases values(null,"Comestibles",1),
(null,"Licuadoras",1),
(null,"Batidoras",1),
(null,"Cafeteras",1),
(null,"Amplificadores Car audio",2),
(null,"Auto Stereos",2),
(null,"Colchon",3),
(null,"Juego Box",3),
(null,"Salas",4),
(null,"Complementos para sala",4),
(null,"Sofas Cama",4);

create table familias(
    familia_id int auto_increment primary key,
    familia_nombre varchar(50),
    fk_clase int,
    foreign key(fk_clase) references clases(clase_id)
);

insert into familias values(null,"Sin Nombre",1),
(null,"Licuadoras",2),
(null,"Exclusivo coppel com",2),
(null,"Batidora manual",3),
(null,"Procesador",3),
(null,"Picadora",3),
(null,"Batidora pedestal",3),
(null,"Batidora fuente de so",3),
(null,"Multipracticos",3),
(null,"Exclusicos coppel co",3),
(null,"Cafeteras",4),
(null,"Percoladoras",4),
(null,"Amplificador receptor",5),
(null,"Kit de instalacion",5),
(null,"Amplificadores coppel",5),
(null,"Autoestereo cd c/bo",6),
(null,"Accesorios car audio",6),
(null,"Amplificador",6),
(null,"Alarma auto/casa/oficina",6),
(null,"Sin mecanismo",6)
(null,"Con CD",6)
(null,"Multimedia",6),
(null,"Paquete sin mecanismo",6),
(null,"Paquete con CD",6),
(null,"Pillow top ks",7),
(null,"Pillow top doble ks",7),
(null,"Hule espuma ks",7),
(null,"Estandar individual",8),
(null,"Pillow top individual",8),
(null,"Pillow top doble individual",8),
(null,"Esquineras superiores",9),
(null,"Tipo L seccional",9),
(null,"Sillon ocasional",10),
(null,"Puff",10),
(null,"Baul",10),
(null,"Taburete",10),
(null,"Sofa cama tapizado",11),
(null,"Sofa cama clasico",11),
(null,"Estudio",11);

create table productos(
    producto_sku int(6) not null,
    producto_articulo varchar(15) not null,
    producto_marca varchar(15) not null,
    producto_modelo varchar(20) not null,
    producto_fecha_alta date not null,
    producto_fecha_baja date default '1900-01-01',
    producto_stock int(9),
    producto_cantidad int(9),
    producto_descontinuado int(1) not null default 0,
    
    fk_departamento int,
    fk_clase int,
    fk_familia int,
    foreign key(fk_departamento) references departamentos(departamento_id),
    foreign key(fk_clase) references clases(clase_id),
    foreign key(fk_familia) references familias(familia_id)
);

alter table productos add column producto_status enum("Activo","Inactivo") default "Activo";

DELIMITER //
create procedure seleccionar_producto(IN id_prod INT)
begin
    select producto_sku,producto_articulo,producto_marca, producto_modelo,productos.fk_departamento,departamentos.departamento_nombre,productos.fk_clase, producto_status, clases.clase_nombre, productos.fk_familia, familias.familia_nombre,producto_stock,producto_cantidad,producto_descontinuado,producto_fecha_alta,producto_fecha_baja FROM productos
    inner join departamentos on  productos.fk_departamento = departamentos.departamento_id
    inner join clases on productos.fk_clase = clases.clase_id
    inner join familias on productos.fk_familia = familias.familia_id
    where producto_sku = id_prod and producto_status = "Activo";
end //
DELIMITER ;
call seleccionar_producto(325432);

alter table productos modify producto_fecha_alta date; 