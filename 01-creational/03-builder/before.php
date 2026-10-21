<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Builder: before');

final readonly class HttpRequest
{
    public function __construct(
        public string $method,
        public string $url,
        public array $headers,
        public ?string $body,
        public int $timeout,
        public bool $retry,
    ) {}
}

section('A long constructor call');
// What do 30 and true mean? You have to open the class to know.
$request = new HttpRequest('POST', 'https://api.test/orders', ['Accept' => 'application/json'], '{"id":1}', 30, true);
dump($request);

section('Nothing checks that the parts make sense');
$broken = new HttpRequest('GET', 'https://api.test/orders', [], '{"id":1}', 30, false);
text('A GET request with a body was created without complaint.');
