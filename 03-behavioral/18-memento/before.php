<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Memento: before');

final class Form
{
    // Public only so outside code can copy the state
    public string $title = '';

    public string $body = '';

    public array $tags = [];
}

$form = new Form();
$form->title = 'Draft';
$form->body = 'First version';

section('The caller copies every field to save a draft');
$saved = ['title' => $form->title, 'body' => $form->body, 'tags' => $form->tags];

$form->body = 'Oops, deleted everything';

section('And copies them back to restore');
$form->title = $saved['title'];
$form->body = $saved['body'];
$form->tags = $saved['tags'];
dump($form->body);

text('Add a field to Form and every save and restore spot must change too.');
