# 07: Bridge

> Split one big class tree into two that can change on their own.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

Notifications vary in two ways: the type (order shipped, invoice ready) and
the channel (email, SMS). One class per pair means types × channels classes.
Every new type or channel multiplies the count.

## Solution

Split the two sides. The abstraction (`Notification`) holds a reference to
the implementation (`Channel`) and delegates the sending to it. Now each side
grows by adding, not multiplying: types + channels classes.

## When to use

- A class varies in two independent ways and subclasses keep multiplying.
- You want to pick or switch the implementation at runtime.

## Watch out

- It looks a lot like Strategy. The difference is intent: Bridge is planned
  up front to keep two hierarchies apart. Strategy swaps one algorithm.
- With only one dimension that changes, this is extra structure for nothing.

## Seen in Laravel and PHP

- Laravel's cache `Repository` is the abstraction with the nice API such as
  `remember()`. It talks to a `Store` implementation such as Redis, file or
  array.
- Laravel notifications send one notification class through many channels
  with `via()`.

## Run it

[before.php](before.php) needs one class per type and channel pair.

```shell
php ./02-structural/07-bridge/before.php
```

[after.php](after.php) passes a `Channel` into each `Notification`, so any
type works with any channel.

```shell
php ./02-structural/07-bridge/after.php
```
