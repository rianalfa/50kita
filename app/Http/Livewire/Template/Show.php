<?php

namespace App\Http\Livewire\Template;

use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public $templateFiles;

    protected $rules = [
        'templateFiles' => 'required|file|mimes:doc,docx',
    ];

    public function mount() {
        $this->templateFiles = [
            'stTemplate' => NULL,
            'stspdTemplate' => NULL,
            'kwitansiTemplate' => NULL,
            'kwitansi2Template' => NULL,
        ];
    }

    public function downloadTemplate($key) {
        try {
            return Storage::download('public/docs/templates/'.$key.'.docx');
        } catch (Exception $e) {
            $this->emit('error', 'Gagal mengunduh template');
        }
    }

    public function uploadTemplate($key) {
        try {
            $this->templateFiles[$key]->storeAs('public/docs/templates', $key.'.docx');

            $this->emit('success', 'Template berhasil diunggah');
        } catch (Exception $e) {
            $this->emit('error', 'Template gagal diunggah');
        }
    }

    public function render()
    {
        return view('livewire.template.show', [
            'templates' => [
                'stTemplate' => 'Surat Tugas',
                'stspdTemplate' => 'Surat Tugas & SPD',
                'kwitansiTemplate' => 'Kwitansi',
                'kwitansi2Template' => 'Kwitansi 2',
            ]
        ])->layoutData(['title' => 'Template']);
    }
}
