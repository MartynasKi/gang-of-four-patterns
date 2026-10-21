# 17: Mediator

> Let objects talk through one middleman instead of directly to each other.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

Chat users send messages straight to each other. Each user must know every
other user, so the links grow fast and every change touches many objects.

## Solution

Add a mediator, such as `ChatRoom`. Each user knows only the room. The room
knows everyone and decides who gets each message. Objects stay simple and
the rules of how they interact live in one place.

## When to use

- Many objects talk to each other in tangled ways.
- You want to change the interaction rules without touching every object.
- Typical cases are chat rooms, form fields that depend on each other and
  UI widgets on one screen.

## Watch out

- The mediator can grow into a huge class that knows too much. Split it when
  it handles unrelated things.
- Mediator and Observer often work together. The difference: a mediator
  coordinates objects it knows, while an observer subject does not care who
  listens.

## Seen in Laravel and PHP

- Laravel's event dispatcher sits between code that fires events and the
  listeners that handle them. Neither side knows the other.
- Symfony's EventDispatcher plays the same role.

## Run it

[before.php](before.php) links every user to every other user by hand.

```shell
php ./03-behavioral/17-mediator/before.php
```

[after.php](after.php) routes messages through `ChatRoom`. A new user joins
and nobody else changes.

```shell
php ./03-behavioral/17-mediator/after.php
```
