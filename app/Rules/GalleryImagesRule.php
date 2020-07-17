<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GalleryImagesRule implements Rule
{
    protected $mimeOk = true;
    protected $sizeOk = true;
    
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

        $length = count($value);

        $mime = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        $size = 0;
        foreach ($value as $image) {
            if (!in_array($image->getMimeType(), $mime)) {
                $this->mimeOk = false;
                break;
            }
            $size += $image->getSize();
            if ($size >= 16777216) {
                
                $this->sizeOk = false;    
                break;
            }
        }
        return $this->sizeOk & $this->mimeOk;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = '';

        if ($this->sizeOk === false) {
            $message = 'A feltöltendő fájlok mérete meghaladja a maximális 16MB-ot.';
        }

        if ($this->mimeOk === false) {
            $message = 'Rossz fájltípust akartál feltölteni. A megengedett típusok: .jpg, .jpeg, .png, .gif. Ne akarj átverni!';
        }
        return $message;
    }
}
