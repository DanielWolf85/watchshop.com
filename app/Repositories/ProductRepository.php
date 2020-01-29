<?php

namespace App\Repositories;

use App\Models\Product as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * ProductRepository
 */
class ProductRepository extends CoreRepository
{
	
	/**
	 * @return string
	 */
	public function getModelClass()
	{
		return Model::class;
	}


	/**
	 * Получить модель для редактирования в админке
	 */
	public function getEdit($id)
	{
		return $this->startConditions()->find($id);
	}


	/**
	 * Получить эелементы с пагинацией в админке
	 *
	 * @param int $perPage кол-во элементов на одной странице пагинации
	 * @return Model
	 */
	public function getAllWithPaginate($perPage = null)
	{
		$columns = [
			'id',
			'product_name',
			'category_id',
			'brand_id',
			'price',
			'color_id',
			'size_id',
			'description',
			'is_published',
			'published_at'
		];

		$result = $this
			->startConditions()
			->select($columns)
			->orderBy('id', 'DESC')
			// ->with(['category', 'brand', 'color', 'size'])
			/*->with([
				'category' => function($query) {
					$query->select(['id', 'title']);
				},
				'brand'    => function($query) {
					$query->select(['id', 'name']);
				},
				'color'    => function($query) {
					$query->select(['id', 'name']);
				},
				'size'     => function($query) {
					$query->select(['id', 'name']);
				},
			])*/
			->with([
				'category:id,title',
				'brand:id,name',
				'color:id,name',
				'size:id,name',
			])
			->paginate($perPage);

		return $result;
	}


	/**
	 * Возвращает список категорий для выбора
	 */
	public function getCatList()
	{
		$columns = implode(', ', [
			'id', 
			'CONCAT (id, ", ", product_name) AS id_name'
		]);

		$result = $this
			->startConditions()
			->selectRaw($columns)
			->toBase()
			->get();

		return $result;
	}


	/**
	 * Возвращает список брендов для выбора
	 */
	public function getBrandsList()
	{
		# code...
	}


	/**
	 * Возврашает список цветов для выбора
	 */
	public function getColorsList()
	{
		# code...
	}


	/**
	 * Возвращает список размеров для выбора
	 */
	public function getSizesList()
	{
		# code...
	}
}