# 18: Memento

> Save an object's state so you can restore it later.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

You want to save a draft and restore it later. If outside code copies every
field, the fields must be public and every new field breaks the save and
restore code.

## Solution

The object makes its own snapshot with `save()` and returns a small
immutable object, the memento. Other code only stores it, for example in a
list of drafts. Later the object takes it back with `restore()`. The state
stays private.

## When to use

- You need undo, drafts, checkpoints or a "cancel changes" button.
- You want snapshots without exposing the object's internals.

## Watch out

- Snapshots cost memory. Keep a limit on how many you store.
- Nested objects inside a snapshot must be copied, or they still change with
  the original. Readonly snapshots with plain values avoid that.
- Command and Memento often work together: commands for "what happened",
  mementos for "what it looked like".

## Seen in Laravel and PHP

- Eloquent keeps the original attributes of a model, so `getOriginal()`,
  `isDirty()` and `getChanges()` can compare and report changes.
- `serialize()` and `unserialize()` are a crude, built-in way to snapshot an
  object.

## Run it

[before.php](before.php) copies public fields out and back in by hand.

```shell
php ./03-behavioral/18-memento/before.php
```

[after.php](after.php) lets `Form` save a `FormSnapshot` and restore from
it, with all fields private.

```shell
php ./03-behavioral/18-memento/after.php
```
