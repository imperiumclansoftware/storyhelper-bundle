<?php
namespace ICS\StoryhelperBundle\Controller;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ICS\StoryhelperBundle\Form\Type\BookType;
use ICS\StoryhelperBundle\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookController extends AbstractController
{

    /**
    * @Route("/book/list",name="ics-storyhelper-book-list")
    */
    public function list(EntityManagerInterface $doctrine)
    {
        $books = $doctrine->getRepository(Book::class)->findAll();

        return $this->render('@Storyhelper\index.html.twig',[
            'books' =>$books
        ]);
    }

    /**
    * @Route("/book/add",name="ics-storyhelper-book-add")
    * @Route("/book/edit/{book}",name="ics-storyhelper-book-edit")
    */
    public function edit(Request $request, EntityManagerInterface $doctrine,TranslatorInterface $translator, Book $book=null)
    {
        
        if($book==null)
        {
            $title='<i class="fa fa-plus"></i> Add new book';
            $book = new Book();
        }
        else
        {
            $title='<i class="fa fa-edit"></i> Edit book <small class="text-info">'.$book->getProjectTitle().'</small>';
        }
        
        $form = $this->createForm(BookType::class,$book,[]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $book=$form->getData();
            $doctrine->persist($book);
            $doctrine->flush();

            $this->addFlash('success', sprintf($translator->trans('Book <b>%s</b> was recorded'),$book));
        }

        return $this->render('@Storyhelper/book/edit.html.twig',[
            'form' => $form->createView(),
            'title' => $title
        ]);
    }

}