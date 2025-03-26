<?php
namespace Scandiweb\Models\Attributes;

abstract class AttributeSet
{
    protected string $id;
    protected string $name;
    protected string $type;

    public function __construct(
        string $id,
        string $name,
        string $type
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }
}