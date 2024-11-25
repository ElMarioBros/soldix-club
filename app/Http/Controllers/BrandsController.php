<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Wallet;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = auth()->user()->corporate()->first()->brands()->get();

        return view('admin.brands.index', ['brands' => $brands]);
    }

    public function store(Request $request)
    {
        $corporate = auth()->user()->corporate;

        if ($request->file) {
            $image = $request->file->storeOnCloudinary('soldix-club/brands');
            $image = $image->getPath();
        }else{
            $image = '';
        }

        $brand = $corporate->brands()->create([
            'name' => $request->name, 
            'long_id' => sprintf("%u", crc32(uniqid())), 
            'image' => $image, 
        ]);

        $brand->wallets()->create([
            'corporate_id' => auth()->user()->corporate()->first()->id,
            'image' => $image,
        ]);

        return redirect()->route('corporate.brands')->with('status', 'Marca registrada con éxito');
    }

    public function view($id)
    {
        $brand = Brand::find($id);

        if(auth()->user()->corporate_id != $brand->corporate_id){
            return redirect()->route('corporate.brands');
        }

        $wallets = Wallet::where('brand_id', $id)->get();

        return view('admin.brands.view', ['brand' => $brand, 'wallets' => $wallets]);
    }
}
