<?php

namespace App\Http\Requests;

use App\Enums\ServisStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Carbon\Carbon;

class UpdateServisRequest extends FormRequest
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
            'nama_konsumen' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'tanggal_masuk' => 'required|date_format:d/m/Y',
            'tanggal_jadi' => 'nullable|date_format:d/m/Y',
            'type_laptop' => 'required|string|max:100',
            'jenis_kerusakan' => 'required|string',
            'nama_teknisi' => 'required|string|max:100',
            'status' => ['required', new Enum(ServisStatus::class)],
            'catatan_teknisi' => 'nullable|string',
            'panjar' => 'nullable|numeric|min:0',
            'total_biaya' => 'nullable|numeric|min:0',
            'garansi_nilai' => 'nullable|integer|min:0',
            'garansi_satuan' => 'required|in:Hari,Bulan',
            'kelengkapan_lainnya' => 'nullable|string|max:255',
            'kelengkapan_laptop' => 'nullable|boolean',
            'kelengkapan_charger' => 'nullable|boolean',
            'kelengkapan_baterai' => 'nullable|boolean',
            'kelengkapan_tas' => 'nullable|boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'kelengkapan_laptop' => $this->has('kelengkapan_laptop'),
            'kelengkapan_charger' => $this->has('kelengkapan_charger'),
            'kelengkapan_baterai' => $this->has('kelengkapan_baterai'),
            'kelengkapan_tas' => $this->has('kelengkapan_tas'),
            'panjar' => $this->panjar ?? 0,
            'total_biaya' => $this->total_biaya ?? 0,
            'garansi_nilai' => $this->garansi_nilai ?? 0,
        ]);
    }

    /**
     * Get validated data and convert dates to Y-m-d format
     */
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated($key, $default);
        
        // Convert DD/MM/YYYY to Y-m-d
        if (!empty($validated['tanggal_masuk'])) {
            $validated['tanggal_masuk'] = Carbon::createFromFormat('d/m/Y', $validated['tanggal_masuk'])->format('Y-m-d');
        }
        
        if (!empty($validated['tanggal_jadi'])) {
            $validated['tanggal_jadi'] = Carbon::createFromFormat('d/m/Y', $validated['tanggal_jadi'])->format('Y-m-d');
        }
        
        return $validated;
    }
}
