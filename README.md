# Laravel Splitwise App

This repo is functionality not complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker).

Clone the repository

    git clone https://github.com/noufal3696/splitwise.git

Switch to the repo folder

    cd splitwise

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/noufal3696/splitwise.git
    cd splitwise
    composer install
    cp .env.example .env
    php artisan key:generate

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeds/DummyDataSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

## Splitwise app

More information regarding the project can be found here https://github.com/gothinkster/realworld

----------
## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.
----------

# Testing API

Run the laravel development server

    php artisan serve

The application can now be accessed at

    http://localhost:8000

----------

# Cross-Origin Resource Sharing (CORS)

This applications has CORS enabled by default on all API endpoints. The default configuration allows requests from `http://localhost:3000` and `http://localhost:4200` to help speed up your frontend testing. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.

- https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
- https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
- https://www.w3.org/TR/cors
