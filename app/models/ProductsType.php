<?php
class DVD extends ProductType {
    private $size;

    public function __construct($size) {
        $this->size = $size;
    }

    public function getDescription() {
        return "Size: {$this->size} MB";
    }
}

class Book extends ProductType {
    private $weight;

    public function __construct($weight) {
        $this->weight = $weight;
    }

    public function getDescription() {
        return "Weight: {$this->weight} Kg";
    }
}

class Furniture extends ProductType {
    private $height;
    private $width;
    private $length;

    public function __construct($height, $width, $length) {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getDescription() {
        return "Dimensions: {$this->height}x{$this->width}x{$this->length}";
    }
}
