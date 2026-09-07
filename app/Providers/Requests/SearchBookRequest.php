<?php

namespace App\Providers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'author' =>['nullable', 'string'],
            'minRating' =>['nullable', 'numeric', 'betwween:1,5'],
            'sortBy' =>['nullable', 'in:title,publishedYear,avarageRating'],
            'order' =>['nullable', 'in:asc,desc'],
        ];
    }
}
