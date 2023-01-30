<?php

namespace Backpack\Feedback\app\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Backpack\Feedback\app\Models\Feedback;

class FeedbackController extends \App\Http\Controllers\Controller
{   
  public function create(Request $request) 
  {

    $data = $request->only(['name', 'phone', 'email', 'files', 'text', 'type', 'extras']);
      
    $validator = Validator::make($data, [
      'name' => 'nullable|min:2|max:150',
      'phone' => 'required_without:email|string|min:6|max:30',
      'email' => 'required_without:phone|email|min:6|max:255',
      'files' => 'nullable|string|min:2|max:255',
      'text' => 'nullable|string|min:0|max:1500',
      'type' => 'nullable|string|min:2|max:100',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    try {
      $feedback = Feedback::create([
        'name' => $data['name'] ?? '',
        'phone' => $data['phone'] ?? '',
        'email' => $data['email'] ?? '',
        'text' => $data['text'] ?? '',
        'files' => $data['files'] ?? '',
        'type' => $data['type'] ?? '',
        'extras' => $data['extras'] ?? ''
      ]);
    }catch(\Exception $e){
      return response()->json($e->getMessage(), 400);
    }
    
    return response()->json($feedback);
  }
}
