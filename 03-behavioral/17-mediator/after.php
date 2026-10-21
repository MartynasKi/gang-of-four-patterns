<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Mediator: after');

// The mediator: users only talk to the room
final class ChatRoom
{
    /** @var list<User> */
    private array $users = [];

    public function join(User $user): void
    {
        $this->users[] = $user;
    }

    public function broadcast(User $from, string $message): void
    {
        foreach ($this->users as $user) {
            if ($user !== $from) {
                $user->receive($from->name, $message);
            }
        }
    }
}

final readonly class User
{
    public function __construct(public string $name, private ChatRoom $room)
    {
        $room->join($this);
    }

    public function send(string $message): void
    {
        $this->room->broadcast($this, $message);
    }

    public function receive(string $from, string $message): void
    {
        text("{$this->name} got from {$from}: {$message}");
    }
}

$room = new ChatRoom();
$ann = new User('Ann', $room);
$bob = new User('Bob', $room);
$cid = new User('Cid', $room);

section('Users only know the room');
$ann->send('Hi all!');

section('Someone new joins without anyone else changing');
$dee = new User('Dee', $room);
$bob->send('Welcome, Dee!');
