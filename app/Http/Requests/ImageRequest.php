<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $image_size = 200;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $ext = implode(',', $this->image_ext);

        return [
            'foto' => ['file', 'image', 'mimes:'.$ext, 'max:'.$this->image_size]
        ];
    }
}
