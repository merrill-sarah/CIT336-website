/*create and select the database*/
/*DROP DATABASE IF EXISTS hellodatabase;
CREATE DATABASE hellodatabase;
USE hellodatabase;*/

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
, 'admin@test.com'
, '8ad7bc81f6bd1ecb8d1cadba420645e1b342e02c'
, '1'),
( NULL
, 'testuser'
, 'user@test.com'
, '7961533e4ed63ea4e4e395da2d0ff53f1a2a0801'
, '2');

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
, 'Yet Again, Another Difficult Night'
, '<p>I''m laying here in bed.</p><p>I''m trying to get adjusted so that I can comfortably sleep, but I am confronted with an obstacle. I''m squished over to the corner of my pillow. No matter where I try to place my head, there is never enough room. Twig has taken a liking to sleeping directly in the center of my pillow. My neck has to be kinked in some weird position in order to not disturb her slumber.</p><p>I know technically I can move her, but I just don''t have the heart to push her away. She uses her adorableness to take advantage of the soft spot in my heart. If I try and get her to move in the slightest, instead she''ll just move down to my feet.</p><p>So far away. So distant. How can I live with that separation?</p><p>It''s a constant battle between wanting to sleep comfortably and wanting Twig''s affection. One side will result in me waking up with neck pain, the other will result in heartbreak as Twig leaves me. For weeks I have struggled with this conflict as I retire to my bed for the night.</p><p>I can hear Twig''s innocent little breaths as she enjoys the beauty of a nice sleep. She is lit up by the dim glow of my computer screen. Her legs are outstretched across the pillow. Her face has an expression of gentle bliss. Her cute little face, how can I disturb her while she is in this state? It would be cruel to interrupt the pleasant dream she must be having.</p><p>Such a dilemma. Should I sacrifice my own comfort for Twig?</p><p>I try to readjust. There must be some way I can work around her and still be able to be comfortable myself. I shift positions. I move to the other corner of the pillow to see if there is any more room over there. There isn''t. I move back to the first corner with some false hope that space magically grew while I was spending time on the other side. Sadly, there is still the exact amount of space as there was previously.</p><p>I look at Twig again.</p><p>I take a deep breath. As I exhale, I release the hope that both Twig and I can have enough room on this pillow.</p><p>I roll over and resign myself to my uncomfortable corner. I can''t do it. I can''t disturb her. I''ll just live with another night of neck pain. A fate I face every night.'),
( NULL
, '2'
, '2'
, '1'
, '2015-02-07'
, 'Sincere Apologies'
, 'Today I watch 10 hours straight of My Love From Another Star. This is what I call a productive start to my weekend. Now, Kim Soohyun, I love you. I''m sorry I disliked you so much for so long just because your character ended up with Suzy in Dream High and I was rooting for Taecyeon. I am finally going to move on.'),
( NULL
, '2'
, '3'
, '1'
, '2015-03-30'
, 'Creepin on Miss A'
, '<p>I have no idea why the members of Miss A are dancing for this guy creeping on them instead of running away and calling the police, but I am loving this song. Already listening to it on repeat along with the rest of the album.<br /><iframe src="https://www.youtube.com/embed/zO9RzrhYR-I"></iframe>');