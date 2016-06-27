<?php
/**
 * Created by PhpStorm.
 * User: Imran
 * Date: 6/28/2016
 * Time: 12:43 AM
 */

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Validator;
use Request;
use Session;
use File;

class HomeController extends Controller
{

    public function getForm()
    {

        $products = [];

        if (File::exists(public_path() . '/products.json')) {

        } else {
            File::put(public_path() . '/products.json', '');
        }

        $j_products = File::get(public_path() . '/products.json');

        if (strlen($j_products) > 0)
            $products = json_decode($j_products);

        return view('form', ['products' => $products]);
    }


    public function postForm()
    {

        $products = [];

        $v = Validator::make(['name' => Request::input('name'), 'quantity' => Request::input('quantity'), 'price' => Request::input('price')]
            , ['name' => 'required', 'quantity' => 'required', 'price' => 'required']);

        if ($v->fails()) {
            Session::flash('error_msg', messages($v));
            return redirect()->back();
        }

        //get products
        $j_products = File::get(public_path() . '/products.json');

        //append new product
        if (strlen($j_products) > 0)
            $products = json_decode($j_products);

        $product = [
            'name' => Request::input('name'),
            'quantity' => Request::input('quantity'),
            'price' => Request::input('price'),
            'total_value' => Request::input('quantity') * Request::input('price'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        if (sizeof($products) > 0) {
            $l_product = last($products);
            $id = $l_product->id + 1;

            $product['id'] = $id;
        } else {
            $product['id'] = 1;
        }

        $products[] = $product;

        File::put(public_path() . '/products.json', json_encode($products));

        Session::flash('success_msg', "Product added successfully");
        return redirect()->back();

    }

    public function editProduct($id)
    {
        $products = [];
        $c_product = null;

        //get products
        $j_products = File::get(public_path() . '/products.json');

        //append new product
        if (strlen($j_products) > 0)
            $products = json_decode($j_products);

        if (sizeof($products) > 0) {

            foreach ($products as $product) {
                if ($product->id == $id) {
                    $c_product = $product;
                }
            }
        } else {
            Session::flash('error_msg', "Product not found ");
            return redirect()->back();
        }

        if (is_null($c_product)) {
            Session::flash('error_msg', "Product not found ");
            return redirect()->back();
        }

        return view('edit_form', ['product' => $c_product]);
    }


    public function updateProduct($id)
    {
        $products = [];
        $c_product = null;

        //get products
        $j_products = File::get(public_path() . '/products.json');

        //append new product
        if (strlen($j_products) > 0)
            $products = json_decode($j_products);

        if (sizeof($products) > 0) {

            foreach ($products as $product) {
                if ($product->id == $id) {
                    $c_product = $product;

                    $product->name = Request::input('name');
                    $product->quantity = Request::input('quantity');
                    $product->price = Request::input('price');
                    $product->total_value = Request::input('quantity') * Request::input('price');
                    $product->created_at = Carbon::now()->format('Y-m-d H:i:s');
                }
            }
        } else {
            Session::flash('error_msg', "Product not found ");
            return redirect()->back();
        }

        if (is_null($c_product)) {
            Session::flash('error_msg', "Product not found ");
            return redirect()->back();
        }

        File::put(public_path() . '/products.json', json_encode($products));

        Session::flash('success_msg', "Product updated successfully");
        return redirect('/');
    }

    public function deleteProduct($id)
    {

        $products = [];
        $n_products = [];
        $c_key = null;

        //get products
        $j_products = File::get(public_path() . '/products.json');

        //append new product
        if (strlen($j_products) > 0)
            $products = json_decode($j_products);

        if (sizeof($products) > 0) {

            foreach ($products as $product) {
                if ($product->id != $id) {
                    $n_products[] = $product;
                }
            }
        } else {
            Session::flash('error_msg', "Product not found ");
            return redirect()->back();
        }


        File::put(public_path() . '/products.json', json_encode($n_products));
        Session::flash('success_msg', "Product deleted successfully");
        return redirect('/');

    }
}