<?php

namespace App\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArticleValueObject
 */
class ArticleValueObject
{

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $productReference;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var float
     */
    private $floorPrice;


    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var float
     */
    private $highPrice;


    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $productState;


    /**
     * ArticleValueObject constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $fieldName => $value){
            if (property_exists($this, $fieldName) && !is_null($value))
                $this->$fieldName = $value;
        }
    }

    /**
     * @return string
     */
    public function getProductReference(): string
    {
        return $this->productReference;
    }

    /**
     * @return float
     */
    public function getFloorPrice(): float
    {
        return $this->floorPrice;
    }

    /**
     * @return float
     */
    public function getHighPrice(): float
    {
        return $this->highPrice;
    }

    /**
     * @return string
     */
    public function getProductState(): string
    {
        return $this->productState;
    }

}