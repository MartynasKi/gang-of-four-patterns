<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Factory Method: after');

interface Message
{
    public function deliver(): string;
}

final readonly class EmailMessage implements Message
{
    public function __construct(private string $text) {}

    public function deliver(): string
    {
        return "Email: {$this->text}";
    }
}

final readonly class SmsMessage implements Message
{
    public function __construct(private string $text) {}

    public function deliver(): string
    {
        return "SMS: {$this->text}";
    }
}

final readonly class SlackMessage implements Message
{
    public function __construct(private string $text) {}

    public function deliver(): string
    {
        return "Slack: {$this->text}";
    }
}

abstract class Notifier
{
    // The factory method. Subclasses decide which Message to create.
    abstract protected function createMessage(string $text): Message;

    public function send(string $text): string
    {
        return $this->createMessage($text)->deliver();
    }
}

final class EmailNotifier extends Notifier
{
    protected function createMessage(string $text): Message
    {
        return new EmailMessage($text);
    }
}

final class SmsNotifier extends Notifier
{
    protected function createMessage(string $text): Message
    {
        return new SmsMessage($text);
    }
}

// Added later without touching Notifier
final class SlackNotifier extends Notifier
{
    protected function createMessage(string $text): Message
    {
        return new SlackMessage($text);
    }
}

section('Each subclass creates its own message');
foreach ([new EmailNotifier(), new SmsNotifier(), new SlackNotifier()] as $notifier) {
    text($notifier->send('Your order shipped'));
}

success('Slack was added as a new class. Notifier did not change.');
