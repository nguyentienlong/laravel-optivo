<?php

namespace Longkyanh\Mailer;

use Exception;
use GuzzleHttp\ClientInterface;

/**
 * @author Long Nguyen <nguyentienlong88@gmail.com>
 */
class Optivo
{
    /**
    * @var ClientInterface Guzzle Client.
    */
    protected $client;

    /**
     * @var array Optivo Configuration Array.
     */
    protected $config;

    /**
    * @var string API URL.
    */
    protected $url;

    /**
    * Contructor.
    *
    * @param ClientInterface $client Guzzle Client.
    * @param array $config Optivo Configuration Array.
    */
    public function __construct(ClientInterface $client, $config)
    {
        $this->client = $client;
        $this->config = $config;
        $this->url    = $config['domain'];
    }

    /**
    * Send Transaction Mail
    *
    * @param  string $mailingListName Mailing list name.
    * @param  string $recipient Recipient.
    * @param  string $locale Locale
    * @param  array  $data
    *
    * @return array Sent status of recipient.
    */
    public function send(string $mailingListName, string $locale, string $recipient, array $data) : array
    {
        $mailListConfig = $config['mailing-list'][$mailingListName];
        //Check whether required params in optivo config file is matched with key in $data
        $requiredParams = $mailListConfig['required-params'];
        $this->validateData($requiredParams, $data);
        //build optivo api url
        $apiUrl      = $this->buildUrl('form', 'sendtransactionmail', $mailListConfig, $locale, $recipient, $data);
        $apiResponse = $this->client->get($apiUrl);
        $response    = [
            $recipient => [
                'message' => $apiResponse->getBody()->read(1024),
            ],
        ];

        return $response;
    }

    /**
    * Build url based on serviceType, operation, mailingListName.
    *
    * @param string $serviceType     for eg: mail, form
    * @param string $operation       for eg: sendeventmail, remove, sendtransactionmail, subscribe ...
    * @param array $mailListConfig Mailing List Config
    * @param string $locale          for eg: en or th
    * @param string $recipient       for eg: someone(at)example.com
    * @param array $data
    *
    * @throws Exception
    *
    * @return string Returns API URL.
    */
    protected function buildUrl(
        string $serviceType,
        string $operation,
        array $mailListConfig,
        string $locale,
        string $recipient,
        array $data
    ) : string {

        $apiUrl = $this->url . $serviceType;

        switch ($operation) {
            case 'sendtransactionmail':
                $bmMailingId       = $mailListConfig[$locale]['id'];
                $authorisationCode = $mailListConfig['recipient-list']['authorisation-code'];
                $apiUrl           .=
                    '/' . $authorisationCode .
                    '/' . $operation .
                    '?bmMailingId=' . $bmMailingId .
                    '&bmRecipientId=' . $recipient .
                    '&' . http_build_query($data);
                break;
            default:
                throw new Exception($operation . ' is not a valid email operation');
        }

        return $apiUrl;
    }

    /**
     * Check whether required params in optivo config file is matched with key in $data.
     *
     * @param  array  $requiredParams params that corresponded with optivo custom field.
     * @param  array  $data           data want to send to optivo.
     *
     * @throws Exception
     *
     * @return void
     */
    protected function validateData(array $requiredParams, array $data)
    {
        foreach ($requiredParams as $param) {
            if (!array_key_exists($param, $data))
                throw new Exception($param . ' is required');
        }

        return;
    }
}
