# Timeline of African American Music

This project is the CMS tailored for the Timeline of African American
Music by Carnegie Hall, built on [Twill](https://twill.io/). An open-source
[Laravel](https://laravel.com/docs/8.x) based CMS.

### [timeline.carnegiehall.org](https://timeline.carnegiehall.org/)

- [Live Site](https://timeline.carnegiehall.org/)
- [Demo](https://demo.twill.io/)

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

### 1. Clone the project

`git clone https://github.com/simonbetton/timeline.carnegiehall.org.git`

### 2. Install top-level NPM dependencies

`npm install`

The root directory has a `package.json` which contains build-related
dependencies for tasks including:

- Building the custom Vue.JS components

### 3. Install top-level composer dependencies

`composer install`

The root directory has a `composer.json` which contains build-related
dependencies for tasks including:

- Building the Laravel and Twill dependencies

### 4. Build custom ui components

`npm run production` to compile the assets or `npm run development` when
editing the components.

### 5. Set up the server

##### Copy the example environment file:

`cp .env.example .env`

##### Add Apple Music key and IDs:

Edit the following in the `.env` file:

```
APPLE_MUSIC_TEAM_ID=
APPLE_MUSIC_KEY_ID=
```

##### Add your Apple Music private key:

Add your private key in the root of the project directory `/apple-music.p8`

_NB: The project root directory must NOT be publically accessible and you
should never commit sensitive keys into a git repo._

##### Edit your `/etc/hosts` file:

```
127.0.0.1 timeline.test
127.0.0.1 admin.timeline.test
```

You're welcome to change these domains, but remember to update them in
the `.env` file. [See here for more info](https://twill.io/docs/getting-started/installation.html#env)

##### Add secure application key:

Run the following command to use PHP's secure random bytes generator to build
a cryptographically secure key for your application.
`php artisan key:generate`

##### Run the database migration:

Run the following to import the projects database table structure.
`php artisan migrate`

### 5. Run the dev server

To simply run your local environment, run the following command while MySQL
is also running.
`php artisan serve`

### 6. Add your first user

Create your first CMS user via CLI.
`php artisan twill:superadmin`

### 7. Launch the admin ui

Visit the CMS and login with the credentials used to create the user with the
command above.
`http://admin.timeline.test:8000/

_NB: You will need to change this domain if you changed your configuration above._

### 8. Update Deployment Webhook (optional)

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

## Learn more on Twill CMS

https://twill.io/tutorials

## License

MIT
