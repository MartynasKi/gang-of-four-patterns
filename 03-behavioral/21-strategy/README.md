# 21: Strategy

> Swap one algorithm for another behind the same interface.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

Checkout supports flat rate, by weight and free shipping. All formulas sit in
one `match`, which grows with every method and is hard to test one by one.

## Solution

Put each algorithm in its own class with a shared interface. The checkout
gets one strategy from outside and calls it. It does not know which one it
has.

## When to use

- You have several ways to do the same thing: pricing, shipping, sorting,
  hashing, exporting.
- The choice is made at runtime, for example from config or user input.

## Watch out

- If a strategy is one small formula, a closure is enough. A `Closure`
  parameter is a strategy too.
- Someone still has to pick the strategy. That choice usually moves to a
  factory or the container.
- It looks like State. The difference: a strategy is picked from outside, a
  state changes itself.

## Seen in Laravel and PHP

- Laravel's `Hash` uses bcrypt, argon or argon2id behind one interface.
- `usort($items, $compare)` takes the comparison strategy as a callable.

## Run it

[before.php](before.php) keeps every formula in one `match`.

```shell
php ./03-behavioral/21-strategy/before.php
```

[after.php](after.php) passes a `ShippingCost` strategy into `Checkout` and
tries all three.

```shell
php ./03-behavioral/21-strategy/after.php
```
