<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Observer: after');

interface OrderListener
{
    public function orderPlaced(Order $order): void;
}

final class Order
{
    /** @var list<OrderListener> */
    private array $listeners = [];

    public function __construct(public readonly string $id) {}

    public function subscribe(OrderListener $listener): void
    {
        $this->listeners[] = $listener;
    }

    public function place(): void
    {
        text("Order {$this->id} placed");

        // Order does not know who listens
        foreach ($this->listeners as $listener) {
            $listener->orderPlaced($this);
        }
    }
}

final class SendConfirmation implements OrderListener
{
    public function orderPlaced(Order $order): void
    {
        text("Mailer: confirmation for {$order->id}");
    }
}

final class ReduceStock implements OrderListener
{
    public function orderPlaced(Order $order): void
    {
        text("Stock: reduced for {$order->id}");
    }
}

section('Listeners subscribe to the order');
$order = new Order('A-1');
$order->subscribe(new SendConfirmation());
$order->subscribe(new ReduceStock());
$order->place();

section('Pick different listeners without touching Order');
$quiet = new Order('A-2');
$quiet->subscribe(new ReduceStock());
$quiet->place();
