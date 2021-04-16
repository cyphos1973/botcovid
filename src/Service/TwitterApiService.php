<?php
    
    namespace App\Service;
    
    use Abraham\TwitterOAuth\TwitterOAuth;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
    
    class TwitterApiService
    {
        private $getParams;
        
        public function __construct(ParameterBagInterface $getParams)
        {
            $this->getParams = $getParams;
        }
        
        public function post(string $content)
        {
            $apiKey = $this->getParams->get('TWITTER_API_KEY');
            $apiKeySecret = $this->getParams->get('TWITTER_API_SECRET');
            $accessToken = $this->getParams->get('TWITTER_ACCESS_TOKEN');
            $accessTokenKey = $this->getParams->get('TWITTER_ACCESS_TOKEN_SECRET');
            
            $connection = new TwitterOAuth($apiKey, $apiKeySecret, $accessToken, $accessTokenKey);
            $connection->post("statuses/update", ["status" => $content]);
        }
        
    }