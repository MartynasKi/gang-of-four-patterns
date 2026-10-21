<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Observer: before');

final class Order
{
    public function __construct(public readonly string $id) {}

    public function place(): void
    {
        text("Order {$this->id} placed");

        // Order knows about every side effect
        text("Mailer: confirmation for {$this->id}");
        text("Stock: reduced for {$this->id}");
        text("Analytics: tracked {$this->id}");
    }
}

section('Placing an order does everything itself');
new Order('A-1')->place();

text('A new side effect means editing Order again.');
