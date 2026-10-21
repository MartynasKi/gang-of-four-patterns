<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Interpreter: after');

// Each piece of the rule language is one class
interface Rule
{
    public function passes(string $value): bool;
}

final readonly class Required implements Rule
{
    public function passes(string $value): bool
    {
        return $value !== '';
    }
}

final readonly class Min implements Rule
{
    public function __construct(private int $length) {}

    public function passes(string $value): bool
    {
        return mb_strlen($value) >= $this->length;
    }
}

final readonly class Max implements Rule
{
    public function __construct(private int $length) {}

    public function passes(string $value): bool
    {
        return mb_strlen($value) <= $this->length;
    }
}

// "a|b" means all rules must pass
final readonly class AllOf implements Rule
{
    /** @param list<Rule> $rules */
    public function __construct(private array $rules) {}

    public function passes(string $value): bool
    {
        return array_all($this->rules, fn(Rule $rule): bool => $rule->passes($value));
    }
}

// Turns text into a tree of Rule objects, once
function parse(string $rules): Rule
{
    return new AllOf(array_map(function (string $rule): Rule {
        [$name, $argument] = array_pad(explode(':', $rule, 2), 2, null);

        return match ($name) {
            'required' => new Required(),
            'min' => new Min((int) $argument),
            'max' => new Max((int) $argument),
        };
    }, explode('|', $rules)));
}

section('Parse once into objects');
$rule = parse('required|min:3');
dump($rule);

section('Then interpret it for any value');
dump($rule->passes('Ann'));
dump($rule->passes('Al'));
dump($rule->passes(''));
