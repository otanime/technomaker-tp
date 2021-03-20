INSERT INTO restau_idrissi.city (id, name, zip_code) VALUES (1, 'Marrakech', '40014');
INSERT INTO restau_idrissi.city (id, name, zip_code) VALUES (2, 'Rabat', '50001');
INSERT INTO restau_idrissi.city (id, name, zip_code) VALUES (3, 'Casablanca', '25000');
INSERT INTO restau_idrissi.city (id, name, zip_code) VALUES (4, 'Tanger', '12000');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (1, 4, 'Restaurant 01', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 15:32:00');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (2, 2, 'Restaurant 02', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 16:32:00');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (3, 1, 'Restaurant 03', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 17:32:00');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (4, 2, 'Restaurant 04', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 18:32:00');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (5, 4, 'Restaurant 05', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 20:32:00');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (6, 2, 'Restaurant 06', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 23:32:00');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (7, 1, 'Restaurant 07', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 21:32:01');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (8, 1, 'Restaurant 08', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 15:32:01');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (9, 3, 'Restaurant 09', 'jkbazjkdzkjdf zjkfbzejkbfzkj', '2021-03-19 15:32:01');
INSERT INTO restau_idrissi.restaurant (id, city_id_id, name, description, created_at) VALUES (10, 3, 'Restaurant 10', 'klndzkndzandzalk', '2021-03-20 16:03:02');
INSERT INTO restau_idrissi.user (id, city_id_id, username, password) VALUES (1, 1, 'Dome', 'nezdjeznd');
INSERT INTO restau_idrissi.user (id, city_id_id, username, password) VALUES (2, 2, 'Alex', 'zklndazlkndaz');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (3, 1, 2, 'ekjfnezjkbfezjk', 5, '2021-03-20 12:19:37');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (4, 1, 2, 'kjezbfkzjbfz', 2, '2021-03-20 15:52:23');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (5, 2, 2, 'dzkjbfkjazbdakjzb', 3, '2021-03-20 15:52:35');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (6, 2, 1, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (7, 2, 1, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (8, 2, 1, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (9, 1, 5, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (10, 2, 2, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (11, 1, 3, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (12, 2, 1, 'dkjezkjazbdkjazbdazkbd', 5, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (13, 1, 1, 'dkjezkjazbdkjazbdazkbd', 5, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (14, 2, 3, 'dkjezkjazbdkjazbdazkbd', 1, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (15, 2, 4, 'dkjezkjazbdkjazbdazkbd', 2, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (16, 2, 4, 'dkjezkjazbdkjazbdazkbd', 5, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (17, 1, 5, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (18, 2, 1, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (19, 1, 3, 'dkjezkjazbdkjazbdazkbd', 3, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (20, 2, 1, 'dkjezkjazbdkjazbdazkbd', 5, '2021-03-20 15:52:31');
INSERT INTO restau_idrissi.review (id, user_id_id, restaurant_id_id, message, rating, created_at) VALUES (21, 1, 1, 'dkjezkjazbdkjazbdazkbd', 5, '2021-03-20 15:52:31');