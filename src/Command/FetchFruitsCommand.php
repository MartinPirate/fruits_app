<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Entity\FruitFamily;
use App\Entity\FruitGenus;
use App\Entity\FruitOrder;
use App\Entity\Genus;
use App\Entity\Nutrition;
use App\Entity\Order;
use App\HttpClient\FruitsApiHttpClient;
use App\Notifications\FruitFetchedNotification;
use App\Service\FruitService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:fetch-fruits',
    description: 'Fetch fruits from API and save them to the database',
    aliases: ['app:fetch-fruits'],
    hidden: false
)]
class FetchFruitsCommand extends Command
{
    private $em;
    private $fruitService;

    private $notificationService;


    private FruitsApiHttpClient $client;

    public function __construct(EntityManagerInterface $em, FruitService $fruitService, FruitsApiHttpClient $client, FruitFetchedNotification $notificationService)
    {
        $this->em = $em;
        $this->client = $client;
        $this->fruitService = $fruitService;
        $this->notificationService = $notificationService;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('app:fetch-fruits')->setDescription('Fetch fruits from API and save them to the database');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface|DecodingExceptionInterface
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $fruits = $this->client->fetchAllFruits();

        foreach ($fruits as $fruit) {

            $this->fruitService->createNutrition($fruit);
        }
        $output->writeln('Fruits fetched and saved to the database');

        try {
            //$this->notificationService->sendNotificationEmail();
        } catch (\Exception) {
            $output->writeln('Error sending notification email');
        }

        $output->writeln('Email sent');

        return Command::SUCCESS;
    }


}
