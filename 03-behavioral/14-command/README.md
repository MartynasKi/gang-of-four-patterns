# 14: Command

> Turn an action into an object you can store, queue or undo.

Behavioral: how is work divided between objects? [Back to all patterns](../../README.md)

## Problem

Buttons call editor methods directly. The action happens and is gone. You
cannot undo it, queue it for later, log it or retry it.

## Solution

Wrap each action in a small object with an `execute()` method and the data it
needs. Now actions are values: put them in a history list, a queue or a log.
Add `undo()` and you get undo for free.

## When to use

- You need undo and redo.
- You want to queue, schedule, retry or log actions.
- The thing that triggers an action should not know how it is done.

## Watch out

- Every action becomes a class. For a few simple actions a closure can be
  enough.
- Undo is only as good as the command's memory. Some actions, such as
  sending an email, cannot be undone.

## Seen in Laravel and PHP

- Laravel queued jobs: a job class holds its data and runs in `handle()`
  now or later on a queue worker.
- Artisan commands and the command bus with `Bus::dispatch()` follow the same
  idea.

## Run it

[before.php](before.php) calls the editor directly and has no way to undo.

```shell
php ./03-behavioral/14-command/before.php
```

[after.php](after.php) wraps each change in an `Append` command and stores
it in `History`, which undoes them one by one.

```shell
php ./03-behavioral/14-command/after.php
```
