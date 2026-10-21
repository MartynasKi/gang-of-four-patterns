<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Adapter: after');

// A third-party SDK you cannot change
final class LegacyPaySdk
{
    public function sendPayment(string $amount, string $currency): array
    {
        return ['status' => 'OK', 'amount' => "{$amount} {$currency}"];
    }
}

// The interface your app wants
interface PaymentGateway
{
    public function charge(int $cents): bool;
}

final readonly class LegacyPayAdapter implements PaymentGateway
{
    public function __construct(private LegacyPaySdk $sdk) {}

    public function charge(int $cents): bool
    {
        $amount = number_format($cents / 100, 2, '.', '');

        return $this->sdk->sendPayment($amount, 'EUR')['status'] === 'OK';
    }
}

final readonly class FakeGateway implements PaymentGateway
{
    public function charge(int $cents): bool
    {
        return $cents > 0;
    }
}

final readonly class Checkout
{
    public function __construct(private PaymentGateway $gateway) {}

    public function pay(int $cents): bool
    {
        return $this->gateway->charge($cents);
    }
}

section('Checkout only knows PaymentGateway');
dump(new Checkout(new LegacyPayAdapter(new LegacyPaySdk()))->pay(1250));

section('Any gateway fits, for example a fake in tests');
dump(new Checkout(new FakeGateway())->pay(1250));
