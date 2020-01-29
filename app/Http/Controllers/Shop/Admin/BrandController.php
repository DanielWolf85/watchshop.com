<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandUpdateRequest;
use App\Http\Requests\BrandCreateRequest;
use App\Models\Brand;
use App\Repositories\BrandRepository;

class BrandController extends BaseController
{
    /**
     * @var BrandRepository
     */
    private $brandRepository;

    function __construct()
    {
        $this->brandRepository = app(BrandRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->brandRepository->getAllWithPaginate(5);

        return view('shop.admin.brands.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Brand();
        // $brandsList = Brand::all();

        return view('shop.admin.brands.edit', compact(
            'item'
        ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandCreateRequest $request)
    {
        $data = $request->input();

        $item = (new Brand())->create($data);

        if($item) {
            return redirect()->route('shop.admin.brands.index')
                ->with(['success' => "Бренд {$item->name} успешно сохранен"])
                ->withInput();
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения бренда'])
                ->withInput();
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->brandRepository->getEdit($id);
        
        return view('shop.admin.brands.edit', compact(
            'item'
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        $item = Brand::find($id);


        if(empty($item)) {
            return back()
                ->withErrors(['msg' => 'Данный бренд не найден'])
                ->withInput();
        }

        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();

        if($result) {
            return redirect()
                ->route('shop.admin.brands.edit', $item->id)
                ->with(['success' => 'Бренд успешно добавлен']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения бренда'])
                ->withInput();
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
        //
    }
}
