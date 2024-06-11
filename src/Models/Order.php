<?php

namespace LuxChill\Models;

use LuxChill\Commons\Model;

class Order extends Model
{
	protected string $tableName = 'orders';
	public function getAllByUserId($userId)
	{
		return $this->queryBuilder
			->select('*')
			->from($this->tableName)
			->where('user_id = :id')
			->setParameter("id", $userId)
			->fetchAllAssociative();
	}
}