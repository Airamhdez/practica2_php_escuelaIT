- He a�adido un campo checkbox en la p�gina de editar por si el usuario quiere conservar la anterior foto
  ya que no puedo establecer el campo value del input file foto desde c�digo.

- La p�gina listado le env�a por get el valor del id a las dem�s p�ginas aunque se que no se debe hacer as�,
  por como lo palanteo el profesor no sab�a como hacerlo sin get y sin usar javascript.


- Esta es la estructura de la tabla noticia que he usado:
	create table noticia(
	id int(10) not null auto_increment,
	titulo varchar(50) not null,
	detalle mediumtext not null,
	fecha date not null,
	foto varchar(50) default null,
	primary key (id));

- Hay que crear una carpeta vac�a dentro del directorio del proyecto que se llame images