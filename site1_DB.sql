CREATE DATABASE IF NOT EXISTS site1;
USE site1;

-- Таблиця компаній
CREATE TABLE kompanii (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nazva VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefon VARCHAR(20)
);

-- Таблиця сайтів
CREATE TABLE saiti (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nazva VARCHAR(100) NOT NULL,
    opis TEXT,
    tsina DECIMAL(10,2) NOT NULL,
    dostupnyi BOOLEAN DEFAULT TRUE
);

-- Таблиця покупок
CREATE TABLE pokupki (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kompaniia_id INT NOT NULL,
    sait_id INT NOT NULL,
    data_pokupky DATE NOT NULL,
    tsina_na_moment DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (kompaniia_id) REFERENCES kompanii(id),
    FOREIGN KEY (sait_id) REFERENCES saiti(id)
);

-- Таблиця користувачів
CREATE TABLE IF NOT EXISTS korystuvachi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    kompaniia_id INT,
    FOREIGN KEY (kompaniia_id) REFERENCES kompanii(id)
);

-- Вставка даних у таблицю компаній
INSERT INTO kompanii (id, nazva, email, telefon) VALUES
(1, 'Kompaniia 1', 'info@komp1.com', '123456789'),
(2, 'Kompaniia 2', 'info@komp2.com', '987654321');

-- Вставка даних у таблицю користувачів
INSERT INTO korystuvachi (login, password, role, kompaniia_id) 
VALUES
('admin', '12012007', 'admin', NULL),
('user1', '2007', 'user', 1),
('user2', '1201', 'user', 2);

-- Вставка даних у таблицю сайтів
INSERT INTO saiti (nazva, opis, tsina, dostupnyi) 
VALUES
('Landing Page Pro', 'Сучасний лендинг для малого бізнесу', 5000.00, TRUE),
('E-commerce Starter', 'Магазин на 100 товарів', 15000.00, TRUE),
('Корпоративний сайт', 'Презентація компанії з блогом', 10000.00, TRUE);

-- Вставка даних у таблицю покупок
INSERT INTO pokupki (kompaniia_id, sait_id, data_pokupky, tsina_na_moment) 
VALUES
(1, 1, '2025-05-01', 5000.00),
(2, 3, '2025-05-05', 10000.00);

-- Перевірка таблиць
SELECT * FROM kompanii;
SELECT * FROM korystuvachi;
SELECT * FROM saiti;
SELECT * FROM pokupki;