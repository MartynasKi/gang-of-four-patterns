<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Memento: after');

// The memento: a sealed snapshot of the state
final readonly class FormSnapshot
{
    public function __construct(public string $title, public string $body) {}
}

final class Form
{
    private string $title = '';

    private string $body = '';

    public function write(string $title, string $body): void
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function save(): FormSnapshot
    {
        return new FormSnapshot($this->title, $this->body);
    }

    public function restore(FormSnapshot $snapshot): void
    {
        $this->title = $snapshot->title;
        $this->body = $snapshot->body;
    }
}

$form = new Form();
$drafts = [];

section('The form saves itself');
$form->write('Draft', 'First version');
$drafts[] = $form->save();

$form->write('Draft', 'Oops, deleted everything');
dump($form->body());

section('And restores itself');
$form->restore(array_pop($drafts));
dump($form->body());
