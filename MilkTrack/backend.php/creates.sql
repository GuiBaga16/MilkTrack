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
  nome VARCHAR(255) NOT NULL,
  cidade VARCHAR(255) NOT NULL,
  telefone VARCHAR(20) NOT NULL
);