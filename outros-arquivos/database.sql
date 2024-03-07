mysql.exe -u root -p
use dbvittaclinic;

CREATE TABLE tabela_administradores (
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    tipo varchar(15) NOT NULL,
    PRIMARY KEY (email)
);
CREATE TABLE tabela_medicos (
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    tipo varchar(15) NOT NULL,
    PRIMARY KEY (email)
);

CREATE TABLE tabela_pacientes (
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    tipo varchar(15) NOT NULL,
    PRIMARY KEY (email)
);
INSERT INTO tabela_administradores (email, senha, tipo)
VALUES ('administrador@vt.com', '123', 'administrador');
INSERT INTO tabela_medicos (email, senha, tipo)
VALUES ('medico@vt.com', '123', 'medico');
INSERT INTO tabela_pacientes (email, senha, tipo)
VALUES ('paciente@vt.com', '123', 'paciente');