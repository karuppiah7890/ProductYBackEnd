create table login(
	id INT NOT NULL AUTO_INCREMENT,
	phno VARCHAR(20) NOT NULL,
	password VARCHAR(32) NOT NULL,
	type VARCHAR(15) NOT NULL,
	PRIMARY KEY(id,phno)
);

create table customer(
	id INT NOT NULL,
	firstname VARCHAR(50) NOT NULL,
	lastname VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL UNIQUE,
	validation VARCHAR(10) NOT NULL
);


