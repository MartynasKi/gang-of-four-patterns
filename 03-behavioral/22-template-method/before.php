<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Template Method: before');

const SALES = [['product' => 'Book', 'total' => 25], ['product' => 'Pen', 'total' => 0]];

// The same steps are copied into each export, only the format differs
final class CsvExport
{
    public function export(): string
    {
        $rows = SALES;
        $rows = array_filter($rows, fn(array $row): bool => $row['total'] > 0);

        return implode("\n", array_map(fn(array $row): string => implode(',', $row), $rows));
    }
}

final class JsonExport
{
    public function export(): string
    {
        $rows = SALES;
        $rows = array_filter($rows, fn(array $row): bool => $row['total'] > 0);

        return json_encode(array_values($rows), JSON_THROW_ON_ERROR);
    }
}

section('Two exports, duplicated steps');
text(new CsvExport()->export());
text(new JsonExport()->export());

text('Change how rows are loaded or filtered and you edit both classes.');
