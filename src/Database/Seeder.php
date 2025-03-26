<?php
namespace Scandiweb\Database;

use PDO;
use Scandiweb\Models\Category;
use Scandiweb\Models\Product;
use Scandiweb\Models\Attribute\AttributeSet;
use Scandiweb\Models\Attribute\AttributeItem;
use Scandiweb\Models\Price;
use Scandiweb\Models\GalleryImage;

class Seeder
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function run(string $jsonFilePath): void
    {
        try {
            $data = $this->loadAndValidateJson($jsonFilePath);
            $categoryMap = $this->seedCategories($data['categories']);
            $this->seedProducts($data['products'], $categoryMap);

            echo "Database seeded successfully!\n";
        } catch (\Exception $e) {
            throw new \RuntimeException("Seeder failed: " . $e->getMessage());
        }
    }

    private function truncateTables(): void
    {
        $tables = [
            'attribute_items',
            'attributes',
            'gallery',
            'prices',
            'products',
            'categories'
        ];

        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($tables as $table) {
            $this->pdo->exec("TRUNCATE TABLE $table");
        }
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    }

    private function loadAndValidateJson(string $path): array
    {
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON: " . json_last_error_msg());
        }

        return $data['data'];
    }

    private function seedCategories(array $categories): array
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO categories (name) VALUES (?)"
        );

        $map = [];
        foreach ($categories as $category) {
            $stmt->execute([$category['name']]);
            $map[$category['name']] = $this->pdo->lastInsertId();
        }

        return $map;
    }

    private function seedProducts(array $products, array $categoryMap): void
    {
        $productStmt = $this->pdo->prepare(
            "INSERT INTO products 
            (id, name, in_stock, description, category_id, brand) 
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        foreach ($products as $product) {
            $productStmt->execute([
                $product['id'],
                $product['name'],
                $product['inStock'] ? 1 : 0,
                strip_tags($product['description']),
                $categoryMap[$product['category']],
                $product['brand']
            ]);

            $this->seedPrices($product['id'], $product['prices']);
            $this->seedAttributes($product['id'], $product['attributes']);
            $this->seedGallery($product['id'], $product['gallery']);
        }
    }

    private function seedPrices(string $productId, array $prices): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO prices 
            (product_id, amount, currency_label, currency_symbol) 
            VALUES (?, ?, ?, ?)"
        );

        foreach ($prices as $price) {
            $stmt->execute([
                $productId,
                $price['amount'],
                $price['currency']['label'],
                $price['currency']['symbol'],
            ]);
        }
    }

    private function seedAttributes(string $productId, array $attributes): void
    {
        $attrStmt = $this->pdo->prepare(
            "INSERT INTO attributes 
            (product_id, name, type) 
            VALUES (?, ?, ?)"
        );

        $itemStmt = $this->pdo->prepare(
            "INSERT INTO attribute_items 
            (attribute_id, display_value, value) 
            VALUES (?, ?, ?)"
        );

        foreach ($attributes as $attribute) {
            $attrStmt->execute([
                $productId,
                $attribute['name'],
                $attribute['type'],
            ]);

            $attributeId = $this->pdo->lastInsertId();

            foreach ($attribute['items'] as $item) {
                $itemStmt->execute([
                    $attributeId,
                    $item['displayValue'],
                    $item['value'],
                ]);
            }
        }
    }

    private function seedGallery(string $productId, array $gallery): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO gallery (product_id, image_url) VALUES (?, ?)"
        );

        foreach ($gallery as $imageUrl) {
            $stmt->execute([$productId, $imageUrl]);
        }
    }
}