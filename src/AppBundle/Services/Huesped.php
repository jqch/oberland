<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class Huesped{

	protected $em;

	public function __construct(EntityManager $entityManager){
		$this->em = $entityManager;
	}

	public function getHuesped(){
		return "pepito";
	}

}