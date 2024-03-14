mysql.exe -u root -p
use dbvittaclinic;

CREATE TABLE tabela_usuarios (
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    tipo varchar(15) NOT NULL,
    PRIMARY KEY (email)
);

INSERT INTO tabela_usuarios (email, senha, tipo)
VALUES ('administrador@vt.com', '123', 'administrador');
INSERT INTO tabela_usuarios (email, senha, tipo)
VALUES ('medico@vt.com', '123', 'medico');
INSERT INTO tabela_usuarios (email, senha, tipo)
VALUES ('paciente@vt.com', '123', 'paciente');

/*Comandos uteis*/
SELECT * FROM tabela_usuarios;
SELECT * FROM tabela_usuarios WHERE tipo='administrador';
SELECT * FROM tabela_usuarios WHERE tipo='medico';
SELECT * FROM tabela_usuarios WHERE tipo='paciente';
DELETE FROM tabela_usuarios;