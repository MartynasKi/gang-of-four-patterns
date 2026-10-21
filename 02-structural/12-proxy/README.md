# 12: Proxy

> Put a stand-in object in front of the real one to control access to it.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

Building a report runs a slow query. A page that only lists report titles
still builds every report, so it pays for work nobody uses.

## Solution

Create a proxy with the same interface as the real object. Callers use the
proxy as if it were real. The proxy decides when to create the real object
and passes calls to it. Here it waits until `content()` is called.

Common kinds of proxy:

- **Lazy**: create the expensive object on first use.
- **Protection**: check permissions before passing a call on.
- **Remote**: look like a local object but call an API.
- **Caching**: remember results of slow calls.

## When to use

- The real object is expensive to create and not always needed.
- You want to add access checks or caching without changing the real class.

## Watch out

- A proxy and a decorator look the same in code. A proxy controls access to
  the object. A decorator adds new behavior.
- Lazy loading hides when the slow work happens, which can surprise you, for
  example with N+1 queries.

## Seen in Laravel and PHP

- PHP 8.4 [lazy objects](https://www.php.net/manual/en/language.oop5.lazy-objects.php)
  build lazy proxies natively with `ReflectionClass::newLazyProxy()`.
- Eloquent relations load only when you first access them, such as
  `$post->author`.

## Run it

[before.php](before.php) runs a query for each report even though the page
only prints titles.

```shell
php ./02-structural/12-proxy/before.php
```

[after.php](after.php) uses `LazyReport`. Titles cost nothing and the query
runs once, on the first `content()` call.

```shell
php ./02-structural/12-proxy/after.php
```
