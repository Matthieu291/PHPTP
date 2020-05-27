CREATE TABLE user (
    id INTEGER,
    login VARCHAR (20),
    password VARCHAR(20),
    mail VARCHAR (20),
    nom VARCHAR(20),
    prenom VARCHAR (20),
    PRIMARY KEY (id)
);
CREATE TABLE student (
    id INTEGER,
    userid INTEGER,
    nom VARCHAR(20),
    prenom VARCHAR (20),
    note FLOAT,
    PRIMARY KEY (id)
);