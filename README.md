
1. create MySQL database name: database_name

2. add database table , you can use below sql and modiy the table name  

CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `date_added` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

3. configure the database at config.php

4. access index.php