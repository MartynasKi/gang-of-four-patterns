# 15: Interpreter

> Represent a small language as objects and evaluate them.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

You have a tiny language, such as validation rules like `required|min:3`.
One function that parses and checks at the same time grows with every rule
and is hard to test.

## Solution

Make one class per piece of the language: `Required`, `Min`, `Max` and
`AllOf` to combine them. A parser turns the text into a tree of these
objects. Each object knows how to evaluate itself with `passes()`.

## When to use

- You have a small, stable language: rule strings, search filters, simple
  math or permission expressions.
- The same expression is evaluated many times.

## Watch out

- It does not scale to big languages. For real grammars use a parser library
  or a tool such as Symfony ExpressionLanguage.
- The interesting part is the tree of objects, not the parsing. Keep the
  parser small.

## Seen in Laravel and PHP

- Laravel validation parses strings such as `'required|min:3'` into rules
  and checks each one.
- Symfony ExpressionLanguage parses expressions such as
  `user.age > 18` into a node tree it can evaluate.

## Run it

[before.php](before.php) parses and checks inside one `validate()` function.

```shell
php ./03-behavioral/15-interpreter/before.php
```

[after.php](after.php) parses the string once into a tree of `Rule` objects,
then evaluates it for each value.

```shell
php ./03-behavioral/15-interpreter/after.php
```
