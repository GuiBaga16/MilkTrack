CREATE TABLE leites (
  id SERIAL PRIMARY KEY,
  quantidade VARCHAR(255) NOT NULL,
  data_coleta DATE NOT NULL,
  qualidade VARCHAR(50) NOT NULL
);

CREATE TABLE vacas (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  raca CHAR(50) NOT NULL,
  data_nascimento DATE NOT NULL
);

CREATE TABLE produtores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    cep VARCHAR(9),
    rua VARCHAR(150),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    uf VARCHAR(2)
);