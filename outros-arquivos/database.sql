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

/*Tabela de cada médico*/
CREATE TABLE `tabela_horarios_$email_medico` (
    horario datetime NOT NULL UNIQUE,
    email_paciente varchar(255) NOT NULL,
    FOREIGN KEY (email_paciente) REFERENCES tabela_usuarios(email),
    PRIMARY KEY (horario)
);
INSERT INTO `tabela_horarios_medico@vt.com` (horario, email_paciente) VALUES ('2024-05-22 15:20:00', 'paciente@vt.com');

/*Tabela de horarios padrão*/
CREATE TABLE `tabela_horarios_padrao` (
    horario datetime NOT NULL UNIQUE,
    PRIMARY KEY (horario)
);
INSERT INTO `tabela_horarios_padrao` (horario) VALUES 
    ('2000-01-01 09:00:00'),
    ('2000-01-01 09:20:00'),
    ('2000-01-01 09:40:00'),
    ('2000-01-01 10:00:00'),
    ('2000-01-01 10:20:00'),
    ('2000-01-01 10:40:00'),
    ('2000-01-01 11:00:00'),
    ('2000-01-01 11:20:00'),
    ('2000-01-01 11:40:00'),
    ('2000-01-01 13:00:00'),
    ('2000-01-01 13:20:00'),
    ('2000-01-01 13:40:00'),
    ('2000-01-01 14:00:00'),
    ('2000-01-01 14:20:00'),
    ('2000-01-01 14:40:00'),
    ('2000-01-01 15:00:00'),
    ('2000-01-01 15:20:00'),
    ('2000-01-01 15:40:00'),
    ('2000-01-01 16:00:00'),
    ('2000-01-01 16:20:00'),
    ('2000-01-01 16:40:00'),
    ('2000-01-01 17:00:00'),
    ('2000-01-01 17:20:00'),
    ('2000-01-01 17:40:00');

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
VALUES ('12000200000', 'admin', '20002000', '00', 'administrador@vt.com', '123', 'administrador');
INSERT INTO tabela_usuarios (cpf, nome, cep, numero_endereco, email, senha, tipo)
VALUES ('22000200000', 'medico', '20002000', '00','medico@vt.com', '123', 'medico');
INSERT INTO tabela_usuarios (cpf, nome, cep, numero_endereco, email, senha, tipo)
VALUES ('32000200000', 'paciente', '20002000', '00','paciente@vt.com', '123', 'paciente');