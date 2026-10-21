<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Singleton: before');

final class Config
{
    public static int $loads = 0;

    private array $values;

    public function __construct()
    {
        // Imagine reading and parsing a big file here
        self::$loads++;
        $this->values = ['app.name' => 'Shop', 'app.debug' => false];
    }

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }
}

section('Every part of the app creates its own Config');
$a = new Config();
$b = new Config();
$c = new Config();

dump($a === $b);
text('Config was loaded ' . Config::$loads . ' times.');
