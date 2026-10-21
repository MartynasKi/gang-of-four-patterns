# 13: Chain of Responsibility

> Pass a request along a chain of handlers until one deals with it.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

A request goes through several checks: logged in, not rate limited and so on.
Putting them all in one function makes it long, and you cannot reuse or
reorder the checks.

## Solution

Each check becomes a handler object with a link to the next one. A handler
either stops the request, for example with `401`, or passes it on. You build
the chain from small pieces and change it without touching the handlers.

## When to use

- Several objects may handle a request and the order should be easy to change.
- You want reusable steps such as auth, logging or throttling.

## Watch out

- A request can fall off the end of the chain with nobody handling it. Give
  the chain a sensible default.
- Long chains are harder to debug, because it is not obvious which link
  stopped the request.

## Seen in Laravel and PHP

- Laravel HTTP middleware: each middleware gets `$request` and `$next` and
  decides whether to call `$next($request)`. Laravel's `Pipeline` runs them.
- PSR-15 middleware works the same way in other frameworks.

## Run it

[before.php](before.php) has every check inside one `handle()` function.

```shell
php ./03-behavioral/13-chain-of-responsibility/before.php
```

[after.php](after.php) links `Authenticate` and `RateLimit` objects. The last
section uses one link on its own to show that the pieces are reusable.

```shell
php ./03-behavioral/13-chain-of-responsibility/after.php
```
