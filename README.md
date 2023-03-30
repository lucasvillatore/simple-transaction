# Simple Transfer

## Description
An API using DDD to simulate a simple transfer of values between users

## Features

- create user
- create transactions
- notify users with transactions status

## Local development

To local development, run:

```bash
$ cp .env.example .env
$ docker-compose up -d
$ composer install
$ php artisan serve
```

To create the database

```bash
$ php artisan migrate
```

## Tests

To run the tests:

**Coverage**
```bash
php artisan test --coverage-html cover/
```

## Improvement points

- create API documentation
- use cache for database access
- remove synchronous requests and work with events
  - from transactions
  - from notifications
- break into independent microservices
- add logs for
  - create business dashboards
  - create alert configurations
  - health application monitoring