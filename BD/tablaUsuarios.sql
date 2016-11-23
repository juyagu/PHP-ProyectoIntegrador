create table usuarios 
(
id_usuario  int not null primary key auto_increment,
email varchar(50),
nombre varchar(50),
apellido varchar(50),
pass varchar(250),
perfil int default 2,
habilitado int default 0
);