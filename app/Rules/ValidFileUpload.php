<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Storage;

class ValidFileUpload implements ValidationRule
{
    public function __construct(
        private readonly array $validMimeTypes
    ) {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Storage::exists($value)) {
            $fail('The file does not exist.');
        }
        if (!in_array(Storage::mimeType($value), $this->validMimeTypes, true)) {
            $fail('The file is not a valid mime type.');
        }
    }
}
