<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Decorator: before');

final class UserRepository
{
    private array $cache = [];

    public function __construct(
        private bool $logging = false,
        private bool $caching = false,
    ) {}

    public function find(int $id): string
    {
        // Every extra feature adds another flag and another if
        if ($this->caching && isset($this->cache[$id])) {
            return $this->cache[$id];
        }

        if ($this->logging) {
            text("log: find({$id})");
        }

        text("query: SELECT * FROM users WHERE id = {$id}");
        $user = "User #{$id}";

        if ($this->caching) {
            $this->cache[$id] = $user;
        }

        return $user;
    }
}

section('One class with flags for every extra feature');
$users = new UserRepository(logging: true, caching: true);
dump($users->find(1));
dump($users->find(1));
