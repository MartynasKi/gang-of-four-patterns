<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Abstract Factory: after');

interface Button
{
    public function render(): string;
}

interface Input
{
    public function render(): string;
}

// One factory creates the whole family
interface ThemeFactory
{
    public function createButton(): Button;

    public function createInput(): Input;
}

final class LightButton implements Button
{
    public function render(): string
    {
        return '[ Light button ]';
    }
}

final class DarkButton implements Button
{
    public function render(): string
    {
        return '[ Dark button ]';
    }
}

final class LightInput implements Input
{
    public function render(): string
    {
        return '| light input |';
    }
}

final class DarkInput implements Input
{
    public function render(): string
    {
        return '| dark input |';
    }
}

final class LightTheme implements ThemeFactory
{
    public function createButton(): Button
    {
        return new LightButton();
    }

    public function createInput(): Input
    {
        return new LightInput();
    }
}

final class DarkTheme implements ThemeFactory
{
    public function createButton(): Button
    {
        return new DarkButton();
    }

    public function createInput(): Input
    {
        return new DarkInput();
    }
}

function renderForm(ThemeFactory $theme): string
{
    return $theme->createInput()->render() . ' ' . $theme->createButton()->render();
}

section('The form asks one factory for every part');
text(renderForm(new LightTheme()));
text(renderForm(new DarkTheme()));

success('Pick the theme once. The parts always match.');
