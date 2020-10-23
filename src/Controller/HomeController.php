<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Novel;
use App\Repository\DocumentRepository;
use App\Repository\NovelRepository;
use Doctrine\ORM\EntityManager;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage(): Response
    {
        return $this->render('home/homepage.twig');
    }


    /**
     * @Route("/document", name="shopping")
     * @Route("/document/{id}", name="full_document")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param DocumentRepository $repository
     * @param Document|null $id
     * @return Response
     */
    public function documentPage(PaginatorInterface $paginator,
                                 Request $request,
                                 DocumentRepository $repository,
                                 Document $id = null): Response
    {
        if ($id !== null) {
            return $this->render('home/full-document.html.twig', [
                'document' => $id
            ]);
        }
        $bool = false;
        if (($search = $request->query->get('q')) !== null) {
            $query = $repository->searchByTitle($search);
            $bool = true;
        } else {
            $query = $repository->findAll();
        }
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        $pagination->setCustomParameters([
            'align' => 'center',
        ]);

        return $this->render('home/shopping.html.twig', [
            'pagination' => $pagination,
            'search' => $search,
            'query' => $bool
        ]);
    }

// Filter with the header form documents by category
    public function getDocumentsByCategories()
    {

    }
}
