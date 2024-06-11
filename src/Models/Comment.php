<?php

namespace LuxChill\Models;

use LuxChill\Commons\Model;

class Comment extends Model
{
	protected string $tableName = 'comments';

	public function selectAll($productId)
	{
		return $this->queryBuilder
			->select('c.id as c_id', 'c.content as c_content', 'c.user_id', 'c.product_id', 'c.image as c_image', 'c.stars', 'u.username as u_username', 'u.image as u_image')
			->from($this->tableName, 'c')
			->innerJoin('c', 'users', 'u', 'c.user_id = u.id')
			->where('c.product_id = :id')
			->setParameter('id', $productId)
			->fetchAllAssociative();
	}


}