<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ImageUploadController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request): Image
    {
        $newImage = new Image();
        $newImage->setTitle($request->request->get('title'));
        $newImage->setImageFile($request->files->get('file'));

        $this->entityManager->persist($newImage);
        $this->entityManager->flush();

        return $newImage;
    }
}
