<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Proxy: before');

final class Report
{
    private string $content;

    public function __construct(public readonly string $title)
    {
        // The heavy work happens even if nobody reads the content
        text("Running a slow query for '{$title}'...");
        $this->content = "Rows for {$title}";
    }

    public function content(): string
    {
        return $this->content;
    }
}

section('Listing titles still builds every report');
$reports = [new Report('Sales'), new Report('Stock'), new Report('Refunds')];

foreach ($reports as $report) {
    text("- {$report->title}");
}
