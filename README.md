# Timeline of African American Music<!-- omit in toc -->

This project is the CMS tailored for the Timeline of African American
Music by Carnegie Hall, built on [Twill](https://twill.io/). An open-source
[Laravel](https://laravel.com/docs/8.x) based CMS.

- [Live Site](https://timeline.carnegiehall.org/)
- [Front end code](https://github.com/CarnegieHall/timeline.carnegiehall.org)
- [Demo](https://demo.twill.io/)

<hr/>

## Table of Contents<!-- omit in toc -->

- [Release Notes](#release-notes)
- [Requirements](#requirements)
  - [Frontend assets](#frontend-assets)
  - [Database](#database)
- [Installation](#installation)
  - [Clone the project](#clone-the-project)
  - [Install top-level NPM dependencies](#install-top-level-npm-dependencies)
  - [Install top-level composer dependencies](#install-top-level-composer-dependencies)
  - [Build custom ui components](#build-custom-ui-components)
  - [Copy the example environment file:](#copy-the-example-environment-file)
  - [Add secure application key:](#add-secure-application-key)
  - [Add Apple Music key and IDs:](#add-apple-music-key-and-ids)
  - [Add your Apple Music private key:](#add-your-apple-music-private-key)
- [Set up the server](#set-up-the-server)
  - [Edit your `/etc/hosts` file:](#edit-your-etchosts-file)
  - [Run the database migration:](#run-the-database-migration)
- [Run the dev server](#run-the-dev-server)
  - [Get the server running](#get-the-server-running)
  - [Add your first user](#add-your-first-user)
- [Launch the admin](#launch-the-admin)
- [Update Deployment Webhook (optional)](#update-deployment-webhook-optional)

## Release Notes

### 1.0.0

- Initial release based on the code of [The Timeline of African American Music](https://timeline.carnegiehall.org) released on January 2022.
- Code contains structural elements but not specific data (images, text, values) associated with the Timeline of African American Music.
- This code is provided “as is” and for you to use at your own risk. The information included in the contents of this repository is not necessarily complete. Carnegie Hall offers the scripts as-is and makes no representations or warranties of any kind.
- Support or maintenance for use and modification is not provided. Future updates will be released at will.

## Requirements

This project was built using Twill and is compatible with Laravel
version 8, running on PHP 8.0. Twill shares Laravel's
[server requirements](https://laravel.com/docs/8.x/deployment#server-requirements).

### Frontend assets

Custom Vue.JS UI components built for the CMS are located in
`resources/js/components` and are compiled via
[Lavavel Mix](https://laravel-mix.com/docs/6.0/what-is-mix).

### Database

This project has been developed and tested against MySQL 5.7.

## Installation

### Clone the project

`git clone https://github.com/simonbetton/timeline.carnegiehall.org.git`

### Install top-level NPM dependencies

`npm install`

The root directory has a `package.json` which contains build-related
dependencies for tasks including:

- Building the custom Vue.JS components

### Install top-level composer dependencies

`composer install`

The root directory has a `composer.json` which contains build-related
dependencies for tasks including:

- Building the Laravel and Twill dependencies

### Build custom ui components

`npm run production` to compile the assets or `npm run development` when
editing the components.

### Copy the example environment file:

`cp .env.example .env`

### Add secure application key:

Run the following command to use PHP's secure random bytes generator to build
a cryptographically secure key for your application.

`php artisan key:generate`

### Add Apple Music key and IDs:

Edit the following in the `.env` file:

```
APPLE_MUSIC_TEAM_ID=
APPLE_MUSIC_KEY_ID=
```

### Add your Apple Music private key:

Add your private key in the root of the project directory `/apple-music.p8`

_NB: The project root directory must NOT be publically accessible and you
should never commit sensitive keys into a git repo._

## Set up the server

### Edit your `/etc/hosts` file:

```
127.0.0.1 timeline.test
127.0.0.1 admin.timeline.test
```

You're welcome to change these domains, but remember to update them in
the `.env` file. [See here for more info](https://twill.io/docs/getting-started/installation.html#env)

### Run the database migration:

Run the following to import the projects database table structure.

`php artisan migrate`

## Run the dev server

### Get the server running

Simply run your local environment via the following command while MySQL is also running.

`php artisan serve`

### Add your first user

Create your first CMS user via CLI.

`php artisan twill:superadmin`

## Launch the admin

Visit the CMS and login with the credentials used to create the user with the
command above: http://admin.timeline.test:8000/

_NB: You will need to change this domain if you changed your configuration above._

## Update Deployment Webhook (optional)

Update the webhook URL used to trigger a Vercel deployment in the `.env` file.

`TRIGGER_DEPLOYMENT_WEBHOOK=`

Vercel is not required, though the URL is requested via a POST request.

If you wish to remove the link in the CMS, simply comment out the navigation
item in `/config/twill-navigation.php`

```
//  'deploy' => [
//    'title' => 'Trigger Deploy',
//    'route' => 'admin.deploy'
//  ],
```

## Learn more on Twill CMS<!-- omit in toc -->

https://twill.io/tutorials

## License<!-- omit in toc -->

MIT
