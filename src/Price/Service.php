<?php
namespace TNTExpressConnect\Price;

use TNTExpressConnect\AbstractService;

class Service extends AbstractService
{
    const URL = 'https://express.tnt.com/expressconnect/pricing/getprice';
    
    public function send($xml)
    {
        $response = $this->client->request('POST', static::URL, [
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF8',
            ],
            'auth' => [$this->getUsername(), $this->getPassword()],
            'body' => $this->serializer->serialize($xml)
        ]);
        
        return $this->serializer->deserialize(
            (string) $response->getBody(),
            'TNTExpressConnect\Price\XSD\Document'
        );
    }
}
