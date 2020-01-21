<?php

namespace App\Http\Controllers\Shop\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = Category::paginate(5);

        return view('shop.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Category();
        $categoriesList = Category::all();

        return view('shop.admin.categories.edit', compact(
            'item', 'categoriesList'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->input();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // Первый способ сохранения
        // $item = new Category($data);
        // $item->save();

        // Второй способ сохранения
        $item = (new Category())->create($data);

        if($item) {
            return redirect()->route('shop.admin.categories.index')
                ->with(['success' => "Категория {$item->title} успешно сохранена"])
                ->withInput();
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения категории'])
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
        $item = Category::findOrFail($id);
        $categoriesList = Category::all();

        return view('shop.admin.categories.edit', compact(
            'item', 'categoriesList'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {

        /*$rules = [
            'title'         => 'required|min:5|max:200',
            'slug'          => 'max:200',
            'description'   => 'string|max:500|min:3',
            'parent_id'     => 'required|integer',
        ];*/

        // 2 способа валидации

        // $validateData = $this->validate($request, $rules);
        // $validateData = $request->validate($rules);
        

        $item = Category::find($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        dd($data);

        $result = $item
            ->fill($data)
            ->save();

        if($result) {
            return redirect()
                ->route('shop.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

}
