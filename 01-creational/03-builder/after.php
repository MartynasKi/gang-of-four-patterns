<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Builder: after');

final readonly class HttpRequest
{
    public function __construct(
        public string $method,
        public string $url,
        public array $headers,
        public ?string $body,
        public int $timeout,
    ) {}
}

final class HttpRequestBuilder
{
    private string $method = 'GET';

    private array $headers = [];

    private ?string $body = null;

    private int $timeout = 30;

    public function __construct(private readonly string $url) {}

    public function method(string $method): static
    {
        $this->method = strtoupper($method);

        return $this;
    }

    public function header(string $name, string $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function json(array $data): static
    {
        $this->body = json_encode($data, JSON_THROW_ON_ERROR);

        return $this->header('Content-Type', 'application/json');
    }

    public function timeout(int $seconds): static
    {
        $this->timeout = $seconds;

        return $this;
    }

    public function build(): HttpRequest
    {
        if ($this->method === 'GET' && $this->body !== null) {
            throw new LogicException('A GET request cannot have a body.');
        }

        return new HttpRequest($this->method, $this->url, $this->headers, $this->body, $this->timeout);
    }
}

section('Build the request step by step');
$request = new HttpRequestBuilder('https://api.test/orders')
    ->method('post')
    ->json(['id' => 1])
    ->timeout(10)
    ->build();
dump($request);

section('build() checks the result');
try {
    new HttpRequestBuilder('https://api.test/orders')->json(['id' => 1])->build();
} catch (LogicException $e) {
    text($e->getMessage());
}
