<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Prototype: before');

final class Customer
{
    public function __construct(public string $name) {}
}

final class Invoice
{
    public function __construct(
        public Customer $customer,
        public array $lines = [],
    ) {}
}

$template = new Invoice(new Customer('Template customer'), ['Monthly hosting', 'Support']);

section('clone copies the invoice, but not the customer inside it');
$invoice = clone $template;
$invoice->customer->name = 'Acme';

dump($invoice->customer === $template->customer);
dump($template->customer->name);

io()->warning('Editing the copy changed the template too.');
