# 16: Iterator

> Walk through a collection without knowing how it is stored.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

Orders come from an API, page by page. Every caller writes the same paging
loop and has to know how pages work. If the API switches to cursors, every
loop breaks.

## Solution

Hide the walking inside the collection. In PHP that means implementing
`IteratorAggregate` and returning an iterator from `getIterator()`. A
generator with `yield` is the shortest way. Callers just use `foreach`.

## When to use

- A collection has a non-trivial structure: pages, trees, streams, files.
- You want callers to use `foreach` and not care where items come from.
- Data is big and should be loaded lazily, piece by piece.

## Watch out

- A generator runs once. Calling `getIterator()` again starts a new one, which
  can mean new API calls.
- `iterator_to_array()` keeps keys by default. With `yield from` the keys
  repeat, so pass `preserve_keys: false`.

## Seen in Laravel and PHP

- PHP has the pattern built in: `Iterator`, `IteratorAggregate`, generators
  and the SPL iterators.
- Laravel's `LazyCollection` and Eloquent's `cursor()` and `lazy()` walk big
  result sets one item at a time.

## Run it

[before.php](before.php) makes the caller loop over pages itself.

```shell
php ./03-behavioral/16-iterator/before.php
```

[after.php](after.php) hides paging inside `Orders::getIterator()`, so a
plain `foreach` works.

```shell
php ./03-behavioral/16-iterator/after.php
```
