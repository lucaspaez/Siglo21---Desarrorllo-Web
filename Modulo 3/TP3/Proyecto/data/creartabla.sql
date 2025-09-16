CREATE DATABASE proyecto;

USE proyecto;

CREATE TABLE plantas (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  especie VARCHAR(40) NOT NULL,
  genetica VARCHAR(40) NOT NULL,
  etapa VARCHAR(40) NOT NULL,
  cultivo VARCHAR(40) NOT NULL,
  observaciones VARCHAR(255) NOT NULL
);
