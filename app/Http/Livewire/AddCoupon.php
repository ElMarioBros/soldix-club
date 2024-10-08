<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wallet;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AddCoupon extends Component
{
    use WithFileUploads;

    public $wallet_id;

    public $name;

    public $image;

    public $type = 'discount_fixed';

    public $tag;

    public $first2x1 = 2;

    public $second2x1 = 1;

    public $status;

    public function render()
    {
        if ($this->type == '2x1') {
            $this->tag = $this->first2x1.'x'.$this->second2x1;
        }

        return view('livewire.add-coupon');
    }

    public function store($id)
    {
        $wallet = Wallet::find($id);

        $this->validate([
            'name'=>'required|min:3',
            'image'=>'required|image|max:1024'
        ]);

        $imageCloud = $this->image->storeOnCloudinary('soldix-club/coupons');
        $imageCloud = $imageCloud->getPath();

        if (
            $wallet->coupons()->create([
                'name' => $this->name,
                'type' => $this->type,
                'tag' => $this->tag,
                'redeem_id' => uniqid(),
                'image' => $imageCloud,
                'description' => '',
                'campain_starts' => '',
                'campain_finishes' => '',
                'is_valid_monday' => 0,
                'is_valid_tuesday' => 0,
                'is_valid_wednesday' => 0,
                'is_valid_thursday' => 0,
                'is_valid_friday' => 0,
                'is_valid_saturday' => 0,
                'is_valid_sunday' => 0,
                'is_active' => 0,
                'parameters' => 0,
            ])            
        ) {
            $this->unset_all();
            $this->status = 'Cupón registrado con éxito';
        } else{
            $this->unset_all();
            $this->status = 'Error al registrar cupón';
        }


    }

    public function unset_tag()
    {
        unset($this->tag);
    }

    public function unset_all()
    {
        unset($this->name);
        unset($this->image);
        unset($this->tag);
        $this->type = 'discount_fixed';
    }

}
