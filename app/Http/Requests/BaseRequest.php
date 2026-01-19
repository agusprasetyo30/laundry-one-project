<?php

namespace App\Http\Requests;

use App\Exceptions\ApiValidationException;
use App\Helpers\General;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
   protected function failedValidation(Validator $validator)
   {
      // untuk cek apakah data berupa JSON atau AJAX
      if ($this->isJson() || $this->expectsJson() || $this->ajax()) {
         throw new ApiValidationException($validator, $this->validationErrorMessage());
      }

      parent::failedValidation($validator);
   }
   
   public function validationErrorMessage(): string
   {
      return "The given data was invalid: " . General::convertMessageError($this->validator->errors()->all());
   }
}
