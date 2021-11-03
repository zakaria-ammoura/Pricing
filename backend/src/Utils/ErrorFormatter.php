<?php

namespace App\Utils;

use Symfony\Component\Validator\ConstraintViolationListInterface;


/**
 * Class ErrorFormatter
 */
class ErrorFormatter
{
    const EXCEPTION_DEFAULT_MESSAGE = "Une erreur s'est produite lors de l'exécution, veuillez contacter le support.";

    /**
     * @param ConstraintViolationListInterface $violationList
     *
     * @return array
     */
    public static function format(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];
        foreach ($violationList as $error) {
            $errors[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errors;
    }
}
