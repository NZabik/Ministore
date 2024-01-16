# Evaluation-2024

- [Evaluation-2024](#evaluation-2024)
  - [GITHUB copy](#github-copy)
  - [Site](#site)
    - [Languages used](#languages-used)
    - [Site Details](#site-details)
      - [1. Home page](#1-home-page)
      - [2. Registration page](#2-registration-page)
      - [3. Login page](#3-login-page)
      - [4. Product page](#4-product-page)
      - [5. Cart page](#5-cart-page)
      - [6. Shipment page](#6-shipment-page)
      - [7. Order validation page](#7-order-validation-page)
      - [8. account information](#8-account-information)
      - [9. header](#9-header)
      - [10. Admin panel](#10-admin-panel)

## GITHUB copy
If you want to clone this repository in your GITHUB account, you can do it in your GIT terminal.

Simply do a ```git clone https://github.com/NZabik/Evaluation-2024.git```
and run a "composer install" command in the clone directory.

## Site

### Languages used
- PHP (symfony)
- CSS
- Bootstrap
- Javascript
- Twig

### Site Details

#### 1. Home page

The home page is dynamicaly created with the database products, the differents categories are shown automaticaly with the differents products inside:
![Alt text](<Capture d'écran 2024-01-16 113301.png>)
You can add to cart the desired quantity of each item if they are in stock from the home page:
![Alt text](<Capture d'écran 2024-01-16 113643.png>)
You can shop directly from the diffrents links on the page.

#### 2. Registration page

The registration page allows you to create an account

#### 3. Login page

The login page allows you to log into your account

#### 4. Product page

This page display the products and their availability:
![Alt text](<Capture d'écran 2024-01-16 113923.png>)
and view the details and add to cart with the desired quantity:
![Alt text](<Capture d'écran 2024-01-16 114015.png>)
On the shop page, you can view a filter to filter your view.

#### 5. Cart page

The cart page allows the possibility to modify the desired quantity, return to shop, delete the products or validate the cart to go to the shipment page:
![Alt text](<Capture d'écran 2024-01-16 114305.png>)

#### 6. Shipment page

The sipment page allows you to select your personal adress, a favorite adress if it exists, select a relay, or type manually another adress.
You can either add the adress you want to favorite and validate the cart:
![Alt text](<Capture d'écran 2024-01-16 111806.png>)

#### 7. Order validation page

The order validation page display the order resume and allows you validate or not the order, return to the cart or to the shipment page:
![Alt text](<Capture d'écran 2024-01-16 115018.png>)

#### 8. account information

You can access your account informations, from the header.
Here you can edit your credentials, view your orders, log out and delete your account.
![Alt text](<Capture d'écran 2024-01-16 115819.png>)
![Alt text](<Capture d'écran 2024-01-16 115913.png>)

#### 9. header

![Alt text](<Capture d'écran 2024-01-16 115951.png>)

You can search any products with a fragment of it's name in the search bar.

The header can be modified with the admin panel

#### 10. Admin panel

![Alt text](<Capture d'écran 2024-01-16 131138.png>)

The admin panel allows the admin to view:
- the users
- all the orders from the users

to add, edit, delete:
- the products
- the categories
- the website logo
- the navbar buttons
 ![Alt text](<Capture d'écran 2024-01-16 131423.png>)
 

