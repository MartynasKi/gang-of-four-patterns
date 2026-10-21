<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Interpreter: before');

function validate(string $value, string $rules): bool
{
    // Parsing and checking are mixed, and the rules string is parsed on every call
    foreach (explode('|', $rules) as $rule) {
        [$name, $argument] = array_pad(explode(':', $rule, 2), 2, null);

        $passes = match ($name) {
            'required' => $value !== '',
            'min' => mb_strlen($value) >= (int) $argument,
            'max' => mb_strlen($value) <= (int) $argument,
        };

        if (! $passes) {
            return false;
        }
    }

    return true;
}

section('One function parses and checks at the same time');
dump(validate('Ann', 'required|min:3'));
dump(validate('Al', 'required|min:3'));
dump(validate('', 'required|min:3'));

text('Each new rule makes this match longer and harder to test on its own.');
