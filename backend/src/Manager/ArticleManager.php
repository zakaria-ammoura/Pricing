<?php

namespace App\Manager;

use App\Exception\DataException;
use App\Repository\ArticleRepository;
use App\Utils\PriceHelper;
use App\Utils\ErrorFormatter;
use App\Utils\StateHelper;
use App\ValueObject\ArticleValueObject;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ArticleManager
 */
class ArticleManager
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    private $x;

    private $y;

    /**
     * ArticleManager constructor.
     *
     * @param $x
     * @param $y
     * @param ValidatorInterface $validator
     * @param ArticleRepository  $articleRepository
     */
    public function __construct(
        $x,
        $y,
        ValidatorInterface $validator,
        ArticleRepository $articleRepository
    )
    {
        $this->x = $x;
        $this->y = $y;
        $this->validator = $validator;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param ArticleValueObject $article
     *
     * @return int
     *
     * @throws DataException
     */
    public function calculatePrice(ArticleValueObject $article)
    {
        $this->validateData($article);
        $data = StateHelper::convertObjectToValue(
            $this->articleRepository->findPriceReference($article->getProductReference())
        );
        $status = StateHelper::getStatusId($article->getProductState());
        $nearestStatus = StateHelper::getNearestStatus($data, $status);

        if ($nearestStatus == $status) {
           return $this->getPrice(
                   PriceHelper::centToEuro(PriceHelper::euroToCent($data[$nearestStatus]) - $this->x),
                   $article->getFloorPrice(),
                   $article->getHighPrice()
               );
        }

        if ($nearestStatus > $status) {
            return $this->getPrice(
                    PriceHelper::centToEuro(PriceHelper::euroToCent($data[$nearestStatus]) - $this->y),
                    $article->getFloorPrice(),
                    $article->getHighPrice()
                );
        }

        return $article->getHighPrice();
    }

    /**
     * @param ArticleValueObject $object
     *
     * @throws DataException
     */
    private function validateData(ArticleValueObject $object): void
    {
        $errors = $this->validator->validate($object);

        if (0 === $errors->count()) {
            return;
        }

        throw new DataException(
            DataException::DATA_INVALID,
            Response::HTTP_BAD_REQUEST,
            ErrorFormatter::format($errors)
        );
    }

    /**
     * @param float $price
     * @param float $florePrice
     * @param float $highPrice
     *
     * @return float
     */
    private function getPrice(float $price, float $florePrice, float $highPrice)
    {
        if ($price < $florePrice) {
            return $florePrice;
        }

        if ($price > $highPrice) {
            return $highPrice;
        }

        return $price;
    }
}