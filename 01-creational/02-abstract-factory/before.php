<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Abstract Factory: before');

final class LightButton
{
    public function render(): string
    {
        return '[ Light button ]';
    }
}

final class DarkButton
{
    public function render(): string
    {
        return '[ Dark button ]';
    }
}

final class LightInput
{
    public function render(): string
    {
        return '| light input |';
    }
}

final class DarkInput
{
    public function render(): string
    {
        return '| dark input |';
    }
}

function renderForm(string $theme): string
{
    $button = $theme === 'dark' ? new DarkButton() : new LightButton();

    // Someone forgot the theme check here
    $input = new LightInput();

    return $input->render() . ' ' . $button->render();
}

section('Theme checks are spread across the code');
text(renderForm('light'));
text(renderForm('dark'));

io()->warning('The dark form got a light input. Nothing stopped the mix.');
