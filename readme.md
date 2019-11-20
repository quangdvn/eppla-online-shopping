<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About this project

This is the 2nd Project I work on building an E-Commerce platform, this time is with Laravel

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. I believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects

Laravel Docs: https://laravel.com/docs


## Get start with this project

To keep up with my Project, after cloning to your local machine, please read and follow these steps throughly :

#### Step 0: Use your own Command Line, cd to project folder

#### Step 1: Install Composer Dependencies in composer.json

    composer install
    
#### Step 2: Install NPM Dependencies in package.json

    npm install
    
#### Step 3: Create a copy of your .env file

A Laravel Project need an .env file, which is not provided after cloning my project (of course)

Create your own .env file and fill in required field to get this project run

    cp .env.example .env
    
#### Step 4: Generate an app encryption key

Laravel requires you to have an app encryption key which is generally randomly generated and stored in your .env file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more

    php artisan key:generate
    
Now check the .env file again, you will see that it now has a long random string of characters in the APP_KEY field. We now have a valid app encryption key

#### Step 5: Add database information to allow Laravel to connect to the database
    
Fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options in .env file which matches the credentials of the database you just created. This will allow you to run migrations and seed the database in the next step

#### Step 6 (Optional): Set up your own Voyager

Voyager is a packet to create Admin dashboard for your app. Here I use Voyager to create a Site for Admin and Seller to manage (CRUD) their own Products

I have already attach Voyager package in composer.json, to start with Voyager, run: 
    
    php artisan voyager:install --with-dummy (To create some dummy data for Admin Site)

You can't keep up with my setting for Voyager, since its not allowed to push up Voyager setting on Github,
So you have to do it on your own :((

PS: I have updated the repo, pls read Step 8 to continue with my Voyager data setting

Feel free to read Voyager docs here: https://voyager-docs.devdojo.com

#### Step 7: Create your own database

I 've already prepared some seed files for a new MySQL Database in 'database' folder

Please see all 3 folders: Migration, Factory and Seed and run these:

    php artisan migrate
    php artisan db:seed
    php artisan serve
    
#### Step 8 (Optional): Set up data for Voyager

I 've created a new Artisan command to seed data for the Voyager database

    php artisan eppla:install

#### Step 9: Set up Stripe Payment

My project uses Stripe (for now) as the main method for customers to check out order

Feel free to contact me to be provided with STRIPE_KEY and STRIPE_SECRET
    
#### Now you have completed starting up my project, just dive in and enjoy yourself !!!
    
## For contributors

Feel free to contribute to my project since its still very basic though

Remember to create new branch and pull request if u want to develop this site !!!
   
## Enjoy this project :))



