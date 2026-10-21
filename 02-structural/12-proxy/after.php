<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Proxy: after');

interface Report
{
    public function title(): string;

    public function content(): string;
}

final readonly class RealReport implements Report
{
    private string $content;

    public function __construct(private string $title)
    {
        text("Running a slow query for '{$title}'...");
        $this->content = "Rows for {$title}";
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }
}

// Same interface, but creates the real report only when needed
final class LazyReport implements Report
{
    private ?RealReport $real = null;

    public function __construct(private readonly string $title) {}

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        $this->real ??= new RealReport($this->title);

        return $this->real->content();
    }
}

$reports = [new LazyReport('Sales'), new LazyReport('Stock'), new LazyReport('Refunds')];

section('Listing titles runs no queries');
foreach ($reports as $report) {
    text("- {$report->title()}");
}

section('Reading content runs the query once');
dump($reports[0]->content());
dump($reports[0]->content());
