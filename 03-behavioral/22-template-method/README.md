# 22: Template Method

> Fix the steps of an algorithm in a base class and let subclasses fill in some.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

CSV and JSON exports both load rows, filter them and format them. Only the
last step differs, but the first two are copied into every export class.

## Solution

A base class has one `final` method, the template, that calls the steps in
order. Shared steps live in the base class. Steps that differ are `abstract`.
Optional steps are hooks with a default that subclasses may override.

## When to use

- Several classes follow the same steps and differ in one or two of them.
- You want to lock the order of steps but allow small changes.

## Watch out

- It is built on inheritance, so subclasses depend on the base class
  details. If you need to mix steps freely, Strategy is more flexible.
- Too many hooks make the flow hard to follow.

## Seen in Laravel and PHP

- Laravel's `FormRequest` runs a fixed validation flow and calls your
  `authorize()`, `rules()` and optional hooks such as
  `prepareForValidation()`.
- PHPUnit's `TestCase` calls `setUp()`, the test and `tearDown()` in a fixed
  order.

## Run it

[before.php](before.php) copies load and filter into both export classes.

```shell
php ./03-behavioral/22-template-method/before.php
```

[after.php](after.php) moves the shared steps into `ReportExport`.
`FullJsonExport` overrides the `filter()` hook to keep every row.

```shell
php ./03-behavioral/22-template-method/after.php
```
