<?php

namespace LuxChill\Models;

use LuxChill\Commons\Model;

class CartDetail extends Model
{
	protected string $tableName = 'cart_details';

	public function findByCartIdAndProductId($cartId, $productId)
	{
		return $this->queryBuilder
			->select('*')
			->from($this->tableName)
			->where('cart_id = :cartId')
			->andWhere('product_id = :productId')
			->setParameter('cartId', $cartId)
			->setParameter('productId', $productId)
			->fetchAssociative();
	}

	public function deleteByCartID($cartID)
	{
		return $this->queryBuilder
			->delete($this->tableName)
			->where('cart_id = ?')
			->setParameter(0, $cartID)
			->executeQuery();
	}


	public function deleteByCartIDAndProductID($cartID, $productID)
	{
		return $this->queryBuilder
			->delete($this->tableName)
			->where('cart_id = ?')->setParameter(0, $cartID)
			->andWhere('product_id = ?')->setParameter(1, $productID)
			->executeQuery();
	}

	public function updateByCartIDAndProductID($cartID, $productID, $quantity)
	{
		$query = $this->queryBuilder->update($this->tableName);

		$query
			->set('quantity', '?')->setParameter(0, $quantity)
			->where('cart_id = ?')->setParameter(1, $cartID)
			->andWhere('product_id = ?')->setParameter(2, $productID)
			->executeQuery();
	}

	public function updateQty($id, $productId, $quantity)
	{
		return $this->queryBuilder
			->update($this->tableName)
			->set('quantity', ':qty')
			->where('id = :id')
			->andWhere('product_id = :product_id')
			->setParameter('qty', $quantity)
			->setParameter('id', $id)
			->setParameter('product_id', $productId)
			->executeQuery();
	}

	public function getCount($id)
	{
		return $this->queryBuilder
			->select("COUNT(*)")
			->from($this->tableName)
			->where('cart_id = :id')
			->setParameter('id', $id)
			->fetchOne();
	}

	public function selectInnerJoinProduct($cart_id)
	{
		$queryBuilder = clone($this->queryBuilder);
		return $queryBuilder
			->select('c.id as c_id', 'c.cart_id', 'c.quantity', 'p.id as p_id', 'p.name', 'p.slug', 'p.image', 'p.category_id', 'p.price', 'p.price_offer', 'p.quantity as p_quantity', 'p.sku', 'p.status', 'type')
			->from($this->tableName, 'c')
			->innerJoin('c', 'products', 'p', 'p.id = c.product_id')
			->where('c.cart_id = :id')
			->setParameter('id', $cart_id)
			->fetchAllAssociative();
	}
}