create database if not exists bd_adocao;

USE bd_adocao;

CREATE TABLE animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    idade INT NOT NULL,
    descricao TEXT
);

CREATE TABLE adotantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);

CREATE TABLE adocoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_animal INT,
    id_adotante INT,
    data_adocao DATE,
    FOREIGN KEY (id_animal) REFERENCES animais(id),
    FOREIGN KEY (id_adotante) REFERENCES adotantes(id)
);