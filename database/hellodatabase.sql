/*create and select the database*/
DROP DATABASE IF EXISTS hellodatabase;
CREATE DATABASE hellodatabase;
USE hellodatabase;

/*------------------------------------------------------------------------------- 
-----------------------------CREATE TABLES------------------------------------- 
-------------------------------------------------------------------------------*/ 

/*create table for year  */
DROP TABLE IF EXISTS years;

CREATE TABLE years 
( year_id INT UNSIGNED PRIMARY KEY
, year_number INT UNSIGNED NOT NULL
);

/*create table for months */ 
DROP TABLE IF EXISTS months;

CREATE TABLE months 
( month_id INT UNSIGNED PRIMARY KEY
, month_name VARCHAR(12) NOT NULL
);

/*create table for roles */
DROP TABLE IF EXISTS roles;

CREATE TABLE roles
( role_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
, role_name VARCHAR(30) NOT NULL
);

/*create table for users*/
DROP TABLE IF EXISTS users;

CREATE TABLE users
( user_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
, username VARCHAR(50) NOT NULL
, email VARCHAR(128) NOT NULL
, passwordhash VARCHAR(128) NOT NULL
, role_id INT UNSIGNED NOT NULL
, CONSTRAINT uk_user UNIQUE (username,email)
, CONSTRAINT fk1_user FOREIGN KEY(role_id) REFERENCES roles(role_id)
);

/*create table for posts*/
DROP TABLE IF EXISTS post;

CREATE TABLE post 
( post_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
, year_id INT UNSIGNED NOT NULL
, month_id INT UNSIGNED NOT NULL
, user_id INT UNSIGNED NOT NULL
, post_date DATE NOT NULL
, post_title VARCHAR(255) NOT NULL
, post_content TEXT NOT NULL 
, CONSTRAINT fk1_post FOREIGN KEY(year_id) REFERENCES years(year_id)
, CONSTRAINT fk2_post FOREIGN KEY(month_id) REFERENCES months(month_id)
, CONSTRAINT fk3_post FOREIGN KEY(user_id) REFERENCES users(user_id)
); 

/*create comments table*/
DROP TABLE IF EXISTS comments;

CREATE TABLE comments
( comment_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
, user_id INT UNSIGNED NOT NULL
, post_id INT UNSIGNED NOT NULL
, comment_content TEXT
, post_date DATE NOT NULL
);
/*, CONSTRAINT fk1_comments FOREIGN KEY(user_id) REFERENCES users(user_id)
, CONSTRAINT fk2_comments FOREIGN KEY(post_id) REFERENCES posts(post_id)*/
 

/*-------------------------------------------------------------------------------
-----------------------------SEED DATA INTO TABLES-----------------------------
-------------------------------------------------------------------------------*/

/*insert into years*/
INSERT INTO years 
( year_id
, year_number) 
VALUES
( '1'
, '2014'),
( '2'
, '2015')
;

/*inset into months*/
INSERT INTO months
( month_id
, month_name)
VALUES
( '1'
, 'January'),
( '2'
, 'February'),
( '3'
, 'March'),
( '4'
, 'April'),
( '5'
, 'May'),
( '6'
, 'June'),
( '7'
, 'July'),
( '8'
, 'August'),
( '9'
, 'September'),
( '10'
, 'October'),
( '11'
, 'November'),
( '12'
, 'Decemeber');

/*insert into roles*/
INSERT INTO roles
( role_id
, role_name)
VALUES
( '1'
, 'Admin'),
( '2'
, 'User');

/*insert into users*/
INSERT INTO users
( user_id
, username
, email
, passwordhash
, role_id)
VALUES
( NULL
, 'testadmin'
, 'fake@email.com'
, 'pashashplaceholder'
, '1');

/*insert dummy posts*/
INSERT INTO post
( post_id
, year_id
, month_id
, user_id
, post_date
, post_title
, post_content)
VALUES
( NULL
, '1'
, '12'
, '1'
, '2014-12-14'
, 'Test Post One'
, 'Content for this test post'),
( NULL
, '2'
, '1'
, '1'
, '2015-01-14'
, 'Test Post Two'
, 'Content for this test post'),
( NULL
, '2'
, '1'
, '1'
, '2015-01-18'
, 'Test Post Three'
, 'Content for this test post'),
( NULL
, '2'
, '2'
, '1'
, '2014-02-04'
, 'Test Post Four'
, 'Content for this test post');