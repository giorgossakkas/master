CREATE TABLE users (
    id INT(11) AUTO_INCREMENT,
    user_name VARCHAR(256) NOT NULL,
    email VARCHAR(256),
    password VARCHAR(2048) NOT NULL,
    CONSTRAINT key1 PRIMARY KEY (id) )


CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT,
    user_id INT(11),
    name VARCHAR(256) NOT NULL,
    description VARCHAR(2048),
    status VARCHAR(32),
    CONSTRAINT key1 PRIMARY KEY (id) )


CREATE TABLE roles (
    id INT(11) AUTO_INCREMENT,
    name VARCHAR(256) NOT NULL,
    CONSTRAINT key1 PRIMARY KEY (id) )

CREATE TABLE permissions (
    id INT(11) AUTO_INCREMENT,
    role_id INT(11),
    type VARCHAR(256) NOT NULL,
    CONSTRAINT key1 PRIMARY KEY (id) )

ALTER TABLE users
ADD role_id INT(11)

ALTER TABLE users
ADD team_leader_id INT(11)

ALTER TABLE users
ADD is_team_leader INT(11)
