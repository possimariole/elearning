<?php


namespace App\Services\Impl;


use App\Entity\Apprenant;
use App\Services\IApprenantService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ApprenantService implements IApprenantService
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $orm, Security $security)
    {
        $this->em = $orm;
        $this->security = $security;
    }

    public function save(Apprenant $apprenant)
    {
        $user = $this->security->getUser();
        $apprenant->setCreatedBy($user);
        $this->em->persist($apprenant);
    }

    public function findById($id)
    {
        $adresse = $this->em->findById($id);
        return $adresse;
    }

    public function findAll()
    {
        return $this->em->findAll();
    }

    public function delete(Apprenant $apprenant)
    {
        // TODO: Implement delete() method.
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }
}