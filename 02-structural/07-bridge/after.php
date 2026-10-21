<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Bridge: after');

// Implementation side: how to send
interface Channel
{
    public function send(string $text): string;
}

final class EmailChannel implements Channel
{
    public function send(string $text): string
    {
        return "Email: {$text}";
    }
}

final class SmsChannel implements Channel
{
    public function send(string $text): string
    {
        return "SMS: {$text}";
    }
}

final class SlackChannel implements Channel
{
    public function send(string $text): string
    {
        return "Slack: {$text}";
    }
}

// Abstraction side: what to send. It holds a Channel, which is the bridge.
abstract readonly class Notification
{
    public function __construct(protected Channel $channel) {}

    abstract public function send(): string;
}

final readonly class OrderShipped extends Notification
{
    public function send(): string
    {
        return $this->channel->send('Your order shipped');
    }
}

final readonly class InvoiceReady extends Notification
{
    public function send(): string
    {
        return $this->channel->send('Your invoice is ready');
    }
}

section('Mix any type with any channel');
foreach ([OrderShipped::class, InvoiceReady::class] as $type) {
    foreach ([new EmailChannel(), new SmsChannel(), new SlackChannel()] as $channel) {
        text(new $type($channel)->send());
    }
}

success('2 types + 3 channels = 5 classes instead of 6. The gap grows with every new one.');
