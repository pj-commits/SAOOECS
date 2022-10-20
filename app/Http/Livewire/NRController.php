<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NRController extends Component
{
    use WithFileUploads;

    public $attachment;
    public $attachments = [];

	public function updatedAttachment()
    {
    	$this->validate([
            'attachment' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
            'attachments' => ['required'],
            'attachments.*' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
        ], [], ['attachments.*' => 'attachments']);
        	
    }

    public function save() 
	{
		$this->validate([
			'title' => ['required'],
			'attachment' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
            'attachments' => ['required'],
			'attachments.*' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
		], [], ['attachments.*' => 'attachments']);
			
	}

    public function render()
    {
        return view('livewire.n-r-controller');
    }
}
