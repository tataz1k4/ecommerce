<?php
namespace Scandiweb\Models\Attribute;
use Scandiweb\Models\Attribute\AttributeSet;

class AttributeItem
{
    private int $id;
    private string $displayValue;
    private string $value;
    private AttributeSet $attribute;

    public function __construct(
        int $id,
        string $displayValue,
        string $value,
        AttributeSet $attribute
    ) {
        $this->id = $id;
        $this->displayValue = $displayValue;
        $this->value = $value;
        $this->$attribute = $attribute;
    }

    // Getters
    public function getId(): string
    {
        return $this->id;
    }

    public function getDisplayValue(): string
    {
        return $this->displayValue;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getAttribute(): AttributeSet
    {
        return $this->attribute;
    }
}