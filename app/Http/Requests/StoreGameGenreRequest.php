<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameGenreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:game_genres,slug,'.$this->route('genre')],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'slug' => 'slug',
        ];
    }
}
