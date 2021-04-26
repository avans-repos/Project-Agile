<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:45',
            'description' => 'required|string',
            'deadline' => 'required|date|after:tomorrow',
            'notes' => 'nullable|string'
        ];
    }

    public function messages()
    {
      return [
            'deadline.after' => 'De deadline moet minstens een dag in de toekomst liggen'
      ];
    }
}
