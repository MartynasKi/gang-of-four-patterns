# 11: Flyweight

> Share the common part of many objects instead of copying it.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

A map has 10 000 trees. Each tree stores its position plus the same name,
color and big texture as thousands of others. Memory fills up with copies.

## Solution

Split the data in two. The shared part, which never changes (`TreeType`), is
created once and reused through a small factory. Each object keeps only its
unique part (`x`, `y`) and a reference to the shared one.

## When to use

- You have a huge number of similar objects and memory is a real problem.
- Most of each object's data repeats and does not change.

## Watch out

- The shared part must be immutable. If one tree changes its type, every
  tree using it changes too.
- In normal web requests you rarely have enough objects for this to matter.
  Measure first.
- PHP already shares identical strings when you assign them, thanks to
  copy-on-write. The win here comes from not creating the data again.

## Seen in Laravel and PHP

- PHP enums: each case is one object, shared everywhere it is used.
- PHP interns string literals, so the same literal in many places points to
  one copy in memory.

## Run it

[before.php](before.php) creates 10 000 trees, each with its own texture
string.

```shell
php ./02-structural/11-flyweight/before.php
```

[after.php](after.php) shares two `TreeType` objects across all trees and
uses much less memory. Exact numbers depend on your machine.

```shell
php ./02-structural/11-flyweight/after.php
```
