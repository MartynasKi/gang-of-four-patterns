<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Chain of Responsibility: before');

final readonly class Request
{
    public function __construct(public ?string $user, public int $attempts = 1) {}
}

function handle(Request $request): string
{
    // Every new check goes into this one function, in a fixed order
    if ($request->user === null) {
        return '401 Unauthorized';
    }

    if ($request->attempts > 3) {
        return '429 Too Many Requests';
    }

    return '200 OK';
}

section('All checks live in one function');
text(handle(new Request(user: null)));
text(handle(new Request(user: 'ann', attempts: 5)));
text(handle(new Request(user: 'ann')));

text('To reuse the rate limit check on another route you copy it, or add more flags.');
