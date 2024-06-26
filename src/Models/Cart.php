<?php

namespace LuxChill\Models;

use LuxChill\Commons\Model;

class Cart extends Model
{
	protected string $tableName = 'carts';

	public function findByUserId($id)
	{
		try {
			return $this->queryBuilder
				->select('*')
				->from($this->tableName)
				->where('user_id = :id')
				->setParameter('id', $id)
				->fetchAssociative();
		}catch (\Exception $e) {
			die($e->getMessage());
		}
	}

	public function deleteByUserId($id)
	{
		try {
			return $this->queryBuilder
				->delete($this->tableName)
				->where('user_id = :id')
				->setParameter('id', $id)
				->executeQuery();
		}catch (\Exception $e){
			die($e->getMessage());
		}
	}
}