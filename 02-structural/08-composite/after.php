<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Composite: after');

// Leaves and containers share one interface
interface Node
{
    public function size(): int;
}

final readonly class File implements Node
{
    public function __construct(public string $name, private int $bytes) {}

    public function size(): int
    {
        return $this->bytes;
    }
}

final readonly class Folder implements Node
{
    /** @param list<Node> $children */
    public function __construct(public string $name, private array $children = []) {}

    public function size(): int
    {
        return array_sum(array_map(fn(Node $child): int => $child->size(), $this->children));
    }
}

$root = new Folder('project', [
    new File('README.md', 1_200),
    new Folder('src', [new File('App.php', 4_000), new File('User.php', 2_500)]),
]);

section('One call works for a file and for a whole tree');
text('README.md: ' . new File('README.md', 1_200)->size());
text('Total bytes: ' . $root->size());

success('The caller never checks whether a node is a file or a folder.');
