<?php

namespace App\Repositories;

use App\Models\Size as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * 
 */
class SizeRepository extends CoreRepository
{
	
	/**
	 * @return string
	 */
	public function getModelClass()
	{
		return Model::class;
	}


	/**
	 * Вывод размеров с пагинацией
	 *
	 * @param int $perPage Кол-во элементов на одной странице пагинации
	 * @return Collection
	 */
	public function getAllWithPaginate($perPage = null)
	{
		$columns = [
			'id', 'name'
		];

		$result = $this
			->startConditions()
			->select($columns)
			->paginate($perPage);

		return $result;
	}


	/**
	 * Выбор размера по $id
	 *
	 * @param int $id
	 * @return array
	 */
	public function getEdit($id)
	{
		return $this->startConditions()->find($id);
	}
}