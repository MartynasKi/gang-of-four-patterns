<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Iterator: after');

// Pretend API that returns 2 orders per page
final class OrdersApi
{
    private const array ORDERS = ['#1', '#2', '#3', '#4', '#5'];

    public function page(int $number): array
    {
        return array_slice(self::ORDERS, ($number - 1) * 2, 2);
    }
}

/** @implements IteratorAggregate<int, string> */
final readonly class Orders implements IteratorAggregate
{
    public function __construct(private OrdersApi $api) {}

    // A generator hides the paging and fetches the next page only when needed
    public function getIterator(): Generator
    {
        $page = 1;
        while ($orders = $this->api->page($page++)) {
            yield from $orders;
        }
    }
}

$orders = new Orders(new OrdersApi());

section('The caller just uses foreach');
foreach ($orders as $order) {
    text("Order {$order}");
}

section('It also works with built-in functions');
dump(iterator_to_array($orders, preserve_keys: false));
