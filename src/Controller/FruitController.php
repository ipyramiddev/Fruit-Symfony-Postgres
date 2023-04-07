<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Fruit;
use App\Repository\FruitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class FruitController extends AbstractController
{
    private $entityManager;
    private $fruitRepository;
    private $mailer;
    public function __construct(EntityManagerInterface $entityManager, FruitRepository $FruitRepository, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->fruitRepository = $FruitRepository;
        $this->mailer = $mailer;
    }

    #[Route('/fruit', name: 'app_fruit')]

    public function index()
    {
        $data = $this->fruitRepository->findAll();

        $results = [];

        foreach ($data as $item) {
            $results[] = [
                'id' => $item->getId(),
                'genus' => $item->getGenus(),
                'name' => $item->getName(),
                'family' => $item->getFamily(),
                'nutritions' => $item->getNutritions(),
                'order_name' => $item->getOrderName()
            ];
        }

        if (count($data) > 0) {
            return new JsonResponse([
                'result' => 'success',
                'data' => $results
            ]);
        } else {
            return new JsonResponse(['result' => 'error']);
        }
    }

    #[Route('/fruit/init', name: 'app_fruit_init')]
    public function init()
    {
        $buildUrl = "https://fruityvice.com/api/fruit/all";
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $buildUrl);
        $result = json_decode($response->getContent());

        if ($result) {
            foreach ($result as $item) {
                $fruit = new Fruit();
                $fruit
                    ->setGenus($item->genus)
                    ->setName($item->name)
                    ->setFamily($item->family)
                    ->setOrderName($item->order)
                    ->setNutritions(json_encode($item->nutritions));

                $this->fruitRepository->save($fruit);
            }

            $this->sendEmail();

            return new JsonResponse(['result' => 'success']);
        } else {
            return new JsonResponse(['result' => 'error']);
        }
    }

    public function sendEmail()
    {
        $email = (new Email())
            ->from('levyeugene0183@gmail.com')
            ->to('svendev520@gmail.com')
            ->subject('Test email')
            ->text('This is a test email');

        $this->mailer->send($email);
    }
}