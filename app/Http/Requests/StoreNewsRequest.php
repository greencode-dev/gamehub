<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:news,slug,'.$this->route('news')],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'game_id' => ['nullable', 'exists:games,id'],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'titolo',
            'slug' => 'slug',
            'content' => 'contenuto',
            'image' => 'immagine',
            'game_id' => 'gioco',
            'published_at' => 'data di pubblicazione',
        ];
    }
}
