<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Facade: before');

final class Inventory
{
    public function reserve(string $sku): void
    {
        text("Inventory: reserved {$sku}");
    }
}

final class Payments
{
    public function charge(string $email, int $cents): void
    {
        text("Payments: charged {$email} {$cents} cents");
    }
}

final class Mailer
{
    public function send(string $email, string $subject): void
    {
        text("Mailer: sent '{$subject}' to {$email}");
    }
}

section('The web controller does every step');
// The same steps, in the same order, are copied into the API controller and the CLI command
new Inventory()->reserve('BOOK-1');
new Payments()->charge('ann@example.com', 2_500);
new Mailer()->send('ann@example.com', 'Order confirmed');

text('Each caller knows three classes and the right order to call them.');
