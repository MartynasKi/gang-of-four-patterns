# 23: Visitor

> Add new operations to a group of classes without changing them.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

Shapes need an area, a JSON export, maybe an SVG export later. Putting every
operation into every shape class means editing all of them for each new
operation, and the shapes fill up with unrelated code.

## Solution

Move each operation into a visitor class with one method per shape type,
such as `visitCircle()` and `visitRectangle()`. Each shape has one
`accept()` method that calls the right visit method on the visitor. This is
called double dispatch.

## When to use

- The set of classes is stable, but you keep adding operations on them.
- Typical cases are syntax trees, document models and reports over a fixed
  set of types.

## Watch out

- Adding a new shape type means adding a method to every visitor. It is the
  opposite trade-off of normal classes.
- For a few types, `match (true)` with `instanceof` checks is often simpler
  and good enough in modern PHP.

## Seen in Laravel and PHP

- nikic/php-parser, the parser behind tools such as PHPStan and Rector, walks
  PHP code with a `NodeTraverser` and `NodeVisitor` classes.

## Run it

[before.php](before.php) gives every shape an `area()` and a `toJson()`
method.

```shell
php ./03-behavioral/23-visitor/before.php
```

[after.php](after.php) moves both operations into `AreaVisitor` and
`JsonVisitor`. The shapes only have `accept()`.

```shell
php ./03-behavioral/23-visitor/after.php
```
