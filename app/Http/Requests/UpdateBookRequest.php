<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookId = $this->book->id;

        return [
            'ISBN' => "required|size:13|unique:books,ISBN,$bookId",
            'title' => 'required|string|max:70',
            'price' => 'required|numeric|min:0|max:99.99',
            'mortgage' => 'required|numeric|min:0|max:9999.99',
            'authorship_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            // إضافة validation للـ authors
            'authors' => 'nullable|array',
            'authors.*' => 'exists:authors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'ISBN.required' => 'رقم ISBN مطلوب',
            'ISBN.size' => 'رقم ISBN يجب أن يكون 13 رقم',
            'ISBN.unique' => 'رقم ISBN موجود مسبقاً',
            'title.required' => 'عنوان الكتاب مطلوب',
            'title.max' => 'عنوان الكتاب يجب ألا يتجاوز 70 حرف',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقم',
            'price.min' => 'السعر يجب أن يكون 0 أو أكثر',
            'price.max' => 'السعر يجب ألا يتجاوز 99.99',
            'mortgage.required' => 'التأمين مطلوب',
            'mortgage.numeric' => 'التأمين يجب أن يكون رقم',
            'mortgage.min' => 'التأمين يجب أن يكون 0 أو أكثر',
            'mortgage.max' => 'التأمين يجب ألا يتجاوز 9999.99',
            'authorship_date.date' => 'تاريخ التأليف يجب أن يكون تاريخ صحيح',
            'category_id.required' => 'الصنف مطلوب',
            'category_id.exists' => 'الصنف المحدد غير موجود',
            'cover.image' => 'الغلاف يجب أن يكون صورة',
            'cover.mimes' => 'الغلاف يجب أن يكون من نوع: jpeg, jpg, png, gif, webp',
            'cover.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
            'authors.array' => 'المؤلفين يجب أن تكون مصفوفة',
            'authors.*.exists' => 'أحد المؤلفين المحددين غير موجود',
        ];
    }
}
