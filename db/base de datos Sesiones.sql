CREATE Table Usuario
(Id serial Primary key,
Usuario varchar(15) not null,
Contrasena varchar(12) not null,
Email varchar(30) not null,
TipoUsuario varchar(15) not null
);
INSERT INTO `Usuario` (`Id`, `Usuario`, `Contrasena`, `Email`, `TipoUsuario`) VALUES (NULL, 'test', 'test', 'asdasd@asd', 'admin');
INSERT INTO `Usuario` (`Id`, `Usuario`, `Contrasena`, `Email`, `TipoUsuario`) VALUES (NULL, 'test2', 'asd', 'asdasd@asd', 'user');

Create Table Factura
(Id serial Primary key,
Tipo varchar(2) not null,
FormaPago varchar(50) not null,
Persona varchar(50) not null, /*id de persona */
NroComprobante int not null,
Fecha date not null,
Iva float not null,
Descuento float not null,
Direccion varchar(50) not null
);

INSERT INTO `Factura` (`Id`, `Tipo`, `FormaPago`, `Persona`, `NroComprobante`,`fecha`,`Iva`,`Descuento`,`Direccion`) VALUES (NULL, 'A', 'Contado', '1', '1', '2017/08/30', '3', '0', 'local comercial');

Create Table Producto
(Id serial Primary key,
Stock int not null,
NombreProducto varchar(200) not null,
CostoProducto float(8,2) not null
);

INSERT INTO `Producto` (`Id`, `Stock`, `NombreProducto`, `CostoProducto`) VALUES (NULL, '10', 'Coca', '10.23');

Create Table Persona
(Id serial Primary key,
TipoPersona int not null, /*1 cliente 2 prove*/
Nombre varchar(70) not null,
Telefono int not null,
Direccion varchar(100) not null,
Cuit int not null
);

INSERT INTO `Persona` (`Id`, `TipoPersona`, `Nombre`, `Telefono`, `Direccion`, `Cuit`) VALUES(NULL, '1', 'Fulanito S.A', '3752504440', 'alguna calle 123', '30707039902');

CREATE TABLE DetalleFactura
(Id serial Primary key,
NroComprobante int not null,
IdProducto int not null,
Cantidad int not null,
Precio float(8,2) not null
);

INSERT INTO `DetalleFactura` (`Id`, `NroComprobante`, `IdProducto`, `Cantidad`, `Precio`) VALUES(NULL, '1', '1', '2', '23.5');
