# 05: Singleton

> Make sure a class has only one instance and give one way to reach it.

Creational: who creates the objects? [Back to all patterns](../../README.md)

## Problem

Some objects should exist once, such as loaded config or a connection pool.
When every part of the app calls `new`, the work repeats and the copies can
drift apart.

## Solution

Make the constructor `private` and add a static `instance()` method. It
creates the object on the first call and returns the same one afterwards.
A private `__clone()` blocks copies.

## When to use

- There must be exactly one instance and creating it is expensive.
- Honestly, this is rare in modern PHP. Read Watch out first.

## Watch out

- It is global state with a nicer name. Any code can reach it, so hidden
  dependencies grow.
- Tests suffer. The instance lives for the whole process and is hard to swap
  for a fake.
- PHP usually starts fresh for each request, so "one instance" means one per
  request. Long-running workers such as Laravel Octane keep it between
  requests.
- Prefer a dependency injection container that creates one shared instance
  and passes it in. You get "only one" without the static access.

## Seen in Laravel and PHP

- `$this->app->singleton(Service::class, ...)` shares one instance through
  Laravel's container. This is the usual replacement for the classic pattern.

## Run it

[before.php](before.php) creates `Config` three times and loads it three
times.

```shell
php ./01-creational/05-singleton/before.php
```

[after.php](after.php) loads it once through `Config::instance()`. Calling
`new Config()` throws an `Error`.

```shell
php ./01-creational/05-singleton/after.php
```
