<?php


namespace App\Services;


use App\Entity\Adresse;

interface IAdresseService
{
    public function save(Adresse $adresse);

    public function findById($id);

    public function findAll();

    public function findOneByEmail();

    public function delete(Adresse $adresse);

    public function deleteById($id);
}