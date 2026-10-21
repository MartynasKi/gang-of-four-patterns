<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Composite: before');

final readonly class File
{
    public function __construct(public string $name, public int $bytes) {}
}

final readonly class Folder
{
    public function __construct(public string $name, public array $children = []) {}
}

// The caller must know every kind of node and walk the tree itself
function size(File|Folder $item): int
{
    if ($item instanceof File) {
        return $item->bytes;
    }

    $total = 0;
    foreach ($item->children as $child) {
        $total += size($child);
    }

    return $total;
}

$root = new Folder('project', [
    new File('README.md', 1_200),
    new Folder('src', [new File('App.php', 4_000), new File('User.php', 2_500)]),
]);

section('Outside code walks the tree');
text('Total bytes: ' . size($root));

text('Add a Symlink type and every function like size() needs a new branch.');
