CREATE DATABASE restapiusers;

#CHARACTER SET utf8 COLLATE utf8_general_ci;

USE restapiusers;

CREATE TABLE users(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
						       first_name VARCHAR(100) NOT NULL,
						       last_name VARCHAR(100) NOT NULL,
                   phone_number VARCHAR(20) NOT NULL,
                   time_created DATETIME NOT NULL)ENGINE = InnoDB;
