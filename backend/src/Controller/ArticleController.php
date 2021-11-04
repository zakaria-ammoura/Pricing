<?php

namespace App\Controller;

use App\Exception\DataException;
use App\Manager\ArticleManager;
use App\Utils\ErrorFormatter;
use App\ValueObject\ArticleValueObject;
use FOS\RestBundle\{Controller\AbstractFOSRestController,
    Controller\Annotations as Rest,
    Request\ParamFetcherInterface,
    View\View
};
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 *
 * @Rest\Route("api/article")
 */
class ArticleController extends AbstractFOSRestController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ArticleManager
     */
    private $articleManager;

    /**
     * ArticleController constructor.
     *
     * @param LoggerInterface $logger
     * @param ArticleManager $articleManager
     */
    public function __construct(
        LoggerInterface $logger,
        ArticleManager $articleManager
    )
    {
        $this->logger = $logger;
        $this->articleManager = $articleManager;
    }

    /**
     * @param ParamFetcherInterface $paramFetcher
     *
     * @Rest\View()
     * @Rest\Get("/price")
     *
     * @Rest\QueryParam(name="productReference", description="product reference", strict=true, nullable=false)
     * @Rest\QueryParam(name="floorPrice", description="floor Price", strict=true, nullable=false)
     * @Rest\QueryParam(name="highPrice", description="high price", strict=true, nullable=false)
     * @Rest\QueryParam(name="productState", description="product state", strict=true, nullable=false)
     *
     * @return View
     */
    public function calculatePrice(ParamFetcherInterface $paramFetcher): View
    {
        try {
            $price = $this->articleManager->calculatePrice(
                new ArticleValueObject($paramFetcher->all())
            );

            return $this->view(
                [
                    'price' => $price
                ],
                Response::HTTP_OK
            );
        } catch (DataException $exception) {
            return $this->view(
                [
                    'message' => $exception->getMessage(),
                    'data' => $exception->getData()
                ], $exception->getCode()
            );
        } catch (\Throwable $throwable) {
            $this->logger->error(
                $throwable->getMessage(),
                [
                    'file' => $throwable->getFile(),
                    'line' => $throwable->getLine(),
                    'trace' => $throwable->getTrace()
                ]
            );

            return $this->view(ErrorFormatter::EXCEPTION_DEFAULT_MESSAGE, $throwable->getCode());
        }
    }
}
