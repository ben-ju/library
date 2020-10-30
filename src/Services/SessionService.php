<?php


namespace App\Services;


use App\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService extends AbstractController
{
    /**
     * display the number of documents viewed
     */
    private const NUMBER_VIEWED_HISTORY = 4;

    protected SessionInterface $session;

    /**
     * get the session of the current user
     * SessionService constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * add to the session with the index "viewed_document" a given document
     * @param Document $document
     */
    public function addDocumentViewed(Document $document): void
    {

        $viewedDocuments = $this->session->get('viewed_documents', []);

        if (!empty($viewedDocuments[$document->getId()])) {
            $viewedDocuments[$document->getId()]++;
        } else {
            $viewedDocuments[$document->getId()] = 1;
        }
        $this->session->set('viewed_documents', $viewedDocuments);

    }

    /**
     * add to the session with the index "shopping_cart" a given document
     * @param Document $document
     */
    public function addDocumentCart(Document $document): void
    {
        $shoppingCart = $this->getShoppingCart();

        if (!empty($shoppingCart[$document->getId()])) {
            $shoppingCart[$document->getId()]++;
        } else {
            $shoppingCart[$document->getId()] = 1;
        }
        $this->session->set('shopping_cart', $shoppingCart);
    }

    /**
     * delete from the session with the index "shopping_cart" a given document
     * @param Document $document
     */
    public function deleteDocumentCart(Document $document): void
    {
        $shoppingCart = $this->getShoppingCart();
        if (array_key_exists($document->getId(), $shoppingCart)) {
            if ($shoppingCart[$document->getId()] > 1) {
                $shoppingCart[$document->getId()]--;
            } else {
                unset($shoppingCart[$document->getId()]);
            }
            $this->session->set('shopping_cart', $shoppingCart);
        }
    }

    /**
     * get the lasts ?NUMBER_VIEWED_HISTORY? viewed documents
     * @return array
     */
    public function getFormattedViewedDocuments(): array
    {

        $repository = $this->getDoctrine()->getRepository(Document::class);

        $documents = [];

        foreach ($this->getViewedDocuments() as $id => $viewedTimes) {

            $documents[] = [
                'document' => $repository->find($id),
                'viewed_times' => $viewedTimes
            ];
        }

        $count = count($documents);
        $documents = array_reverse($documents);

        if ($count > 4) {
            $documents = array_splice($documents, 0, self::NUMBER_VIEWED_HISTORY);
        }
        return $documents;
    }

    /**
     * return the actual shopping cart and also the total of quantity
     * @return array
     */
    public function getFormattedShoppingCart(): array
    {
        $repository = $this->getDoctrine()->getRepository(Document::class);

        $documents = [];
        foreach ($this->getShoppingCart() as $id => $quantity) {
            $documents[] = [
                'document' => $repository->find($id),
                'quantity' => $quantity,
            ];
        }

        return ['documents' => $documents, 'total' => $this->getTotalQuantity()];
    }

    /**
     * return the viewedDocuments
     * @return mixed
     */
    public function getViewedDocuments()
    {
        return $this->session->get('viewed_documents', []);
    }

    /**
     * return the viewedDocuments
     * @return mixed
     */
    public function getShoppingCart()
    {
        return $this->session->get('shopping_cart', []);

    }

    public function getTotalQuantity()
    {
        $i = 0;
        foreach ($this->getShoppingCart() as $key => $value) {
            $i += $value;
        }
        return $i;
    }

    public function clearSession(): void
    {
        $this->session->clear();
    }
}