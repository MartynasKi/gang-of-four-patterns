<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Command: after');

final class Editor
{
    public string $text = '';
}

// An action turned into an object
interface Command
{
    public function execute(): void;

    public function undo(): void;
}

final readonly class Append implements Command
{
    public function __construct(private Editor $editor, private string $words) {}

    public function execute(): void
    {
        $this->editor->text .= $this->words;
    }

    public function undo(): void
    {
        $this->editor->text = substr($this->editor->text, 0, -strlen($this->words));
    }
}

final class History
{
    /** @var list<Command> */
    private array $done = [];

    public function run(Command $command): void
    {
        $command->execute();
        $this->done[] = $command;
    }

    public function undo(): void
    {
        array_pop($this->done)?->undo();
    }
}

$editor = new Editor();
$history = new History();

section('Each action is a Command object');
$history->run(new Append($editor, 'Hello'));
$history->run(new Append($editor, ' world'));
dump($editor->text);

section('History can undo them one by one');
$history->undo();
dump($editor->text);
$history->undo();
dump($editor->text);
