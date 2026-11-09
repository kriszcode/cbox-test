<?php

declare(strict_types=1);

require __DIR__ . '/src/Shape.php';

use App\Circle;
use App\Rectangle;
use App\Shape;

/**
 * @param Shape[] $shapes
 */
function totalArea(array $shapes): float
{
    return array_sum(array_map(fn (Shape $s) => $s->area(), $shapes));
}

function report(array $shapes): void
{
    foreach ($shapes as $shape) {
        printf("%-10s %8.2f\n", $shape->name(), $shape->area());
    }
    printf("%-10s %8.2f\n", 'összesen', totalArea($shapes));
}

report([new Circle(1.5), new Rectangle(2, 3)]);