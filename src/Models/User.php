<?php

namespace LuxChill\Models;

use LuxChill\Commons\Model;

class User extends Model
{
	protected string $tableName = 'users';

//	public function emailExists($email)
//	{
//		try {
//			$existingUser = $this->queryBuilder
//				->select('*')
//				->from($this->tableName)
//				->where("email = :email")
//				->setParameter('email', $email)
//				->executeQuery()
//				->fetchAssociative();
//
//			return $existingUser !== false;
//		} catch (\Exception $e) {
//			die('LuxChill: ' . $e->getMessage());
//		}
//	}

	public function emailExists($email, $ignoreId = null)
	{
		try {
			$query = $this->queryBuilder
				->select('*')
				->from($this->tableName)
				->where("email = :email")
				->setParameter('email', $email);

			if ($ignoreId) {
				$query->andWhere("id != :id")
					->setParameter('id', $ignoreId);
			}

			$existingUser = $query->executeQuery()->fetchAssociative();

			return $existingUser !== false;
		} catch (\Exception $e) {
			die('LuxChill: ' . $e->getMessage());
		}
	}

	public function getByEmail($email)
	{
		return $this->queryBuilder
			->select('*')
			->from($this->tableName)
			->where('email = ?')
			->setParameter(0, $email)
			->fetchAssociative();
	}


}