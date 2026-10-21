# 01: Factory Method

> Let a subclass decide which object to create.

Creational: who creates the objects? [Back to all patterns](../../README.md)

## Problem

`Notifier` creates every message type itself with `new`. Each new channel
means opening `Notifier` and adding one more branch to a `match`.

## Solution

The base class calls an abstract method such as `createMessage()` instead of
`new`. Each subclass overrides it and returns its own product. The base class
only knows the `Message` interface.

## When to use

- A class has a fixed workflow but the object it needs can vary.
- You want to add new types by adding classes, not by editing old ones.

## Watch out

- One subclass per product can feel heavy. If the choice is a simple value,
  a `match` or a closure is often enough.
- A "simple factory" is one class with a `create()` method and a `match`
  inside. It is useful, but it is not this pattern.

## Seen in Laravel and PHP

- Laravel managers such as `CacheManager` call `create{Name}Driver()` methods,
  for example `createRedisDriver()`. A new driver is one more method.

## Run it

[before.php](before.php) puts every message class inside one `match`. An
unknown channel throws `UnhandledMatchError`.

```shell
php ./01-creational/01-factory-method/before.php
```

[after.php](after.php) moves creation into `createMessage()`. Slack is added
as a new subclass and `Notifier` stays the same.

```shell
php ./01-creational/01-factory-method/after.php
```
