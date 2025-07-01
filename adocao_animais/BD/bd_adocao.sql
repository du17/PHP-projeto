-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS bd_adocao;
USE bd_adocao;

-- Tabela de animais
CREATE TABLE animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(50),
    idade INT,
    sexo ENUM('M', 'F') NOT NULL,
    descricao TEXT,
    status ENUM('disponivel', 'adotado') DEFAULT 'disponivel',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de adotantes
CREATE TABLE adotantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de adoções
CREATE TABLE adocoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    adotante_id INT NOT NULL,
    data_adocao DATE NOT NULL,
    observacoes TEXT,
    FOREIGN KEY (animal_id) REFERENCES animais(id),
    FOREIGN KEY (adotante_id) REFERENCES adotantes(id)
);

-- Inserção de dados de exemplo
INSERT INTO animais (nome, especie, raca, idade, sexo, descricao) VALUES
('Rex', 'Cão', 'Labrador', 3, 'M', 'Cão muito dócil e brincalhão'),
('Mimi', 'Gato', 'Siamês', 2, 'F', 'Gata carinhosa e independente'),
('Bolt', 'Cão', 'Pastor Alemão', 5, 'M', 'Cão protetor e leal');

INSERT INTO adotantes (nome, email, telefone, endereco, cpf) VALUES
('João Silva', 'joao@email.com', '(11) 99999-9999', 'Rua A, 123', '123.456.789-00'),
('Maria Santos', 'maria@email.com', '(11) 88888-8888', 'Rua B, 456', '987.654.321-00');
