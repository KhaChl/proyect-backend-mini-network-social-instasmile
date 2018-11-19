CREATE DATABASE IF NOT EXISTS instagram_copy;
USE instagram_copy;

CREATE TABLE IF NOT EXISTS users(
    id int(255) auto_increment not null,
    role VARCHAR(20),
    name VARCHAR(100),
    surname VARCHAR(200),
    nick VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    image_path VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    remember_token VARCHAR(255),
    CONSTRAINT pk_users PRIMARY KEY(id)

)ENGINE=InnoDb;

INSERT INTO users VALUES (NULL, 'user', 'Kevin', 'Pizarro', 'Kha', 'kpizarro.m@outlook.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

INSERT INTO users VALUES (NULL, 'user', 'Jeremy', 'Pizarro', 'Alexander', 'jpizarro.m@outlook.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

INSERT INTO users VALUES (NULL, 'user', 'Gabriel', 'Pizarro', 'Kaled', 'gpizarro.m@outlook.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

CREATE TABLE IF NOT EXISTS images(
    id int(255) auto_increment not null,
    user_id int(255),
    image_path VARCHAR(255),
    description text,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)

)ENGINE=InnoDb;

INSERT INTO images VALUE (NULL, 1, 'test.jpg', 'descripcion de prueba', CURTIME(), CURTIME());

INSERT INTO images VALUE (NULL, 1, 'test2.jpg', 'descripcion de prueba 2', CURTIME(), CURTIME());

INSERT INTO images VALUE (NULL, 1, 'test3.jpg', 'descripcion de prueba 3', CURTIME(), CURTIME());

INSERT INTO images VALUE (NULL, 3, 'jungla.jpg', 'descripcion de prueba', CURTIME(), CURTIME());

INSERT INTO images VALUE (NULL, 3, 'rio.jpg', 'descripcion de prueba', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id int(255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    content text,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)

)ENGINE=InnoDb;

INSERT INTO comments VALUE (NULL, 1, 4, 'Comentario de prueba 1', CURTIME(), CURTIME());

INSERT INTO comments VALUE (NULL, 2, 1, 'Comentario de prueba 2', CURTIME(), CURTIME());

INSERT INTO comments VALUE (NULL, 2, 4, 'Comentario de prueba 3', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
    id int(255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)

)ENGINE=InnoDb;

INSERT INTO likes VALUE (NULL, 1, 4, CURTIME(), CURTIME());

INSERT INTO likes VALUE (NULL, 2, 4, CURTIME(), CURTIME());

INSERT INTO likes VALUE (NULL, 3, 1, CURTIME(), CURTIME());

INSERT INTO likes VALUE (NULL, 3, 2, CURTIME(), CURTIME());

INSERT INTO likes VALUE (NULL, 2, 1, CURTIME(), CURTIME());