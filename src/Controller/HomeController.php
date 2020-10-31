<?php

namespace App\Controller;

use App\Entity\Document;
use App\Repository\AuthorRepository;
use App\Repository\DocumentRepository;
use App\Services\SessionService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private SessionService $sessionService;

    /**
     * if the user is not connected we don't display the recently viewed documents
     * else we display
     * @Route("/", name="home")
     * @param SessionService $sessionService
     * @return Response
     */
    public function homepage(SessionService $sessionService): Response
    {
        if (!$this->getUser()) {
            return $this->render('home/homepage.twig');
        }
        return $this->render('home/homepage.twig', [
            'viewedDocuments' => $sessionService->getFormattedViewedDocuments()
        ]);

    }

    /**
     * display all documents
     * if a document id is specified in the url then it only display the document
     * @Route("/document", name="shopping")
     * @Route("/document/{id}", name="full_document")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param DocumentRepository $repository
     * @param Document|null $id
     * @param SessionService $sessionService
     * @return Response
     */
    public function documentPage(PaginatorInterface $paginator,
                                 Request $request,
                                 DocumentRepository $repository,
                                 Document $id = null,
                                 SessionService $sessionService): Response
    {
        $bool = false;

        if ($id !== null) {
            $sessionService->addDocumentViewed($id);
            return $this->render('home/full-document.html.twig', [
                'document' => $id
            ]);
        }
        if (($search = $request->query->get('q')) !== null) {
            $query = $repository->searchByTitle($search);
            $bool = true;
        } else {
            $query = $repository->findAll();
        }

//        Pagination
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

    /**
     * @Route("/pricing", name="pricing")
     * @return Response
     */
    public function pricingPage(): Response
    {
        return $this->render('home/pricing.html.twig');
    }

    /**
     * @Route("/authors", name="authors")
     * @param AuthorRepository $repository
     */
    public function author(AuthorRepository $repository)
    {
           $authors = $repository->findBy([], ['lastname' => 'ASC']);

           dd($authors);
    }

    /**
     * @Route("/clear", name="clear")
     */
    public function clear()
    {
        $this->sessionService->clearSession();
    }
}
