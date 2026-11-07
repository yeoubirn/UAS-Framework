<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'in:Rental Proyektor,Pasang CCTV,WiFi dan Jaringan'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'tipe' => ['required', 'string', 'in:sewa,jasa'],
            'gambar' => ['nullable', 'string', 'max:255'],
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
            'nama' => 'nama layanan',
            'kategori' => 'kategori layanan',
            'deskripsi' => 'deskripsi layanan',
            'harga' => 'harga layanan',
            'tipe' => 'tipe layanan',
            'gambar' => 'path gambar',
        ];
    }
}
