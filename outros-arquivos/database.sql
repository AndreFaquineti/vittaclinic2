mysql.exe -u root -p
use dbvittaclinic;

CREATE TABLE tabela_administradores (
    Email varchar(255),
    Senha varchar(255)
);
CREATE TABLE tabela_medicos (
    Email varchar(255),
    Senha varchar(255)
);

CREATE TABLE tabela_pacientes (
    Email varchar(255),
    Senha varchar(255)
);
INSERT INTO tabela_administradores (Email, Senha)
VALUES ('administrador@vt.com', '123');
INSERT INTO tabela_medicos (Email, Senha)
VALUES ('medico@vt.com', '123');
INSERT INTO tabela_pacientes (Email, Senha)
VALUES ('paciente@vt.com', '123');