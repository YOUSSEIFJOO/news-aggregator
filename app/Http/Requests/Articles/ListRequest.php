<?php

namespace App\Http\Requests\Articles;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'filtration' => 'nullable|array',
            'filtration.from_date' => 'nullable|date',
            'filtration.to_date' => 'nullable|date',
            'filtration.category' => 'nullable|string|max:100',
            'filtration.source' => 'nullable|string|max:100',
            'user_preferences' => 'nullable|array',
            'user_preferences.categories' => 'nullable|array',
            'user_preferences.categories.*' => 'nullable|string|max:100',
            'user_preferences.sources' => 'nullable|array',
            'user_preferences.sources.*' => 'nullable|string|max:100',
            'user_preferences.authors' => 'nullable|array',
            'user_preferences.authors.*' => 'nullable|string|max:100',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => __('articles.search_string'),
            'search.max' => __('articles.search_max', ['max' => 100]),
            'filtration.array' => __('articles.filtration_array'),
            'filtration.from_date.date' => __('articles.from_date_date'),
            'filtration.to_date.date' => __('articles.to_date_date'),
            'user_preferences.array' => __('articles.user_preferences_array'),
            'user_preferences.sources.array' => __('articles.sources_array'),
            'user_preferences.sources.*.string' => __('articles.source_string'),
            'user_preferences.sources.*.max' => __('articles.source_max', ['max' => 100]),
            'user_preferences.categories.array' => __('articles.categories_array'),
            'user_preferences.categories.*.string' => __('articles.category_string'),
            'user_preferences.categories.*.max' => __('articles.category_max', ['max' => 100]),
            'user_preferences.authors.array' => __('articles.authors_array'),
            'user_preferences.authors.*.string' => __('articles.author_string'),
            'user_preferences.authors.*.max' => __('articles.author_max', ['max' => 100]),
            'per_page.integer' => __('articles.per_page_integer'),
            'per_page.min' => __('articles.per_page_min', ['min' => 1]),
            'per_page.max' => __('articles.per_page_max', ['max' => 100]),
            'page.integer' => __('articles.page_integer'),
            'page.min' => __('articles.page_min', ['min' => 1]),
        ];
    }
}
