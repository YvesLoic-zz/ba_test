<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

trait UploadService
{
    /**
     * Function de sauvegarde d'image pour les utilisateurs
     *
     * @param \Illuminate\Http\Request $req     requette
     * @param \App\Models\Product      $product utilisateur
     *
     * @return void
     */
    protected function uploadProductImage(Request $req, Product $product)
    {
        $file = $req->image;
        $file_name = uniqid(time()) . '.' . $file->extension();
        $path = public_path('/images/products');
        $product->image = '/images/products/' . $file_name;
        $file->move($path, $file_name);
    }
}
