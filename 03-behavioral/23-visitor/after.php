<?php

declare(strict_types=1);

require __DIR__ . '/../../bootstrap.php';

title('Visitor: after');

interface ShapeVisitor
{
    public function visitCircle(Circle $circle): mixed;

    public function visitRectangle(Rectangle $rectangle): mixed;
}

interface Shape
{
    public function accept(ShapeVisitor $visitor): mixed;
}

// Shapes only hold data and say which visit method to call
final readonly class Circle implements Shape
{
    public function __construct(public float $radius) {}

    public function accept(ShapeVisitor $visitor): mixed
    {
        return $visitor->visitCircle($this);
    }
}

final readonly class Rectangle implements Shape
{
    public function __construct(public float $width, public float $height) {}

    public function accept(ShapeVisitor $visitor): mixed
    {
        return $visitor->visitRectangle($this);
    }
}

// Each operation is one visitor class
final class AreaVisitor implements ShapeVisitor
{
    public function visitCircle(Circle $circle): float
    {
        return round(M_PI * $circle->radius ** 2, 2);
    }

    public function visitRectangle(Rectangle $rectangle): float
    {
        return $rectangle->width * $rectangle->height;
    }
}

final class JsonVisitor implements ShapeVisitor
{
    public function visitCircle(Circle $circle): string
    {
        return json_encode(['type' => 'circle', 'radius' => $circle->radius]);
    }

    public function visitRectangle(Rectangle $rectangle): string
    {
        return json_encode(['type' => 'rectangle', 'width' => $rectangle->width, 'height' => $rectangle->height]);
    }
}

$shapes = [new Circle(1), new Rectangle(2, 3)];

section('Same shapes, different visitors');
foreach ($shapes as $shape) {
    text($shape->accept(new JsonVisitor()) . ' area: ' . $shape->accept(new AreaVisitor()));
}

success('A new operation is a new visitor. The shape classes stay the same.');
