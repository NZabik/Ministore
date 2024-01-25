<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Item>
 *
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }
    // Find/search articles by title/content
    public function findArticlesByName(string $query, $sort)
    {
        $qb = $this->createQueryBuilder('c');
        if ($query) {
            $qb->andWhere('c.name LIKE :term')
                ->setParameter('term', '%' . $query . '%');
        }
        return $qb
            ->orderBy('c.name', $sort)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findArticlesByAll($query, $query2, $sort)
{
    if($query == "") {
        return $this->createQueryBuilder("a")
        ->andWhere('a.category = :category')
        ->setParameter('category',$query2)
        ->orderBy('a.name', $sort)
        ->getQuery()
        ->getResult()
    ;
    } else if ($query2 == "") {
        return $this->createQueryBuilder("a")
        ->andWhere('a.id = :name')
        ->setParameter('name',$query)
        ->getQuery()
        ->getResult()
    ;
    } else {
        return $this->createQueryBuilder("a")
        ->andwhere('a.id = :name')
        ->andWhere('a.category = :category')
        ->setParameter('name',$query)
        ->setParameter('category',$query2)
        ->getQuery()
        ->getResult()
    ;
}
}
}
