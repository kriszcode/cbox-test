<?php

declare(strict_types=1);

namespace App;

interface Shape
{
    /**
     * A síkidom területe.
     */
    public function area(): float;

    public function name(): string;
}

final class Circle implements Shape
{
    public function __construct(private float $radius)
    {
    }

    public function area(): float
    {
        return M_PI * $this->radius ** 2;
    }

    public function name(): string
    {
        return 'kör';
    }
}

final class Rectangle implements Shape
{
    public function __construct(private float $width, private float $height)
    {
    }

    public function area(): float
    {
        return $this->width * $this->height;
    }

    public function name(): string
    {
        return 'téglalap';
    }
}
