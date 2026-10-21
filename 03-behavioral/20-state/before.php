<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('State: before');

final class Order
{
    public string $status = 'draft';

    // Every method checks the status with its own if
    public function pay(): void
    {
        if ($this->status !== 'draft') {
            throw new LogicException("Cannot pay a {$this->status} order.");
        }
        $this->status = 'paid';
    }

    public function ship(): void
    {
        if ($this->status !== 'paid') {
            throw new LogicException("Cannot ship a {$this->status} order.");
        }
        $this->status = 'shipped';
    }

    public function cancel(): void
    {
        if ($this->status === 'shipped') {
            throw new LogicException('Cannot cancel a shipped order.');
        }
        $this->status = 'cancelled';
    }
}

$order = new Order();

section('Status rules are spread across methods');
$order->pay();
$order->ship();
dump($order->status);

section('A typo slips through');
$order->status = 'shiped';
$order->cancel();
dump($order->status);

io()->warning('A shipped order was cancelled because of one typo.');
