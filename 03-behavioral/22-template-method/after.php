<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Template Method: after');

abstract class ReportExport
{
    // The template method: fixed steps, final so nobody changes the order
    final public function export(): string
    {
        return $this->format($this->filter($this->load()));
    }

    protected function load(): array
    {
        return [['product' => 'Book', 'total' => 25], ['product' => 'Pen', 'total' => 0]];
    }

    // A hook: subclasses may override it
    protected function filter(array $rows): array
    {
        return array_values(array_filter($rows, fn(array $row): bool => $row['total'] > 0));
    }

    // A step every subclass must write
    abstract protected function format(array $rows): string;
}

final class CsvExport extends ReportExport
{
    protected function format(array $rows): string
    {
        return implode("\n", array_map(fn(array $row): string => implode(',', $row), $rows));
    }
}

final class JsonExport extends ReportExport
{
    protected function format(array $rows): string
    {
        return json_encode($rows, JSON_THROW_ON_ERROR);
    }
}

final class FullJsonExport extends ReportExport
{
    protected function filter(array $rows): array
    {
        return $rows;
    }

    protected function format(array $rows): string
    {
        return json_encode($rows, JSON_THROW_ON_ERROR);
    }
}

section('Subclasses only fill in the steps that differ');
text(new CsvExport()->export());
text(new JsonExport()->export());

section('A hook changes one step');
text(new FullJsonExport()->export());
