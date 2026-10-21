<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Iterator: before');

// Pretend API that returns 2 orders per page
final class OrdersApi
{
    private const array ORDERS = ['#1', '#2', '#3', '#4', '#5'];

    public function page(int $number): array
    {
        return array_slice(self::ORDERS, ($number - 1) * 2, 2);
    }
}

$api = new OrdersApi();

section('The caller handles the paging');
// Every caller repeats this loop and must know how pages work
$page = 1;
while ($orders = $api->page($page)) {
    foreach ($orders as $order) {
        text("Order {$order}");
    }
    $page++;
}
