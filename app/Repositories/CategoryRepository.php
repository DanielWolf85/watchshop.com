<?php

namespace App\Repositories;

use App\Models\Category as Model;
use Illuminate\Database\Eloquent\Collection;


/**
 * Class CategoryRepository
 *
 * @package App\Repositories
 */
class CategoryRepository extends CoreRepository
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
	 * 
	 * @param int $id
	 * @return Model
	 */
	public function getEdit($id)
	{
		return $this->startConditions()->find($id);
	}


	/**
	 * Получить список категорий для вывода в выпадающем списке
	 *
	 * @return Collection
	 */
	public function getForComboBox()
	{
		// return $this->startConditions()->all();

		$columns = implode(', ', [
			'id',
			'CONCAT (id, ", ", title) AS id_title',
		]);

		// $result[] = $this->startConditions()->all();

		/*
		$result[] = $this
			->startConditions()
			->select('categories.*', 
				\DB::raw('CONCAT (id, ", ", title) AS id_title'))
			// ->toBase()
			->get();
		*/

		$result = $this
			->startConditions()
			->selectRaw($columns)
			->toBase()
			->get();


		return $result;
	}


	/**
	 * Вывод категорий с пагинацией
	 *
	 * @return Collection
	 */
	public function getAllWithPaginate($perPage = null)
	{
		$columns = [
			'id', 'title', 'parent_id',
		];

		$result = $this
			->startConditions()
			->select($columns)
			->paginate($perPage);
		
		
		return $result;
	}
}