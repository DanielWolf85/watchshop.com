<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Requests\ProductUpdateRequest;
use App\Requests\ProductCreateRequest;
use App\Repositories\ProductRepository;

class ProductController extends BaseController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;



    function __construct()
    {
        parent::__construct();
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->productRepository->getAllWithPaginate(5);

        $categoriesList = $this->productRepository->getCatList();
        $brandsList     = $this->productRepository->getBrandsList();
        $colorsList     = $this->productRepository->getColorsList();
        $sizesList      = $this->productRepository->getSizesList();

        return view('shop.admin.products.index', compact(
            'paginator', 'categoriesList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        dd(__METHOD__);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->productRepository->getEdit($id);
        $categoriesList = $this->productRepository->getCatList();

        dd($categoriesList);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $item = $this->productRepository->getEdit($id);

        if(empty($item)) {
            return back()
                ->withErrors(['msg' => 'Такой цвет не продукт не найден для обновления'])
                ->withInput();
        }

        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();

        if(! $result) {
            return back()
                ->withErrors(['msg' => 'Ошибка обновления продукта'])
                ->withInput();
        } else {
            return redirect()
                ->route('shop.admin.products.index')
                ->with(['success' => 'Продукт успешно обновлен']);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
