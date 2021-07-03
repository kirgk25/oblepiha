<?php

namespace App\Http\Controllers;

use App\Models;
use App\Services;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** @var Services\JsonService */
    private $_jsonService;

    public function __construct()
    {

        $this->_jsonService = new Services\JsonService();
    }

    public function index(Requests\IndexProductRequest $request)
    {
        $products = Models\Product::query();

        foreach ($request->sort ?? [] as $field => $direction) {
            $products->orderBy($field, $direction);
        }

        $products = $products->paginate(PAGINATION_LIMIT);

        $products->makeVisible([
            'id',
            'created_at',
            'mainPhoto'
        ]);

        return $this->_jsonService->response($products);
    }

    public function store(Requests\StoreProductRequest $request)
    {
        $product = Models\Product::create($request->all());
        $product->photos()->createMany($request->photos);

        return $this->_jsonService->response($product->only('id'));
    }

    public function show(Models\Product $product, Request $request)
    {
        $product->load('photos');

        if ($request->fields) {
            // optional fields
            if (in_array('photos', $request->fields)) {
                // other photos
                $product->makeVisible('photos');
            }
            if (in_array('description', $request->fields)) {
                $product->makeVisible('description');
            }
        }

        return $this->_jsonService->response($product);
    }

    public function update(Models\Product $product, Requests\UpdateProductRequest $request)
    {
        $product->update($request->all());
        $product->photos()->createMany($request->photos);

        return $this->_jsonService->response($product->only('id'));
    }
}
