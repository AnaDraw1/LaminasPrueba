/*CREATE TABLE album (id INTEGER PRIMARY KEY , artist varchar(100) NOT NULL, title varchar(100) NOT NULL);
INSERT INTO album (artist, title) VALUES ('The Military Wives', 'In My Dreams');
INSERT INTO album (artist, title) VALUES ('Adele', '21');
INSERT INTO album (artist, title) VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)');
INSERT INTO album (artist, title) VALUES ('Lana Del Rey', 'Born To Die');
INSERT INTO album (artist, title) VALUES ('Gotye', 'Making Mirrors');*/



CREATE TABLE Usuario (id INTEGER PRIMARY KEY , User varchar(100) NOT NULL, Email varchar(100) NOT NULL, Contra  varchar(100) NOT NULL  );
INSERT INTO Usuario (USer, Email, Contra) VALUES ('Ana González', 'gonzalezjimenez.anamaria@utacapulco.edu.mx','123456');
INSERT INTO Usuario (User, Email, Contra) VALUES ('Nelson', 'pollito123@gmail.com','123456');


CREATE TABLE Usuarios (id INTEGER PRIMARY KEY , Usuario varchar(100) NOT NULL, Email varchar(100) NOT NULL, Contra  varchar(100) NOT NULL  );
INSERT INTO Usuarios (Usuario, Email, Contra) VALUES ('Ana González', 'gonzalezjimenez.anamaria@utacapulco.edu.mx','123456');
INSERT INTO Usuarios (Usuario, Email, Contra) VALUES ('Nelson', 'pollito123@gmail.com','123456');


