# 20: State

> Let an object change its behavior when its internal state changes.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

An order can be draft, paid, shipped or cancelled. Each method checks the
status with its own `if`. The rules are spread out, and a plain string
status lets typos such as `'shiped'` slip through.

## Solution

Move the behavior for each state into the state itself. The order holds its
current state and delegates to it. The state returns the next state or
refuses the move. All rules for one state live in one place.

The classic version uses one class per state. In modern PHP an enum with
methods and `match` does the same job with much less code.

## When to use

- An object has clear states and the allowed actions depend on the state.
- You see the same `if ($status === ...)` checks in many methods.

## Watch out

- For two states and one rule, a simple `if` is fine.
- When each state needs its own data or a lot of logic, switch from the enum
  to one class per state.

## Seen in Laravel and PHP

- Laravel has no state machine in the core. Eloquent can cast a column to a
  backed enum, which makes the enum version natural.
- The `spatie/laravel-model-states` package uses one class per state.

## Run it

[before.php](before.php) checks a string status in each method and accepts
a typo.

```shell
php ./03-behavioral/20-state/before.php
```

[after.php](after.php) moves the rules into the `OrderStatus` enum. The
status uses `private(set)`, so outside code cannot set it directly.

```shell
php ./03-behavioral/20-state/after.php
```
