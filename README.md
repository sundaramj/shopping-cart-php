# shopping-cart-php
Basic shopping cart in PHP.

## Requirements
PHP, Mysql, Yii Framework 1.1

## Database
Please Import db_changes.sql file from PHPMyAdmin or some other tool, After that please change database credentials in protected/config/database.php file   

## Types of Login: 
#### Admin &amp; User
CMS - Admin Login
1. Add categories - games, movies, electronics
2. Add products
- title
- select a category
- description
- image
- price
3. List of orders - order listing page

#### Front-end
1. User registration - name, address, email, mobile no, password
2. User login
3. List of products
4. Allow user to add products to cart
5. Display cart to add/ remove products
6. Checkout - Cash on Delivery. (order completed)

## Information
- Created two modules in Yii framework one for admin & other one for front end user. So both user are generating different session.
- Please load Yii framework, I have not committed because of framework large size.