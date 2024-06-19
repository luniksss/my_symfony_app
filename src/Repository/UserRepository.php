<?php
declare(strict_types=1);

namespace App\Repository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(User::class);
    }

    public function findById($id): ?User
    {
        return $this->repository->findOneBy(['id' => (string)
         $id]);
    }

    public function store(User $user): int
    {
        $this->em->persist($user);
        $this->em->flush();
        return $user->getUserId();
    }

    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    public function listAll(): array
    {
        return $this->repository->findAll();
    }
}
?>