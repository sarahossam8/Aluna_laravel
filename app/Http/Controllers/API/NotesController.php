<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\note1;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $texts = note1::all();

        return response()->json(['texts' => $texts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $text = note1::create([
            'text' => $request->text,
            'users_id' => $request->users_id // تأكد من إرسال هذا الحقل في الطلب
        ]);

        return response()->json(['message' => 'Text created successfully', 'text' => $text , 'user_id'=>$request->users_id], 201);
      

  if (!$text) {
            return response()->json(['message' => 'Text not found'], 404);
        }
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // البحث عن جميع النصوص المرتبطة بـ user_id المحدد
    $texts = note1::where('users_id', $id)->get();

    // إذا لم يتم العثور على أي نصوص
    if ($texts->isEmpty()) {
        return response()->json(['message' => 'No texts found for this user'], 404);
    }

    // إرجاع جميع النصوص
    return response()->json(['message' => 'Texts retrieved successfully', 'texts' => $texts], 200);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id, string $text_id)
    {
        // التحقق من البيانات
        $request->validate([
            'text' => 'required|string|max:255',
        ]);
    
        // البحث عن النص
        $text = note1::where('id', $text_id)
                    ->where('users_id', $user_id)
                    ->first();
    
        // إذا لم يتم العثور على النص
        if (!$text) {
            return response()->json(['message' => 'Text not found or does not belong to this user'], 404);
        }
    
        // تحديث النص
        $text->update([
            'text' => $request->text
        ]);
    
        // إرجاع رسالة نجاح مع النص المحدث
        return response()->json(['message' => 'Text updated successfully', 'text' => $text], 200);
    }
    public function destroy(string $user_id, string $text_id)
    {
        // البحث عن النص
        $text = note1::where('id', $text_id)
                    ->where('users_id', $user_id)
                    ->first();
    
        // إذا لم يتم العثور على النص
        if (!$text) {
            return response()->json(['message' => 'Text not found or does not belong to this user'], 404);
        }
    
        // حذف النص
        $text->delete();
    
        // إرجاع رسالة نجاح
        return response()->json(['message' => 'Text deleted successfully', 'id' => $text_id], 200);
    }
}