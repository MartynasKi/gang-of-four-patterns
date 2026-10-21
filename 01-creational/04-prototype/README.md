# 04: Prototype

> Create new objects by copying a ready-made one.

Creational: who creates the objects? [Back to all patterns](../../README.md)

## Problem

You have a fully set up object, such as an invoice template, and need many
similar ones. Building each from scratch repeats the setup. A plain `clone`
is shallow, so nested objects are still shared.

## Solution

Keep a prototype object and `clone` it. Add `__clone()` to copy nested
objects too, so every copy is independent. PHP has this pattern built into
the language with `clone`.

## When to use

- Setting up an object is long or expensive and copies differ only a little.
- You want copies without knowing the exact class of the original.

## Watch out

- `clone` is shallow. Objects inside are shared until `__clone()` copies them.
- Arrays are copied by value, but objects stored inside those arrays are not.
- For readonly objects, PHP 8.5 `clone($object, ['prop' => $value])` makes a
  changed copy in one call.

## Seen in Laravel and PHP

- Eloquent's `$model->replicate()` copies a model without its primary key.
- Carbon's `copy()` clones a date before you change it.

## Run it

[before.php](before.php) clones an invoice and renames the customer. The
template changes too because both share one `Customer`.

```shell
php ./01-creational/04-prototype/before.php
```

[after.php](after.php) adds `__clone()`, so each copy gets its own customer
and keeps the template lines.

```shell
php ./01-creational/04-prototype/after.php
```
