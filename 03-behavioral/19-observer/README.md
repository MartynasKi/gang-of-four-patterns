# 19: Observer

> When one object changes, notify everyone who subscribed.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

Placing an order should send an email, reduce stock and track analytics. If
`Order` calls all of them itself, it knows about mail, stock and analytics,
and every new side effect means editing it.

## Solution

The subject (`Order`) keeps a list of listeners that share one interface.
When something happens, it loops over them and calls each one. It does not
know what they do. You add or remove listeners from the outside.

## When to use

- One change should trigger several independent reactions.
- You want to add reactions without editing the class that triggers them.

## Watch out

- The flow is hidden. Reading `place()` no longer tells you everything that
  happens.
- Listeners run one after another by default. A slow or failing listener
  affects the rest. Queue heavy work.
- Avoid listeners that trigger each other in loops.

## Seen in Laravel and PHP

- Laravel events with their listeners.
- Eloquent model observers with methods such as `created()` and `updated()`.
- PHP's SPL has `SplSubject` and `SplObserver` interfaces for the classic
  form.

## Run it

[before.php](before.php) puts every side effect inside `Order::place()`.

```shell
php ./03-behavioral/19-observer/before.php
```

[after.php](after.php) lets listeners subscribe. Each order gets a different
set without changing `Order`.

```shell
php ./03-behavioral/19-observer/after.php
```
