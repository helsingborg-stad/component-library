<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Product;

use ComponentLibrary\Component\ComponentInterface;

interface ProductInterface extends ComponentInterface
{
    /**
     * Product name.
     */
    public function getHeading(): string;

    /**
     * Background color to use.
     */
    public function getBackgroundColor(): string;

    /**
     * An image object.
     */
    public function getImage(): bool;

    /**
     * Array of price objects.
     */
    public function getPrices(): array;

    /**
     * Should currency be displayed before the price.
     */
    public function getCurrencyFirst(): bool;

    /**
     * Label describing the product.
     */
    public function getLabel(): string;

    /**
     * Extra text displayed above bullet points.
     */
    public function getMeta(): string;

    /**
     * Array of bullet points for the product.
     */
    public function getBulletPoints(): array;

    /**
     * The button to display at the bottom.
     */
    public function getButton(): array;

    /**
     * Is the product featured? Make the product stand out from the rest.
     */
    public function getFeatured(): bool;

}
