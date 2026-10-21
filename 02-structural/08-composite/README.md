# 08: Composite

> Treat a single object and a group of objects the same way.

Structural: how do objects fit together? [Back to all patterns](../../README.md)

## Problem

Files live in folders and folders live in folders. Code that works with the
tree has to check "is this a file or a folder?" and walk the children itself.

## Solution

Give leaves (`File`) and containers (`Folder`) one shared interface (`Node`).
A container does the work by asking its children and combining the results.
The caller just calls `size()` on the root.

## When to use

- Your data is a tree: menus, categories, folders, UI components, org charts.
- You want the same operation on one item and on a whole branch.

## Watch out

- A shared interface can tempt you to add methods that make no sense for
  leaves, such as `addChild()` on a file. Keep child management on the
  container.
- Very deep trees mean deep recursion. Fine for menus, worth a thought for
  huge data.

## Seen in Laravel and PHP

- PHP's DOM: every `DOMNode` can hold child nodes and a whole document is
  one tree of nodes.
- Symfony Forms: a form is a field that can contain other fields.

## Run it

[before.php](before.php) uses a function with an `instanceof` check that
walks the tree.

```shell
php ./02-structural/08-composite/before.php
```

[after.php](after.php) gives both classes `size()`. A folder sums its
children, so the caller makes one call.

```shell
php ./02-structural/08-composite/after.php
```
