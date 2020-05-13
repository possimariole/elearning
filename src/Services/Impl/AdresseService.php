<?php


namespace App\Services\Impl;


use App\Entity\Adresse;
use App\Services\IAdresseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class AdresseService implements IAdresseService
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $orm, Security $security)
    {
        $this->em = $orm;
        $this->security = $security;
    }

    public function save(Adresse $adresse)
    {
        $user = $this->security->getUser();
        $adresse->setCreatedBy($user);
        $this->em->persist($adresse);
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

    public function findOneByEmail()
    {
        // TODO: Implement findOneByEmail() method.
    }

    public function delete(Adresse $adresse)
    {
        // TODO: Implement delete() method.
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }
}