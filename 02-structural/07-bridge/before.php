<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Bridge: before');

// One class for every type and channel pair
final class OrderShippedEmail
{
    public function send(): string
    {
        return 'Email: Your order shipped';
    }
}

final class OrderShippedSms
{
    public function send(): string
    {
        return 'SMS: Your order shipped';
    }
}

final class InvoiceReadyEmail
{
    public function send(): string
    {
        return 'Email: Your invoice is ready';
    }
}

final class InvoiceReadySms
{
    public function send(): string
    {
        return 'SMS: Your invoice is ready';
    }
}

section('Four classes for two types and two channels');
foreach ([new OrderShippedEmail(), new OrderShippedSms(), new InvoiceReadyEmail(), new InvoiceReadySms()] as $notification) {
    text($notification->send());
}

io()->warning('Add a Slack channel and you need two more classes. Add a type and you need three.');
