<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Post;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() === 'home.update') {
            $post = Post::findOrFail($this->id);
            return Auth::check() && Auth::user()->isAdminOrOwner($post->user_id);
        }
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            // 'type' => 'integer',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 不可空白',
        ];
    }
}
