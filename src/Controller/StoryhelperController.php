<?php
namespace ICS\StoryhelperBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ICS\StoryhelperBundle\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class StoryhelperController extends AbstractController
{

    /**
    * @Route("/",name="ics-storyhelper-homepage")
    */
    public function index(EntityManagerInterface $doctrine)
    {
        $books = $doctrine->getRepository(Book::class)->findAll();

        return $this->render('@Storyhelper\index.html.twig',[
            'books' =>$books
        ]);
    }

}