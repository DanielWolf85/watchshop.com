<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ColorUpdateRequest;
use App\Http\Requests\ColorCreateRequest;
use App\Models\Color;
use App\Repositories\ColorRepository;

class ColorController extends BaseController
{
    /**
     * @var Color Repository
     */
    private $colorRepository;


    function __construct()
    {
        parent::__construct();
        $this->colorRepository = app(ColorRepository::class);        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->colorRepository->getAllWithPaginate(5);

        return view('shop.admin.colors.index', compact(
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
        $item = new Color();

        return view('shop.admin.colors.edit', compact(
            'item'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorCreateRequest $request)
    {
        $data = $request->input();

        $item = (new Color())->create($data);

        if($item) {
            return redirect()
                ->route('shop.admin.colors.index')
                ->with(['success' => "Цвет {$item->name} успешно соранен"])
                ->withInput();
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения цвета']);
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
        $item = $this->colorRepository->getEdit($id);

        return view('shop.admin.colors.edit', compact(
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
    public function update(ColorUpdateRequest $request, $id)
    {
        $item = $this->colorRepository->getEdit($id);

        if(empty($item)) {
            return back()
                ->withErrors(['msg' => 'Такой цвет не найден для обновления'])
                ->withInput();
        }

        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();

        if($result) {
            return redirect()
                ->route('shop.admin.colors.index')
                ->with(['success' => 'Цвет успешно был обновлен']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка обновления цвета'])
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
