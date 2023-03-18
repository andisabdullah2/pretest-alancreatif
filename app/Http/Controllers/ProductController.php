<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = new Product([
            'nama' => $request->get('nama'),
            'deskripsi' => $request->get('deskripsi'),
            'harga' => $request->get('harga'),
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products', $filename);
            $product->gambar = $filename;
        }

        $product->save();
        return redirect('/products')->with('success', 'Product has been added');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::find($id);
        $product->nama = $request->get('nama');
        $product->deskripsi = $request->get('deskripsi');
        $product->harga = $request->get('harga');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products', $filename);
            $product->gambar = $filename;
        }
    
        $product->save();
        return redirect('/products')->with('success', 'Product has been updated');
    }
    
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with('success', 'Product has been deleted');
    }
}   
