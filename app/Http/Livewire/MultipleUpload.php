<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class MultipleUpload extends Component
{
    use WithFileUploads;

	public $attachments = [];

	public function updatedAttachments()
    {
        $this->validate([
        	'attachments' => ['required'],
            'attachments.*' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
        ], [], ['attachments.*' => 'attachments']);
    }

	public function save() 
	{
		$this->validate([
			'attachments' => ['required'],
			'attachments.*' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
		], [], ['attachments.*' => 'attachments']);

		dd($this);
	}

    public function render()
    {
        return view('livewire.multiple-upload');
    }
}
