<?php

namespace App\Repositories;

use App\Models\Color as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ColorRepository
 */
class ColorRepository extends CoreRepository
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
	 * Получить с пагинацией в админке
	 *
	 * @param int $perPage кол-во элементов на одной странице пагинации
	 * @return Collection
	 */
	public function getAllWithPaginate($perPage = null)
	{
		$columns = [
			'id', 'name',
		];

		$result = $this->startConditions()
			->select($columns)
			->paginate($perPage);

		return $result;
	}
}