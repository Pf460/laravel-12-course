<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'slug' => 'nullable',
            'excerpt' => 'required|min:10',
            'body' => 'required|min:10',
            'is_published' => 'boolean|sometimes',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048']
        ];
    }

    public function messages(): array //обработка ошибок
    {
        return [
            'title.required' => 'Пожалуйста добавьте заголовок.',
            'excerpt.required' => 'Пожалуйста введите короткое превью поста.',
            'body.required' => 'Пожалуйста введите текст поста.',
            'image.image' => 'Файл должен быть изображением.'
        ];
    }

    protected function prepareFotValidation() : void
    {
        $this->merge([
           'is_published' => $this->boolean('is_published')
        ]);
    }
}
