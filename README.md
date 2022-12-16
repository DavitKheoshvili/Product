#### This is PHP/React example project 

visit: http://157.230.125.117:3000/
Try add products or delete them.

---
#### Add project on local machine
1. Make sure you have installed docker on your machine
2. Make sure you have installed composer
3. Make sure you have installed node
4. Make sure you have installed npm
5. Clone project:
``` git clone git@github.com:DavitKheoshvili/Product.git ```
6. Navigate to docker folder through terminal: 
``` cd Project/docker ```
7. Enter following comand to start containers: 
``` docker compose up -d ```
8. Navigate to php folder and update composer:
``` cd .. ```,
``` cd src ```,
``` composer update ```
9. Navigate to react/app folder root and install npm:
``` cd .. ```,
``` cd react/app ```,
``` npm install ```
10. Once it is finished, open phpmyadmin by typing localhost:8080 in your browser.
11. Create database 'products' and tables: products, book, dvd, furniture.
12. Change axios request url to localhost in following files:
Project/react/app/src/App.js
Project/react/app/src/pages/AddProduct.js
Project/react/app/src/pages/ProductList.js



