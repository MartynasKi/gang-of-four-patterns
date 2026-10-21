<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Command: before');

final class Editor
{
    public string $text = '';

    public function append(string $words): void
    {
        $this->text .= $words;
    }
}

$editor = new Editor();

section('Buttons call the editor directly');
$editor->append('Hello');
$editor->append(' world');
dump($editor->text);

section('Undo?');
text('Nothing remembers what happened, so there is nothing to undo.');
text('Queueing, logging or replaying actions is impossible for the same reason.');
