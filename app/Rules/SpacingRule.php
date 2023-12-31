<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SpacingRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // Kiểm tra điều kiện của rule
        return !empty($value) && !preg_match('/^\s+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Không nhập nội dung toàn ký tự trắng';
    }
}
