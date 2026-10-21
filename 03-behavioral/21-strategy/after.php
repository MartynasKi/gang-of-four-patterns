<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Strategy: after');

interface ShippingCost
{
    public function for(float $kg): int;
}

final readonly class FlatRate implements ShippingCost
{
    public function __construct(private int $cents) {}

    public function for(float $kg): int
    {
        return $this->cents;
    }
}

final readonly class ByWeight implements ShippingCost
{
    public function __construct(private int $centsPerKg) {}

    public function for(float $kg): int
    {
        return (int) ceil($kg) * $this->centsPerKg;
    }
}

final readonly class FreeShipping implements ShippingCost
{
    public function for(float $kg): int
    {
        return 0;
    }
}

final readonly class Checkout
{
    public function __construct(private ShippingCost $shipping) {}

    public function shipping(float $kg): int
    {
        return $this->shipping->for($kg);
    }
}

section('Pick the strategy from outside');
foreach ([new FlatRate(500), new ByWeight(200), new FreeShipping()] as $strategy) {
    text($strategy::class . ': ' . new Checkout($strategy)->shipping(3.2));
}

success('A new shipping method is a new class. Checkout does not change.');
