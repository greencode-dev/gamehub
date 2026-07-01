<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:games,slug,'.$this->route('game')],
            'description' => ['nullable', 'string'],
            'publisher' => ['required', 'string', 'max:255'],
            'release_date' => ['required', 'date'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999.99'],
            'genre_id' => ['required', 'exists:game_genres,id'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'platforms' => ['nullable', 'array'],
            'platforms.*' => ['exists:platforms,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'titolo',
            'slug' => 'slug',
            'description' => 'descrizione',
            'publisher' => 'editore',
            'release_date' => 'data di uscita',
            'price' => 'prezzo',
            'genre_id' => 'genere',
            'cover' => 'copertina',
            'platforms' => 'piattaforme',
        ];
    }
}
