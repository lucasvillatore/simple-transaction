# Simple Transfer

## Description
An API using DDD to simulate a simple transfer of values between users

## Features

- create user
- list users
- create transactions
- notify users with transactions status

## Local development

To local development, run:

```bash
$ cp .env.example .env
$ docker-compose up -d
$ php artisan serve
```

To create the database

```bash
$ php artisan migrate
```

## Tests

To run the tests:

**Unit**

```bash
```

**Integration**

```bash
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


## To do

- refactor services
- add integration tests
- send requests to mocks
  - when send notification
  - when request external authorizer