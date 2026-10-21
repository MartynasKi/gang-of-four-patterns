<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Factory Method: before');

final readonly class EmailMessage
{
    public function __construct(private string $text) {}

    public function deliver(): string
    {
        return "Email: {$this->text}";
    }
}

final readonly class SmsMessage
{
    public function __construct(private string $text) {}

    public function deliver(): string
    {
        return "SMS: {$this->text}";
    }
}

final class Notifier
{
    public function send(string $channel, string $text): string
    {
        // Every new channel means editing this class
        $message = match ($channel) {
            'email' => new EmailMessage($text),
            'sms' => new SmsMessage($text),
        };

        return $message->deliver();
    }
}

$notifier = new Notifier();

section('The notifier knows every message class');
text($notifier->send('email', 'Your order shipped'));
text($notifier->send('sms', 'Your order shipped'));

section('A new channel needs a change inside Notifier');
try {
    $notifier->send('slack', 'Your order shipped');
} catch (UnhandledMatchError $e) {
    text($e->getMessage());
}
