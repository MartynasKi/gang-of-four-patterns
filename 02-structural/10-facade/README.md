# 10: Facade

> Put one simple class in front of a complicated subsystem.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

Placing an order touches inventory, payments and mail in a fixed order. Every
controller, API endpoint and command repeats those steps and has to know all
three classes.

## Solution

Create one class, such as `OrderService`, with a simple method like
`placeOrder()`. It calls the subsystem in the right order. Callers depend on
the facade only. The subsystem classes are still there for anyone who needs
more control.

## When to use

- A task needs several classes working together in a set order.
- You want to hide a messy or third-party subsystem behind a small API.

## Watch out

- A facade can grow into a "god class" that knows everything. Keep it to one
  area, such as orders.
- It should only coordinate. Business rules belong in the classes behind it.

## Seen in Laravel and PHP

- Laravel's "Facades" such as `Cache::get()` share the name, but they are a
  different idea. They are static proxies to a service in the container.
- Laravel action or service classes, such as `PlaceOrder`, are the classic
  facade in everyday Laravel code.

## Run it

[before.php](before.php) has the caller run every step itself.

```shell
php ./02-structural/10-facade/before.php
```

[after.php](after.php) wraps the steps in `OrderService::placeOrder()`.

```shell
php ./02-structural/10-facade/after.php
```
