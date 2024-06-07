<?php

namespace LuxChill\Models;

use Doctrine\DBAL\Exception;
use LuxChill\Commons\Model;

class Product extends Model
{
	protected string $tableName = 'products';

	public function paginate($page = 1, $perPage = self::PER_PAGE)
	{
		$queryBuilder = clone($this->queryBuilder);
		$totalPage = ceil($this->count() / $perPage);
		$offset = $perPage * ($page - 1);
		try {
			$data = $queryBuilder
				->select('p.id as p_id', 'p.name as p_name', 'p.slug as p_slug', 'p.image as p_image', 'p.price', 'p.price_offer', 'p.quantity', 'p.sku', 'p.status', 'p.type', 'p.created_at', 'p.updated_at', 'c.id as c_id', 'c.name as c_name')
				->from($this->tableName, 'p')
				->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
				->setFirstResult($offset)
				->setMaxResults($perPage)
				->orderBy('p.id', 'DESC')
				->fetchAllAssociative();

			return [$data, $totalPage];
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id)
	{
		try {
			return $this->queryBuilder
				->select('p.id as p_id', 'p.name as p_name', 'p.slug as p_slug', 'p.image as p_image', 'p.price', 'p.price_offer', 'p.quantity', 'p.sku', 'p.status', 'p.type', 'p.created_at', 'p.updated_at', 'c.id as c_id', 'c.name as c_name')
				->from($this->tableName, 'p')
				->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
				->where("p.id = :id")
				->setParameter("id", $id)
				->orderBy('p.id', 'DESC')
				->fetchAssociative();
		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}

}