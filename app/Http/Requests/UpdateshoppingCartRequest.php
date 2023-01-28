<?php

namespace App\Http\Requests;

use App\Policies\ShoppingCartPolicy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateshoppingCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        error_log('enter auth check');
        error_log($this);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
