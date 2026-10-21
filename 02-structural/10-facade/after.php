<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Facade: after');

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

// One simple entry point in front of the subsystem
final readonly class OrderService
{
    public function __construct(
        private Inventory $inventory = new Inventory(),
        private Payments $payments = new Payments(),
        private Mailer $mailer = new Mailer(),
    ) {}

    public function placeOrder(string $sku, string $email, int $cents): void
    {
        $this->inventory->reserve($sku);
        $this->payments->charge($email, $cents);
        $this->mailer->send($email, 'Order confirmed');
    }
}

section('Callers make one call');
new OrderService()->placeOrder('BOOK-1', 'ann@example.com', 2_500);

success('The order of steps lives in one place.');
