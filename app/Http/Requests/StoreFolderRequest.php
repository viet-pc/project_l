<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends ParentIdBaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(
            parent::rule(),
            [
                'name' => [
                    'requite',
                    Rule::unique(File::class, 'name')
                        ->where('create_by', Auth::id())
                        ->where('parent_id', $this->parent_id)
                        ->whereNull('deleted_at')
                ],
            ]
        );
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Folder ":input" already exists'
        ];
    }
}
