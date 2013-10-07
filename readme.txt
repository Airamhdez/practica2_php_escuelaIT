- He añadido un campo checkbox en la página de editar por si el usuario quiere conservar la anterior foto
  ya que no puedo establecer el campo value del input file foto desde código.

- La página listado le envía por get el valor del id a las demás páginas aunque se que no se debe hacer así,
  por como lo palanteo el profesor no sabía como hacerlo sin get y sin usar javascript.


- Esta es la estructura de la tabla noticia que he usado:
	create table noticia(
	id int(10) not null auto_increment,
	titulo varchar(50) not null,
	detalle mediumtext not null,
	fecha date not null,
	foto varchar(50) default null,
	primary key (id));

- Hay que crear una carpeta vacía dentro del directorio del proyecto que se llame images