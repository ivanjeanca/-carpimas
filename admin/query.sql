drop tablespace cliente engine='InnoDB';

create table clientes (id_cliente int auto_increment primary key not null, nombre varchar(100), apaterno varchar(100), amaterno varchar(100), correo varchar(150), contrasena varchar(32), direccion varchar(100), codigo_postal int(5), id_ciudad int references ciudad(id_ciudad), id_estado int REFERENCES estado(id_estado) , id_pais int REFERENCES pais(id_pais), telefono varchar(15), celular varchar(15), tarjeta int(12), fecha_expiracion date, num_seguridad int(3));


select * from envio;
INSERT into envio (id_envio, envio) values (2, 'Paquetería terrestre');
delete from envio where id_envio = 0;

show tables;

describe tipo_pago;

ventas:
folio
id usuario
fecha
id_tipo_pago
id_ciudad
id_envio
direccion
numero ext
numero int

describe venta;

select * from venta; 
select folio from venta where id_usuario = 2 order by folio desc limit 1;


select * from tipo_producto;
select * from producto;

select tipo_prod from tipo_producto where id_tipo_prod = (select id_tipo_prod from producto where id_producto = 7)

transaccion:
folio
id_producto
tipo_prod
id_color
id_material
cubierta
herrajes
largo
ancho
alto
precio

describe usuario;
describe venta;
describe transaccion;
describe tipo_pago;
describe envio;

describe estado

describe envio;

select concat(u.nombre, ' ', u.apellido) as nombre, v.folio, v.fecha, ti.tipo_pago, c.ciudad, e.estado, p.pais, en.envio, v.direccion, v.numero_ext, v.numero_int, t.id_producto, tp.tipo_prod, co.color, ma.material, t.cubierta, t.herrajes, t.largo, t.ancho, t.alto, t.precio from venta v
join usuario u on v.id_usuario = u.id_usuario
join tipo_pago ti on v.id_tipo_pago = ti.id_tipo_pago
join ciudades c on v.id_ciudad = c.id_ciudad
join estado e on c.id_estado = e.id_estado
join pais p on e.id_pais = p.id_pais
join envio en on v.id_envio = en.id_envio
join transaccion t on v.folio = t.folio
join tipo_producto tp on t.id_tipo_prod = tp.id_tipo_prod
join color co on t.id_color = co.id_color
join material ma on t.id_material = ma.id_material
where v.folio = 13
order by t.no_producto asc;

select * from usuario;

select * from ciudades;

select * from rol_usuario;

select * from rol;

show tables;

select u.id_usuario, concat(u.nombre, ' ', u.apellido) as nombre, u.correo, r.rol from usuario u
join rol_usuario ru on u.id_usuario = ru.id_usuario
join rol r on ru.id_rol = r.id_rol

delete rol_usuario where id_usuario = 10


select * from producto;

insert into usuario (nombre, apellido, correo, contrasena) values ('Postman', 'Postman', 'Postman@Postman.com', md5(1))

insert into rol_usuario (id_rol, id_usuario) values (2, 11)

describe transaccion;
describe venta;
describe usuario;