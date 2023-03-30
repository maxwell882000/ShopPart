<?php

namespace App\Domain\Core\Main\Traits;

use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;

trait ValidationTrait
{
    protected function validating(array $object_data, array $rules)
    {
        $validator = Validator::make(
            $object_data,
            $rules,
            $this->validationMessage()
        );
        if ($validator->fails()) {
            $result = $this->errorResult($validator);
            throw  new ValidationException($result);
        }
    }

    protected function errorResult($validator)
    {
        $errors = $validator->errors()->toArray();
        $collapsed = collect($errors)->collapse();
        return $collapsed->join(self::validationSeparator());
    }

    static public function validationSeparator(): string
    {
        return "<br>";
    }

    protected function validationMessage(): array
        {

        return [];
    }
}
