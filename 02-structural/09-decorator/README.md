# 09: Decorator

> Wrap an object to add behavior without changing its class.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

You want logging, caching or retries around a repository. Putting it all in
one class means flags and `if` checks. Subclassing means a class for every
combination, such as `CachedLoggingUserRepository`.

## Solution

Each decorator implements the same interface as the object it wraps. It does
its extra work and passes the call to the inner object. Decorators stack like
layers, so you combine features at construction time.

## When to use

- You want to add features such as caching, logging, retries or metrics on
  top of existing code.
- You need different combinations of those features in different places.

## Watch out

- The order matters. Cache outside of logging means cache hits are not
  logged. Swap them and every call is logged.
- Many thin layers can make stack traces long and debugging slower.

## Seen in Laravel and PHP

- Symfony HttpClient: `RetryableHttpClient` and `ScopingHttpClient` wrap any
  other client.
- Laravel's container has `$this->app->extend(...)`, which lets you wrap a
  bound service in a decorator.

## Run it

[before.php](before.php) puts logging and caching into one class with flags.

```shell
php ./02-structural/09-decorator/before.php
```

[after.php](after.php) wraps the database repository in logging, then in
caching. The second `find(1)` comes from the cache and skips both the log and
the query.

```shell
php ./02-structural/09-decorator/after.php
```
