CREATE TABLE cargo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
);

CREATE TABLE turno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    periodo VARCHAR(100) NOT NULL,
    horario_inicio TIME NOT NULL,
    horario_fim TIME NOT NULL,
);

CREATE TABLE funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('adm', 'user') NOT NULL,
    telefone VARCHAR(15),
    cargo_id INT NOT NULL,
    turno_id INT NOT NULL,
    FOREIGN KEY (cargo_id) REFERENCES cargo(id),
    FOREIGN KEY (turno_id) REFERENCES turno(id),
);

CREATE TABLE batida_ponto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_id INT NOT NULL,
    data DATE NOT NULL ,
    horario TIME NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    FOREIGN KEY (funcionario_id) REFERENCES funcionario(id)
);

