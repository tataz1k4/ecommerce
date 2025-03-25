<?php
namespace Scandiweb\Models;

class Price
{
    private int $id;
    private float $amount;
    private string $currencyLabel;
    private string $currencySymbol;
    private Product $product;
    
    public function __construct(float $amount, string $currencyLabel, string $currencySymbol) {
        $this->amount = $amount;
        $this->currencyLabel = $currencyLabel;
        $this->currencySymbol = $currencySymbol;
    }

    public function getProduct(): Product 
    {
        return $this->product; 
    }
    
    public function getFormatted(): string {
        return $this->currencySymbol . number_format($this->amount, 2);
    }
}