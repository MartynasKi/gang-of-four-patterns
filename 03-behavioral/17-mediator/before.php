<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Mediator: before');

final class User
{
    /** @var list<User> */
    private array $contacts = [];

    public function __construct(public readonly string $name) {}

    public function addContact(User $user): void
    {
        $this->contacts[] = $user;
    }

    public function send(string $message): void
    {
        foreach ($this->contacts as $contact) {
            $contact->receive($this->name, $message);
        }
    }

    public function receive(string $from, string $message): void
    {
        text("{$this->name} got from {$from}: {$message}");
    }
}

$ann = new User('Ann');
$bob = new User('Bob');
$cid = new User('Cid');

// Every user must know every other user
$ann->addContact($bob);
$ann->addContact($cid);
$bob->addContact($ann);
$bob->addContact($cid);
$cid->addContact($ann);
$cid->addContact($bob);

section('Users talk to each other directly');
$ann->send('Hi all!');

text('3 users need 6 links. 10 users would need 90.');
