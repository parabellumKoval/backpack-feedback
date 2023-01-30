<?php

namespace Backpack\Feedback\app\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $type = $this->type;
      
      $this->redirect = url()->previous().'#' . $type;
      
      if($type == 'contact') {
        return [
            $type . '_name' => 'required',
            $type . '_email' => 'required',
            $type . '_text' => 'required|min:10|max:3000',
        ];
      } else {
        return [
            
        ];
      }
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'contact_text' => 'Enquiry',
            'contact_name' => 'Name',
            'contact_email' => 'Email'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'contact_text.min' => 'Enquiry must be between 10 and 3000 characters!',
            'contact_text.max' => 'Enquiry must be between 10 and 3000 characters!',
        ];
    }
}
