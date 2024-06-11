<?php

namespace LuxChill\Models;

use Doctrine\DBAL\Exception;
use LuxChill\Commons\Model;

class OrderDetail extends Model
{
	protected string $tableName = 'order_details';

	public function getAllOrderDetailByProductId($orderId)
	{
		$queryBuilder = clone($this->queryBuilder);
		return $queryBuilder
			->select('*')
			->from($this->tableName)
			->where('order_id = :orderId')
//			->andWhere('product_id = :productId')
			->setParameter('orderId', $orderId)
//			->setParameter('product_id', $productId)
			->fetchAllAssociative();
	}

	public function getAllOrderDetail($orderId, $productId)
	{
		$queryBuilder = clone($this->queryBuilder);
		return $queryBuilder
			->select('od.id as od_id', 'od.order_id as od_order_id', 'od.product_id as od_product_id', 'od.qty as od_qty', 'p.name as p_name', 'p.id as p_id', 'p.image', 'p.price as p_price', 'p.price_offer as p_priceOffer', 'p.sku as p_sku')
			->from($this->tableName, 'od')
			->innerJoin('od', 'products', 'p', 'od.product_id = p.id')
			->where('od.order_id = :orderId')
			->andWhere('od.product_id = :productId')
			->setParameter('orderId', $orderId)
			->setParameter('productId', $productId)
			->fetchAssociative();
	}

	public function getOne($id)
	{
		$queryBuilder = clone($this->queryBuilder);
		return $queryBuilder
			->select('*')
			->from($this->tableName)
			->where('id = :id')
			->setParameter('id', $id)
			->fetchAssociative();
	}

	public function getOneOrderDetail($detailId, $productId)
	{
		$queryBuilder = clone($this->queryBuilder);
		return $queryBuilder
			->select('od.id as od_id', 'od.order_id as od_order_id', 'od.product_id as od_product_id', 'od.qty as od_qty', 'p.name as p_name', 'p.id as p_id', 'p.image', 'p.price as p_price', 'p.price_offer as p_priceOffer', 'p.sku as p_sku', 'o.status as o_status', 'o.address_shipping as o_addressShipping', 'o.user_name as o_username')
			->from($this->tableName, 'od')
			->innerJoin('od', 'products', 'p', 'od.product_id = p.id')
			->innerJoin('od', 'orders', 'o', 'od.order_id = o.id')
			->where('od.id = :orderId')
			->andWhere('od.product_id = :productId')
			->setParameter('orderId', $detailId)
			->setParameter('productId', $productId)
			->fetchAssociative();
	}

	public function paginateAbc($page = 1, $perPage = self::PER_PAGE)
	{
		$queryBuilder = clone($this->queryBuilder);
		$totalPage = ceil($this->count() / $perPage);
		$offset = $perPage * ($page - 1);
		try {
			$data = $queryBuilder
				->select('od.id as od_id', 'od.order_id as order_id', 'od.product_id as or_productId', 'od.product_name as od_productName', 'od.price as od_price', 'od.price_offer as od_priceOffer', 'od.qty as od_qty', 'o.id as o_id', 'o.status as o_status', 'p.image as p_image')
				->from($this->tableName, 'od')
				->innerJoin('od', 'orders', 'o', 'od.order_id = o.id')
				->innerJoin('od', 'products', 'p', 'od.product_id = p.id')
				->setFirstResult($offset)
				->setMaxResults($perPage)
				->orderBy('od.id', 'DESC')
				->fetchAllAssociative();

			return [$data, $totalPage];
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function findOne($id)
	{
		$queryBuilder = clone($this->queryBuilder);
		try {
			$data = $queryBuilder
				->select('od.id as od_id', 'od.order_id as order_id', 'od.product_id as or_productId', 'od.product_name as od_productName', 'od.price as od_price', 'od.price_offer as od_priceOffer', 'od.qty as od_qty', 'o.id as o_id', 'o.status as o_status', 'p.image as p_image')
				->from($this->tableName, 'od')
				->innerJoin('od', 'orders', 'o', 'od.order_id = o.id')
				->innerJoin('od', 'products', 'p', 'od.product_id = p.id')
				->where('od.id = :id')
				->setParameter('id', $id)
				->orderBy('od.id', 'DESC')
				->fetchAssociative();

			return $data;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

//	public function paginate($page = 1, $perPage = self::PER_PAGE)
//	{
//		$totalPage = ceil($this->count() / $perPage);
//		$queryBuilder = clone($this->queryBuilder);
//		$offset = $perPage * ($page - 1);
//
//		try {
//			$queryBuilder
//				->select(
//					'od.id as od_id',
//					'od.order_id as order_id',
//					'od.product_id as od_productId',
//					'od.product_name as od_productName',
//					'od.price as od_price',
//					'od.price_offer as od_priceOffer',
//					'od.qty as od_qty',
//					'p.image as p_image',
//					'p.slug as p_slug'
//				)
//				->from($this->tableName, 'od')
//				->innerJoin('od', 'products', 'p', 'od.product_id = p.id')
//				->where('od.order_id = :order_id')
//				->setParameter('order_id', $orderId)
//				->setFirstResult($offset)
//				->setMaxResults($perPage)
//				->orderBy('od.id', 'DESC');
//
//			// Debug SQL query
////			echo $queryBuilder->getSQL();
//
//			$data = $queryBuilder->fetchAssociative();
//
//			return [$data, $totalPage];
//		} catch (Exception $e) {
//			die($e->getMessage());
//		}
//	}

}