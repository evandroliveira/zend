<?php

namespace Sabium\Service\Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class ObjectValidator
{
    protected $validation;

    public function __construct(ValidatorInterface $validation)
    {
        $this->validation = $validation;
    }

    public function validate($object): bool
    {
        $violations = $this->validation->validate($object);
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                $this->errors["Errors"][] = ["message" => $violation->getMessage()];
            }
            return false;
        }
        return true;
    }

    /**
     * Mensagens de erro
     * 
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
