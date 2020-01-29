<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Repositories\SizeRepository;
use App\Http\Requests\SizeUpdateRequest;
use App\Http\Requests\SizeCreateRequest;

class SizeController extends BaseController
{
    /**
     * @var SizeRepository
     */
    private $sizeRepository;


    public function __construct()
    {
        parent::__construct();
        $this->sizeRepository = app(SizeRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->sizeRepository->getAllWithPaginate(5);

        return view('shop.admin.sizes.index', compact(
            'paginator'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Size();

        return view('shop.admin.sizes.edit', compact(
            'item'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeCreateRequest $request)
    {
        $data = $request->all();

        $item = (new Size())->create($data);

        if($item) {
            return redirect()->route('shop.admin.sizes.index')
                ->with(['success' => 'Размер успешно сохранен']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения размера'])
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
        $item = $this->sizeRepository->getEdit($id);

        if(! $item) {
            abort(404);
        }

        return view('shop.admin.sizes.edit', compact(
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
    public function update(SizeUpdateRequest $request, $id)
    {
        $item = $this->sizeRepository->getEdit($id);

        if(empty($item)) {
            return back()
                ->withErrors(['msg' => 'Размер не найден для редактирования'])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->fill($data)->save();

        if($result) {
            return redirect()
                ->route('shop.admin.sizes.index')
                ->with(['success' => 'Размер успешно обновлен']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка обновления размера'])
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
        dd(__METHOD__);
    }
}
