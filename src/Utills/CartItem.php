<?php

namespace App\Utils;

/**
 * Class CartItem
 * Represents a item in car which in turn can be passed to the Cart class
 *
 * @package App\Utils
 */
class CartItem
{
    /** @var int Unique id for this item */
    protected $id;

    /** @var string Title of the item */
    protected $title;

    /** @var int Number of items */
    protected $quantity = 0;

    /** @var float Price for one item */
    protected $price = 0;

    /** @var int Category of the item */
    protected $category;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (! empty($options)) {
            $this->configure($options);
        }
    }

    /**
     * Configures the Item with the given values
     *
     * $options = [
     *      'id' => 123
     *      'title' => 'Item Title',
     *      'quantity' => 3
     *      'price' => 25.75,
     *      'category' => 1,
     * ];
     *
     * @param array $options
     */
    public function configure(array $options)
    {
        foreach ($options as $option => $value) {
            $method = 'set'.$option;
            if (method_exists($this, $method)) {
                $this->$method($value);
            } elseif (method_exists($this, 'get'.$option)) {
                throw new \LogicException('Cannot set read-only property: '.$option);
            } else {
                $this->$option = $value;
            }
        }
    }

    /**
     * @return int Unique id of the item
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id int Unique id of the item
     * @throws \InvalidArgumentException
     */
    public function setId($id)
    {
        if (false === $this->validateInteger($id)) {
            throw new \InvalidArgumentException('Id must be an integer and not negative');
        }
        $this->id = (int) $id;
    }

    /**
     * @return int category of the item
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $id int category id of the item
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string Title of the item
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title Title of the item
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (false === $this->validateString($title)) {
            throw new \InvalidArgumentException('Title must be a string with at least one character');
        }
        $this->title = (string) $title;
    }

    /**
     * @return int Number of items
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity Number of items
     * @throws \InvalidArgumentException
     */
    public function setQuantity($quantity)
    {
        if (false === $this->validateInteger($quantity)) {
            throw new \InvalidArgumentException('Quantity must be an integer and not negative');
        }
        $this->quantity = (int) $quantity;
    }

    /**
     * @return float Price for one item
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price Price for one item
     * @throws \InvalidArgumentException
     */
    public function setPrice($price)
    {
        if (false === $this->validateFloat($price)) {
            throw new \InvalidArgumentException('Price must be numeric and not negative');
        }
        $this->price = (float) $price;
    }

    /**
     * @return float Total price for all items
     */
    public function getTotal()
    {
        return $this->quantity * $this->price;
    }

    /**
     * Check if the the Item is ready for adding to Cart
     *
     * @return bool return true only if "id, title, quantity and price" is set to non empty values
     */
    public function isValid()
    {
        return $this->validateInteger($this->id) && $this->validateString($this->title) && $this->validateInteger($this->quantity) && $this->validateFloat($this->price);
    }

    public function validateInteger($value)
    {
        $options = ['options' => ['min_range' => 0, 'max_range' => PHP_INT_MAX]];

        return filter_var($value, FILTER_VALIDATE_INT, $options) !== false;
    }

    public function validateFloat($value)
    {
        $options = ['options' => ['decimal' => '.']];

        return filter_var($value, FILTER_VALIDATE_FLOAT, $options) !== false && ($value >= 0);
    }

    public function validateString($value)
    {
        return is_string($value) && strlen($value) > 0;
    }
}
