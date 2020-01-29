<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'product_name',
    	'category_id',
    	'brand_id',
    	'price',
    	'color_id',
    	'size_id',
    	'description',
    	'content_raw',
    	'content_html',
    	'is_published',
    ];


    /**
     * Категория продукта.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function category()
    {
        // Статья принадлежит категории
        return $this->belongsTo(Category::class);
    }


    /**
     *  Бренд продукта.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }



    /**
     *  Цвет продукта
     *
     *  @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }


    /**
     * Размер продукта
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

}
