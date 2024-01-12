<?php

namespace App\Http\Requests;

use App\Rules\MinIfIsString;
use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'published_at' => 'nullable|date',
            'title' => 'required|string|min:2|max:50',
            'image' => [
                request('recipe') ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png',
                'dimensions:min_width=400,min_height=300',
                'max:2048'
            ],
            'category_id' => 'required|numeric|exists:categories,id',
            'tags' => 'required|array|min:1|max:5',
            'tags.*' => ['max:20', new MinIfIsString],
            'excerpt' => 'required|string|min:5|max:250',
            'description' => 'required',
            'ingredients' => 'required',
            'preparation' => 'required',
        ];
    }
}
