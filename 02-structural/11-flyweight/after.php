<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Flyweight: after');

// Shared, unchanging data: the flyweight
final readonly class TreeType
{
    public function __construct(
        public string $name,
        public string $color,
        public string $texture,
    ) {}
}

final class TreeTypes
{
    private static array $types = [];

    public static function get(string $name, string $color): TreeType
    {
        return self::$types["{$name}-{$color}"] ??= new TreeType($name, $color, str_repeat($name, 250));
    }

    public static function count(): int
    {
        return count(self::$types);
    }
}

// Unique data stays small
final readonly class Tree
{
    public function __construct(public int $x, public int $y, public TreeType $type) {}
}

$start = memory_get_usage();

$forest = [];
for ($i = 0; $i < 10_000; $i++) {
    $forest[] = new Tree($i, $i * 2, TreeTypes::get($i % 2 === 0 ? 'Oak' : 'Pine', 'green'));
}

section('10 000 trees share 2 tree types');
text('TreeType objects: ' . TreeTypes::count());
text(sprintf('Memory used: %d KB', (memory_get_usage() - $start) / 1024));
dump($forest[0]->type === $forest[2]->type);
