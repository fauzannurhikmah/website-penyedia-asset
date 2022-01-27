<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileType implements Rule
{
    public $formatFile;
    public function __construct($data)
    {
        $this->formatFile = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = explode('.', $this->formatFile);
        if (end($result) == "blend" || end($result) == "c4d" || end($result) == "obj" || end($result) == "3ds" || end($result) == "fbx" || end($result) == "max")
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute asset must be blend, c4d, obj, 3ds, fbx, max.';
    }
}
