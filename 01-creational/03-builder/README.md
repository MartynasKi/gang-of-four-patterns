# 03: Builder

> Build a complex object step by step and check it at the end.

Creational: who creates the objects? [Back to all patterns](../../README.md)

## Problem

An object needs many optional parts. A constructor with six arguments is hard
to read and nothing checks that the parts make sense together.

## Solution

A separate builder object collects the parts with small named methods. Each
method returns the builder, so calls chain. `build()` validates everything
and returns the finished object, often a readonly one.

## When to use

- The object has many optional parts or several valid combinations.
- You want the final object to be readonly but still easy to assemble.
- Some rules depend on more than one part, such as "no body on GET".

## Watch out

- For a few simple options, [named arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments)
  with defaults are often enough. `new HttpRequest(url: '...', timeout: 10)`
  is already readable.
- A builder is mutable, so do not share one instance between requests.

## Seen in Laravel and PHP

- Laravel's query builder: `DB::table('users')->where('active', true)->orderBy('name')->get()`.
- Laravel's HTTP client: `Http::withHeaders([...])->timeout(10)->post(...)`.

## Run it

[before.php](before.php) uses a long constructor call and happily creates a
GET request with a body.

```shell
php ./01-creational/03-builder/before.php
```

[after.php](after.php) chains named steps. `build()` rejects the broken
request with a `LogicException`.

```shell
php ./01-creational/03-builder/after.php
```
