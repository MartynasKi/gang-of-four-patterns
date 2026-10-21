<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('State: after');

// Each state decides what can happen next
enum OrderStatus: string
{
    case Draft = 'draft';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Cancelled = 'cancelled';

    public function pay(): self
    {
        return match ($this) {
            self::Draft => self::Paid,
            default => throw new LogicException("Cannot pay a {$this->value} order."),
        };
    }

    public function ship(): self
    {
        return match ($this) {
            self::Paid => self::Shipped,
            default => throw new LogicException("Cannot ship a {$this->value} order."),
        };
    }

    public function cancel(): self
    {
        return match ($this) {
            self::Draft, self::Paid => self::Cancelled,
            default => throw new LogicException("Cannot cancel a {$this->value} order."),
        };
    }
}

// The context delegates to its current state
final class Order
{
    public private(set) OrderStatus $status = OrderStatus::Draft;

    public function pay(): void
    {
        $this->status = $this->status->pay();
    }

    public function ship(): void
    {
        $this->status = $this->status->ship();
    }

    public function cancel(): void
    {
        $this->status = $this->status->cancel();
    }
}

$order = new Order();

section('The state moves the order forward');
$order->pay();
$order->ship();
dump($order->status);

section('Invalid moves are rejected by the state');
try {
    $order->cancel();
} catch (LogicException $e) {
    text($e->getMessage());
}
