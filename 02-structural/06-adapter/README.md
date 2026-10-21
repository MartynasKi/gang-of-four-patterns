# 06: Adapter

> Wrap a class so it fits the interface your code expects.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

A third-party SDK has its own method names and data formats. When your code
calls it directly, those details spread everywhere and you cannot swap the
provider.

## Solution

Define the interface your app wants, such as `PaymentGateway`. Write a small
adapter class that implements it and translates each call to the SDK. The
rest of the app only knows the interface.

## When to use

- You use a library or legacy class with an interface that does not match
  yours.
- You want to swap providers or use a fake in tests.

## Watch out

- Keep adapters thin. They translate calls, they do not hold business logic.
- One adapter per provider. If adapters start to share a lot of code, look at
  what the interface really needs.

## Seen in Laravel and PHP

- Laravel's `Storage` sits on Flysystem, which has one adapter per backend:
  local disk, S3, FTP and more.
- PSR-18 HTTP clients and PSR-3 loggers let packages use any library that
  implements the shared interface.

## Run it

[before.php](before.php) calls the SDK straight from `Checkout`, with the
amount formatting mixed in.

```shell
php ./02-structural/06-adapter/before.php
```

[after.php](after.php) hides the SDK behind `LegacyPayAdapter`. `Checkout`
works with it and with a fake gateway.

```shell
php ./02-structural/06-adapter/after.php
```
