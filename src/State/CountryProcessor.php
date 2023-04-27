<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\CountryRepository;
use Doctrine\Persistence\ObjectManager;

class CountryProcessor implements ProcessorInterface
{
    public function __construct(private CountryRepository $countryRepository)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $data->setName('Country Name: ' . ' ' . $data->getName());
        $this->countryRepository->save($data);
    }
}