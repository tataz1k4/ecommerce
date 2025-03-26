<?php
namespace Scandiweb\Models;

class Category
{
    private string $name;

    public function __construct(string $name) 
    {
        $this->name = $name;
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    // Create from JSON
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
        );
    }
}