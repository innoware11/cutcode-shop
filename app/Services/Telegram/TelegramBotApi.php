<?php

namespace App\Services\Telegram;

use App\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';
    public static function sendMessage(string $token, string $chatId, string $text): bool {
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', [
               'chat_id' => $chatId,
               'text' => $text,
            ])->throw()->json();

            return $response['ok'] ?? false;
        } catch (\Exception $e) {
            report(new TelegramBotApiException($e->getMessage()));

            return false;
        }
    }
}
