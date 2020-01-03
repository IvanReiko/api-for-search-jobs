<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CheckUserPassword implements Rule
{
    protected $models;
    protected $is;

    /**
     * Create a new rule instance.
     *
     * @param bool $is
     * @param object $models
     *
     * @return void
     */
    public function __construct($is = true, $models = false)
    {
        $this->models = $models ? $models : request()->user();
        $this->is = $is;
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
        if($this->is){
            return Hash::check($value, $this->models->password);
        }else{
            return !Hash::check($value, $this->models->password);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->is){
            return 'The :attribute was invalid.';
        }else{
            return 'The :attribute are the same.';
        }
    }
}
