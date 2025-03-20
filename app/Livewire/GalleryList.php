<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GalleryList extends Component
{

    public $galleries;
    public $galleryId, $name, $description, $public;
    public $isOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'public' => 'boolean',
    ];

    public function mount()
    {
        $this->loadGalleries();
    }

    public function loadGalleries()
    {
        $this->galleries = Gallery::where('user_id', Auth::id())->get();
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        Gallery::updateOrCreate(
            ['id' => $this->galleryId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'public' => $this->public ?? false,
                'user_id' => Auth::id(),
            ]
        );

        $this->isOpen = false;
        $this->loadGalleries();
    }

    public function delete($id)
    {
        Gallery::findOrFail($id)->delete();
        $this->loadGalleries();
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->galleryId = $gallery->id;
        $this->name = $gallery->name;
        $this->description = $gallery->description;
        $this->public = $gallery->public;
        $this->isOpen = true;
    }

    public function render()
    {
        return view('livewire.gallery.gallery-list');
    }

    public function show(Gallery $gallery)
    {
        $this->redirectRoute('gallery.show', ['guid' => $gallery->guid]);
    }
    private function resetFields()
    {
        $this->galleryId = null;
        $this->name = '';
        $this->description = '';
        $this->public = false;
    }

}
