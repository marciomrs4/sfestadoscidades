<?php
namespace Mrs\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CidadesRepository extends EntityRepository
{
	
	public function findAllInOrder()
	{
		return $this->getEntityManager()
				    ->getRepository("Mrs\BlogBundle\Entity\Cidades")
					->createQueryBuilder('c')
                                        ->select('c.id','c.nome','c.prefeito')
					->orderBy('c.nome', 'desc')
					->getQuery()->getResult();
				
	}

	public function meuNovoMetodoAqui()
	{
		return $this->getEntityManager()
					->getRepository("Mrs\BlogBundle\Entity\Cidades")
					->createQueryBuilder('c')
					->orderBy('c.estados_id', 'desc')
					->getQuery()->getResult();
	
	}
	
}