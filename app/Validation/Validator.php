<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    protected $errors;
    public function validate($request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getparam($field));
            } catch (NestedValidationException $exception) {
                $this->errors[$field] = $exception->getMessages();
                $_SESSION['errors'] = $this->errors;
            }
        }
        // var_dump($this->errors);
        // die();
        return $this;
    }

    // public function validateImage($param,array $rules)
    // {
    //     $field='image';
    //     // var_dump($param['image']);
    //     // die();
    //     foreach ($rules as $field => $rule) {
    //         try {
    //             $rule->setName(ucfirst($field))->assert($param['image']);
    //         } catch (NestedValidationException $exception) {
    //             $this->errors[$field] = $exception->getMessages();
    //             $_SESSION['errors'] = $this->errors;
    //         }
    //     }
    //     // var_dump($this->errors);
    //     // die();
    //     return $this;
    // }

    public function failed()
    {
     $errors = $this->errors;
        return !empty($errors);
    }
}
