<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Strategy: before');

final class Checkout
{
    public function shipping(string $method, float $kg): int
    {
        // Every new shipping method makes this match longer
        return match ($method) {
            'flat' => 500,
            'weight' => (int) ceil($kg) * 200,
            'free' => 0,
        };
    }
}

$checkout = new Checkout();

section('All shipping formulas live in one method');
dump($checkout->shipping('flat', 3.2));
dump($checkout->shipping('weight', 3.2));
dump($checkout->shipping('free', 3.2));

text('Testing one formula means going through Checkout.');
