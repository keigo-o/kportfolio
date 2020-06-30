<?php

namespace App\Http\Requests\notebook;

use Illuminate\Foundation\Http\FormRequest;

class PublicHolidayImportRequest extends FormRequest
{
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
        return [
            'file'=>'required|max:255|file|mimes:csv,txt|mimetypes:text/plain'
        ];
    }
}
