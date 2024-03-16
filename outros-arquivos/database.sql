mysql.exe -u root -p
use dbvittaclinic;

CREATE TABLE tabela_usuarios (
    email varchar(255) NOT NULL UNIQUE,
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

/*Banco de dados com mais informações (abandonado 16/03/24 por aumentar demais a complexidade de outros sistemas)*/
CREATE TABLE tabela_usuarios (
    cpf varchar(11) NOT NULL UNIQUE,
    nome varchar(255) NOT NULL,
    cep varchar(8) NOT NULL,
    numero_endereco varchar(8) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    senha varchar(255) NOT NULL,
    tipo varchar(15) NOT NULL,
    PRIMARY KEY (cpf)
);

INSERT INTO tabela_usuarios (cpf, nome, cep, numero_endereco, email, senha, tipo)
VALUES ('10000000000', 'admin', '00000000', '00', 'administrador@vt.com', '123', 'administrador');
INSERT INTO tabela_usuarios (cpf, nome, cep, numero_endereco, email, senha, tipo)
VALUES ('20000000000', 'medico', '00000000', '00','medico@vt.com', '123', 'medico');
INSERT INTO tabela_usuarios (cpf, nome, cep, numero_endereco, email, senha, tipo)
VALUES ('30000000000', 'paciente', '00000000', '00','paciente@vt.com', '123', 'paciente');