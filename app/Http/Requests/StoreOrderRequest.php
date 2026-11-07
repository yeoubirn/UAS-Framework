<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'alamat' => ['required', 'string', 'max:500'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'jumlah' => 'jumlah pesanan',
            'tanggal' => 'tanggal pemakaian/pemasangan',
            'alamat' => 'alamat lengkap',
            'catatan' => 'catatan pesanan',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'jumlah.required' => 'Jumlah pesanan wajib diisi.',
            'jumlah.integer' => 'Jumlah pesanan harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah pesanan minimal 1.',
            'tanggal.required' => 'Tanggal pelaksanaan/pemakaian wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
        ];
    }
}
