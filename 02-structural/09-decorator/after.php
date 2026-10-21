<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Decorator: after');

interface UserRepository
{
    public function find(int $id): string;
}

final class DbUserRepository implements UserRepository
{
    public function find(int $id): string
    {
        text("query: SELECT * FROM users WHERE id = {$id}");

        return "User #{$id}";
    }
}

// Each decorator wraps another UserRepository and adds one thing
final readonly class LoggingUserRepository implements UserRepository
{
    public function __construct(private UserRepository $inner) {}

    public function find(int $id): string
    {
        text("log: find({$id})");

        return $this->inner->find($id);
    }
}

final class CachingUserRepository implements UserRepository
{
    private array $cache = [];

    public function __construct(private readonly UserRepository $inner) {}

    public function find(int $id): string
    {
        return $this->cache[$id] ??= $this->inner->find($id);
    }
}

section('Stack only what you need');
$users = new CachingUserRepository(new LoggingUserRepository(new DbUserRepository()));
dump($users->find(1));
dump($users->find(1));

section('Or use the plain one');
dump(new DbUserRepository()->find(2));
