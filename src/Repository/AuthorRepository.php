<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    /**
     * Find authors by country name.
     *
     * @param string $countryName The name of the country to find authors from.
     * @return Author[] Returns an array of Author objects
     */
    public function findByCountry(string $countryName): array
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.country', 'c')
            ->where('c.name = :countryName')
            ->setParameter('countryName', $countryName)
            ->getQuery()
            ->getResult();
    }

    // Add other custom repository methods below
}
