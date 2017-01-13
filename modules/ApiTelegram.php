<?php
require_once 'Curl.php';

class ApiTelegram extends Curl
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    private function api($method, $parametrs)
    {
        $getApi = $this->getCurl('https://api.telegram.org/bot' . $this->token . '/' . $method . '?' . $parametrs);
        return json_decode($getApi, true);
    }

    /**
     * @param String URL-адресс сайта.
     * @return mixed|null массив с данными сообщения.
     */
    public function setWebhook($url)
    {
        return $this->api('setWebhook', 'url='.$url);
    }
    /**
     *
     * @return mixed|null массив с данными сообщения.
     */
    public function getWebhookInfo()
    {
        return $this->api('getWebhookInfo', 'pending_update_count&last_error_message');
    }
    /**
     * Декодируем JSON.
     * @param JSON-array массив с кодированным JSON.
     * @return mixed массив с данными сообщения.
     */
    public function getUpdate($datas)
    {
        return json_decode(file_get_contents($datas), true);
    }
    /**
     * Отвечаем пользователю.
     * @param int ID чата.
     * @param String|int текст сообщения.
     * @return mixed массив с данными сообщения.
     */
    public function sendMessage($chatId, $message)
    {
        return $this->api('sendMessage', 'chat_id='.$chatId.'&text='.$message);
    }
}