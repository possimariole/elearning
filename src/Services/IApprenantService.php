<?php


namespace App\Services;


use App\Entity\Apprenant;

interface IApprenantService
{
    public function save(Apprenant $apprenant);

    public function findById($id);

    public function findAll();

    public function delete(Apprenant $apprenant);

    public function deleteById($id);
}