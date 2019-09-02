CREATE DATABASE db_digital; -- CRIAR BANCO DE DADOS
USE db_digital; -- USAR BANCO DE DADOS

-- Criando Tabela com 6 colunas
CREATE TABLE tb_contact ( 
	id INT PRIMARY KEY AUTO_INCREMENT,
    c_name VARCHAR(255) NOT NULL,
    c_email VARCHAR(255) NOT NULL,
    c_subject VARCHAR(255),
    c_message TEXT,
    c_date_register DATETIME DEFAULT NOW() -- Definindo data registro como padrão hora atual.
);