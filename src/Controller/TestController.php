<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Manufacturer;
use App\Entity\Test;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[AsController]
class TestController extends AbstractController
{
        public $filename;
        public $data;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer)
    {
    }

    #[Route('/api/test', name: 'app_test', methods: 'POST')]
    public function post(Request $request, FileUploader $fileUploader): Response
    {

        $brochureFile = $request->files->get('file')->getData();
        dd($brochureFile);
        if ($brochureFile) {
            $brochureFileName = $fileUploader->upload($brochureFile);
            $product->setBrochureFilename($brochureFileName);
        }

        die();

        $newTest = new Test();
        $newTest->setTest('test_' . $request->toArray()['indicator']);
        $this->entityManager->persist($newTest);

        $manufacturer = $this->entityManager->getRepository(Manufacturer::class)->find(14);

        $newCountry = new Country();
        $newCountry->setName('random ' . rand(100, 9899));
        $newCountry->addManufacturer($manufacturer);
        $this->entityManager->persist($newCountry);
        $this->entityManager->flush();

        return new Response(
            $this->serializer->serialize($newCountry, 'json')
            , Response::HTTP_CREATED);
    }
}
