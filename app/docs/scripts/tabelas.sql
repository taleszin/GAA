
CREATE DATABASE IF NOT EXISTS demo;
USE demo;
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    curso VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('aluno', 'professor', 'coordenador') NOT NULL
);
CREATE TABLE Coordenadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
);
CREATE TABLE Alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    curso VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
);
CREATE TABLE Professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    departamento VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
);
CREATE TABLE Eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    data_evento DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    vagas INT NOT NULL,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES Professores(id) ON DELETE CASCADE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Inscritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    evento_id INT,
    data_inscrito TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    presenca BOOLEAN DEFAULT FALSE,
    feedback TEXT,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (evento_id) REFERENCES Eventos(id) ON DELETE CASCADE
);
CREATE TABLE Certificados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    evento_id INT,
    pdf VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (evento_id) REFERENCES Eventos(id) ON DELETE CASCADE
);
CREATE TABLE Notificacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email_destinatario VARCHAR(255),
    mensagem TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
