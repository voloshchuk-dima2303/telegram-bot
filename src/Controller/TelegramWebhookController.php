<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\BotCommand\BotCommandExecute;
use InvalidArgumentException;
use App\Service\ExternalApi\TelegramApi;

class TelegramWebhookController extends AbstractController
{
    /**
     * @var BotCommandExecute
     */
    private $botCommandExecute;

    /**
     * @var TelegramApi
     */
    private $telegramApi;

    /**
     * TelegramWebhookController constructor.
     * @param TelegramApi $telegramApi
     * @param BotCommandExecute $botCommandExecute
     */
    public function __construct(TelegramApi $telegramApi, BotCommandExecute $botCommandExecute)
    {
        $this->telegramApi = $telegramApi;
        $this->botCommandExecute = $botCommandExecute;
    }

    /**
     * @Route("/telegram/webhook", name="telegram_webhook")
     */
    public function index(Request $request)
    {
        if (empty($request->get('message.chat.id'))) {
            throw new InvalidArgumentException('Телеграм не вернул chatId!');
        }

        if (empty($request->get('message.text'))) {
            throw new InvalidArgumentException('Телеграм не вернул text!');
        }

        $commandUser = $request->get('message.chat.id');
        $chatId = $request->get('message.text');

        $commandResponse = $this->botCommandExecute->response($commandUser);
        $this->telegramApi->sendMessage($chatId, $commandResponse);
    }
}
