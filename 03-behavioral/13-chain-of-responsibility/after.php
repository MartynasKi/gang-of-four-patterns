<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Chain of Responsibility: after');

final readonly class Request
{
    public function __construct(public ?string $user, public int $attempts = 1) {}
}

abstract class Middleware
{
    private ?Middleware $next = null;

    public function then(Middleware $next): Middleware
    {
        $this->next = $next;

        return $next;
    }

    // Pass the request on, or finish when this is the last link
    public function handle(Request $request): string
    {
        return $this->next?->handle($request) ?? '200 OK';
    }
}

final class Authenticate extends Middleware
{
    public function handle(Request $request): string
    {
        return $request->user === null ? '401 Unauthorized' : parent::handle($request);
    }
}

final class RateLimit extends Middleware
{
    public function __construct(private readonly int $max) {}

    public function handle(Request $request): string
    {
        return $request->attempts > $this->max ? '429 Too Many Requests' : parent::handle($request);
    }
}

$chain = new Authenticate();
$chain->then(new RateLimit(max: 3));

section('Each link checks one thing and passes the rest on');
text($chain->handle(new Request(user: null)));
text($chain->handle(new Request(user: 'ann', attempts: 5)));
text($chain->handle(new Request(user: 'ann')));

section('A single link works on its own too');
text(new RateLimit(max: 10)->handle(new Request(user: null, attempts: 5)));
