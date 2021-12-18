<?php
namespace ICS\StoryhelperBundle\Controller;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ICS\StoryhelperBundle\Form\Type\SceneType;
use ICS\StoryhelperBundle\Form\Type\ChapterType;
use ICS\StoryhelperBundle\Entity\Scene;
use ICS\StoryhelperBundle\Entity\Chapter;
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

    /**
    * @Route("/write/book/{book}/{chapter}/{scene}",name="ics-storyhelper-book-homepage")
    */
    public function book(Request $request, EntityManagerInterface $doctrine, Book $book, Chapter $chapter = null, Scene $scene = null)
    {
        
        if(count($book->getChapters()) == 0)
        {
            return $this->redirectToRoute("ics-storyhelper-chapter-add",['book' => $book->getId()]);
        }

        if($scene != null)
        {
            $form=$this->createForm(SceneType::class,$scene,[]);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $scene=$form->getData();
                $doctrine->persist($scene);
                $doctrine->flush();
                $this->addFlash('success','Modification de la scene effectuée.');
            }
        }

        if($chapter!=null)
        {
            $chapterForm = $this->createForm(ChapterType::class,$chapter);
            $chapterForm->handleRequest($request);

            if($chapterForm->isSubmitted() && $chapterForm->isValid())
            {
                $chapter = $chapterForm->getData();
                $doctrine->persist($chapter);
                $doctrine->flush();
                $this->addFlash('success','Modification du chapître effectuée.');
            }
        }
        
        return $this->render('@Storyhelper\book.html.twig',[
            'book' => $book,
            'chapter' => $chapter,
            'scene' => $scene,
            'form' => $form->createView(),
            'chapterForm' => $chapterForm->createView(),
        ]);
    }

    /**
    * @Route("/book/structure/{book}",name="ics-storyhelper-book-structure")
    */
    public function bookStructure(RouterInterface $router, Book $book)
    {
        $structure = [];

        foreach($book->getChapters() as $chapt)
        {
            $chapter=[];
            $chapter['text']= $chapt->getTitle();
            $chapter['icon']='fas fa-scroll';
            
            foreach($chapt->getScenes() as $scn)
            {
                $scene=[];
                $scene['text']=substr(strip_tags($scn->getResume()),0,50);
                $scene['text'].='<a class="btn btn-warning btn-sm float-end" href="';
                $scene['text'].= $router->generate(
                        "ics-storyhelper-book-homepage",
                        [
                            'book' => $book->getId(),
                            'chapter' => $chapt->getId(),
                            'scene' => $scn->getId()
                        ]);
                $scene['text'].='"><i class="fa fa-edit"></i></a>';
                $scene['icon']='fa fa-feather';
                $scene['nodes'][]=[
                    'text' => 'Personnages',
                    'icon' => 'fa fa-user'
                ];
                $scene['nodes'][]=[
                    'text' => 'Artefacts',
                    'icon' => 'fa fa-tools'
                ];
                $scene['nodes'][]=[
                    'text' => 'Lieux',
                    'icon' => 'fas fa-compass'
                ];

                $chapter['nodes'][]=$scene;
            }
            
            $structure[]=$chapter;
        }
        
        return new JsonResponse($structure);
    }

    /**
    * @Route("/chapter/add/{book}",name="ics-storyhelper-chapter-add")
    */
    public function createChapter(EntityManagerInterface $em, Book $book)
    {
        $chapter = new Chapter();
        $chapter->setNumber(count($book->getChapters()) + 1);
        $chapter->setTitle('Nouveau chapître');
        $chapter->setBook($book);
        $em->persist($chapter);
        $em->flush();
        $book->getChapters()->add($chapter);
        $em->persist($book);
        $em->flush();
        return $this->redirectToRoute("ics-storyhelper-scene-add",['book' => $book->getId(),'chapter' => $chapter->getId()]);
    }

    /**
    * @Route("/scene/add/{book}/{chapter}",name="ics-storyhelper-scene-add")
    */
    public function createScene(EntityManagerInterface $em, Book $book,Chapter $chapter)
    {
        $scene = new Scene();
        $scene->setResume('Nouvelle scene.');
        $scene->setChapter($chapter);
        $em->persist($scene);
        $em->flush();
        $chapter->getScenes()->add($scene);
        $em->persist($chapter);
        $em->flush();
        return $this->redirectToRoute("ics-storyhelper-book-homepage",['book' => $book->getId(),'chapter' => $chapter->getId(),'scene' => $scene->getId()]);
    }

}