<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Adapter: before');

// A third-party SDK you cannot change
final class LegacyPaySdk
{
    public function sendPayment(string $amount, string $currency): array
    {
        return ['status' => 'OK', 'amount' => "{$amount} {$currency}"];
    }
}

final class Checkout
{
    public function __construct(private LegacyPaySdk $sdk) {}

    public function pay(int $cents): bool
    {
        // SDK details leak into your own code
        $amount = number_format($cents / 100, 2, '.', '');
        $response = $this->sdk->sendPayment($amount, 'EUR');

        return $response['status'] === 'OK';
    }
}

section('Checkout talks to the SDK directly');
dump(new Checkout(new LegacyPaySdk())->pay(1250));

text('Switching provider means rewriting Checkout and every other class that uses the SDK.');
