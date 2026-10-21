<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Prototype: after');

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

    // Runs on the new copy right after clone
    public function __clone()
    {
        $this->customer = clone $this->customer;
    }

    public function forCustomer(string $name): static
    {
        $copy = clone $this;
        $copy->customer->name = $name;

        return $copy;
    }
}

$template = new Invoice(new Customer('Template customer'), ['Monthly hosting', 'Support']);

section('Each copy gets its own customer');
$acme = $template->forCustomer('Acme');
$globex = $template->forCustomer('Globex');

dump($acme->customer === $template->customer);
dump($template->customer->name, $acme->customer->name, $globex->customer->name);

section('The lines came from the template for free');
dump($globex->lines);
