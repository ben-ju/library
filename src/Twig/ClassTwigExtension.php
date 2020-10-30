<?php


namespace App\Twig;


use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ClassTwigExtension extends AbstractExtension
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_class', 'get_class'),
            new TwigFunction('wikipedia', [$this, 'getWikipediaAuthorUrl']),
        ];
    }

    public function getName(): string
    {
        return 'class_twig_extension';
    }

    /**
     * request wikipedia, check if an article exist with the search parameter and display the link
     * or display a link to our own author presentation
     * @param string $search
     * @return string
     */
    public function getWikipediaAuthorUrl(string $search)
    {
        $home = 'home';
        $request = <<<URL
        https://en.wikipedia.org/w/api.php?action=opensearch&format=json&search={$search}&namespace=0&limit=1
        URL;
        $response = $this->client->request(
            'GET',
            $request);
        if ($response->getStatusCode() === 200) {
            $jsonDecodedContent = json_decode($response->getContent(), true);

            if (isset($jsonDecodedContent[3][0])) {
                $wikipediaUrl = $jsonDecodedContent[3][0];
                return "<a href='{$wikipediaUrl}'>{$jsonDecodedContent[1][0]}</a>";
            }
        }
        return "<p class='text-muted'>{$search}</p>";
    }
}