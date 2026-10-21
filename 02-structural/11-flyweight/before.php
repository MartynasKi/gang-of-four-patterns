<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Flyweight: before');

final readonly class Tree
{
    public function __construct(
        public int $x,
        public int $y,
        public string $name,
        public string $color,
        public string $texture,
    ) {}
}

$start = memory_get_usage();

$forest = [];
for ($i = 0; $i < 10_000; $i++) {
    $name = $i % 2 === 0 ? 'Oak' : 'Pine';
    // Each tree gets its own copy of the same big texture
    $forest[] = new Tree($i, $i * 2, $name, 'green', str_repeat($name, 250));
}

section('10 000 trees, each with its own texture');
text(sprintf('Memory used: %d KB', (memory_get_usage() - $start) / 1024));
