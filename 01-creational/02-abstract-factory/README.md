# 02: Abstract Factory

> Create families of related objects that belong together.

Creational: who creates the objects? [Back to all patterns](../../README.md)

## Problem

A dark theme needs a dark button and a dark input. When every place checks
the theme on its own, one forgotten check mixes the families.

## Solution

Define a factory interface with one method per product, such as
`createButton()` and `createInput()`. Each family gets its own factory class.
Client code receives one factory and never calls `new` on a product.

## When to use

- You have several products that must match, such as themes, database
  drivers or payment providers.
- You want to switch the whole family in one place.

## Watch out

- Adding a new product type means changing the interface and every factory.
- With only one product it is just a Factory Method. Wait for a real family
  before you build the full structure.

## Seen in Laravel and PHP

- Laravel's `ConnectionFactory` builds a matching connector and connection
  for each database driver, such as MySQL or PostgreSQL.

## Run it

[before.php](before.php) checks the theme in each place and ends up with a
light input on a dark form.

```shell
php ./01-creational/02-abstract-factory/before.php
```

[after.php](after.php) passes one `ThemeFactory` to the form, so the button
and input always match.

```shell
php ./01-creational/02-abstract-factory/after.php
```
