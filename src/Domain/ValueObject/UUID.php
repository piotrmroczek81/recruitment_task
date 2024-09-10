<?php

declare(strict_types=1);



namespace Domain\ValueObject;


class UUID
{
    private string $value;

    public function __construct(string $value)
    {
        // Add validation here
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(UUID $other): bool
    {
        return $this->value === $other->getValue();
    }
}