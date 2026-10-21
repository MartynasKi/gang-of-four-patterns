*Want to see where these patterns hide inside Laravel? Find out in my article
[Laravel Knows the Gang of Four. Do You?](https://laraholic.com/laravel-knows-the-gang-of-four-do-you-ff6ed16c5599)*

---

# Gang of Four Patterns Cheatsheet

First of all... Hello!

I am Martynas Ki. 👋 And nice to meet you!

Even after more than a decade of coding, there is always something new to learn or something old to remember.

From time to time, I share what I discover on my [Laraholic blog](https://laraholic.com/), where I write about Laravel, PHP or whatever else catches my interest.

So... here I am, revisiting the 23 classic Gang of Four design patterns in modern PHP. Each one gets a short explanation and two
small scripts: one with the problem and one with the pattern. 🤓

## Requirements

- [PHP 8.5](https://www.php.net/downloads.php), the latest stable PHP series
- [Composer](https://getcomposer.org/download/)

## How to run

1. Clone the repository.

   ```shell
   git clone https://github.com/MartynasKi/gang-of-four-patterns.git
   cd gang-of-four-patterns
   ```

2. Install dependencies.

   ```shell
   composer install
   ```

3. Run an example.

   ```shell
   php ./03-behavioral/21-strategy/before.php
   php ./03-behavioral/21-strategy/after.php
   ```

See each pattern README for the explanation and commands.

## Patterns

### Creational (5)

Who creates the objects?

| #  | Pattern                                                   | In plain words                                              |
|----|-----------------------------------------------------------|-------------------------------------------------------------|
| 01 | [Factory Method](01-creational/01-factory-method/README.md)     | Let a subclass decide which object to create.               |
| 02 | [Abstract Factory](01-creational/02-abstract-factory/README.md) | Create families of related objects that belong together.    |
| 03 | [Builder](01-creational/03-builder/README.md)                   | Build a complex object step by step and check it at the end. |
| 04 | [Prototype](01-creational/04-prototype/README.md)               | Create new objects by copying a ready-made one.             |
| 05 | [Singleton](01-creational/05-singleton/README.md)               | Make sure a class has only one instance.                    |

### Structural (7)

How do objects fit together?

| #  | Pattern                                           | In plain words                                         |
|----|---------------------------------------------------|--------------------------------------------------------|
| 06 | [Adapter](02-structural/06-adapter/README.md)     | Wrap a class so it fits the interface your code expects. |
| 07 | [Bridge](02-structural/07-bridge/README.md)       | Split one big class tree into two that change on their own. |
| 08 | [Composite](02-structural/08-composite/README.md) | Treat a single object and a group of objects the same way. |
| 09 | [Decorator](02-structural/09-decorator/README.md) | Wrap an object to add behavior without changing its class. |
| 10 | [Facade](02-structural/10-facade/README.md)       | Put one simple class in front of a complicated subsystem. |
| 11 | [Flyweight](02-structural/11-flyweight/README.md) | Share the common part of many objects instead of copying it. |
| 12 | [Proxy](02-structural/12-proxy/README.md)         | Put a stand-in in front of the real object to control access. |

### Behavioral (11)

How is work divided between objects?

| #  | Pattern                                                                  | In plain words                                         |
|----|--------------------------------------------------------------------------|--------------------------------------------------------|
| 13 | [Chain of Responsibility](03-behavioral/13-chain-of-responsibility/README.md) | Pass a request along a chain until one handler deals with it. |
| 14 | [Command](03-behavioral/14-command/README.md)                            | Turn an action into an object you can store, queue or undo. |
| 15 | [Interpreter](03-behavioral/15-interpreter/README.md)                    | Represent a small language as objects and evaluate them. |
| 16 | [Iterator](03-behavioral/16-iterator/README.md)                          | Walk through a collection without knowing how it is stored. |
| 17 | [Mediator](03-behavioral/17-mediator/README.md)                          | Let objects talk through one middleman, not directly.  |
| 18 | [Memento](03-behavioral/18-memento/README.md)                            | Save an object's state so you can restore it later.    |
| 19 | [Observer](03-behavioral/19-observer/README.md)                          | When one object changes, notify everyone who subscribed. |
| 20 | [State](03-behavioral/20-state/README.md)                                | Let an object change its behavior when its state changes. |
| 21 | [Strategy](03-behavioral/21-strategy/README.md)                          | Swap one algorithm for another behind the same interface. |
| 22 | [Template Method](03-behavioral/22-template-method/README.md)            | Fix the steps in a base class and let subclasses fill in some. |
| 23 | [Visitor](03-behavioral/23-visitor/README.md)                            | Add new operations to classes without changing them.   |

---

This is a personal learning project, not an authoritative reference.

If you spot a mistake or have a suggestion, please let me know.
