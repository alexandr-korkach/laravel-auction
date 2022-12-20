<?php

namespace App\Http\Requests\Lots;

use App\Rules\PastDate;
use Illuminate\Foundation\Http\FormRequest;

class EditLotRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'starting_price' => 'nullable|numeric',
            'auction_step' => 'nullable|numeric',
            'redemption_price' => 'nullable|numeric|gt:starting_price',
            'starting_at' => ['required','date', new PastDate],

        ];
    }
}
