<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class SingleUpload extends Component
{
    use WithFileUploads;

	public $attachment;

	public function updatedAttachment()
    {
    	$this->validate([
            'attachment' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
        ]);
    }

	public function save() 
	{
		$this->validate([
			'title' => ['required'],
			'attachment' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
		]);

		//ddd($this->attachment);
	}

    public function render()
    {
        return view('livewire.single-upload');
    }
}
