<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Visitor: before');

// Every operation is a method on every shape
final readonly class Circle
{
    public function __construct(public float $radius) {}

    public function area(): float
    {
        return round(M_PI * $this->radius ** 2, 2);
    }

    public function toJson(): string
    {
        return json_encode(['type' => 'circle', 'radius' => $this->radius]);
    }
}

final readonly class Rectangle
{
    public function __construct(public float $width, public float $height) {}

    public function area(): float
    {
        return $this->width * $this->height;
    }

    public function toJson(): string
    {
        return json_encode(['type' => 'rectangle', 'width' => $this->width, 'height' => $this->height]);
    }
}

$shapes = [new Circle(1), new Rectangle(2, 3)];

section('Each shape does every job itself');
foreach ($shapes as $shape) {
    text($shape->toJson() . ' area: ' . $shape->area());
}

text('A third operation, such as SVG export, means editing every shape class.');
