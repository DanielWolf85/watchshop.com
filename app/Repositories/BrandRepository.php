<?php

namespace App\Repositories;

use App\Models\Brand as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Brand Repository
 */
class BrandRepository extends CoreRepository
{
	/**
	 * @return string
	 */
	public function getModelClass()
	{
		return Model::class;
	}


	/**
	 * Вывод списка брендов с пагинацией для админки
	 *
	 * @param int $perPage кол-во элементов для одной страницы пагинации
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
	 * Поиск бренда по его id для админки
	 *
	 * @param int $id
	 * @return Model
	 */
	public function getEdit($id)
	{
		return $this->startConditions()->find($id);
	}

}