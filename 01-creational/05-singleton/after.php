<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Singleton: after');

final class Config
{
    public static int $loads = 0;

    private static ?self $instance = null;

    private array $values;

    // private, so nobody else can call new Config()
    private function __construct()
    {
        self::$loads++;
        $this->values = ['app.name' => 'Shop', 'app.debug' => false];
    }

    public static function instance(): self
    {
        return self::$instance ??= new self();
    }

    private function __clone() {}

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }
}

section('Everyone gets the same instance');
$a = Config::instance();
$b = Config::instance();

dump($a === $b);
dump($a->get('app.name'));
text('Config was loaded ' . Config::$loads . ' time.');

section('new is blocked');
try {
    new Config();
} catch (Error $e) {
    text($e->getMessage());
}
