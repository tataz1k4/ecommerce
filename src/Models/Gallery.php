<?php
namespace Scandiweb\Models;

class Gallery
{
    private int $id;
    private string $imageUrl;
    private Product $product;

    public function __construct(string $url) 
    {
        $this->imageUrl = $url;
    }

    // Getters
    public function getUrl(): string
    {
        return $this->imageUrl;
    }

    public function getProduct(): Product 
    {
        return $this->product; 
    }

    // Create from JSON
    public static function fromArray(string $url): self
    {
        return new self($url);
    }
}