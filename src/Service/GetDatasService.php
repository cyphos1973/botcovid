<?php
    
    namespace App\Service;
    
    use Symfony\Contracts\HttpClient\HttpClientInterface;
    
    class GetDatasService
    {
        private $client;
        
        public function __construct(HttpClientInterface $client)
        {
            $this->client = $client;
        }
        
        public function fromGouv(): string
        {
            $response = $this->client->request(
                'GET',
                'https://coronavirusapi-france.now.sh/LiveDataByDepartement?Departement=Marne'
            );
            
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getContent(), true);
                $date = new \DateTime($data['LiveDataByDepartement'][0]['date']);
                $hospitalises = $data['LiveDataByDepartement'][0]['hospitalises'];
                $nouvellesHospitalisations = $data['LiveDataByDepartement'][0]['nouvellesHospitalisations'];
//                dump($date);
//                die('stop');
                return '[Marne] Au ' . $date->format('d/m/Y') . ', il y a ' . $hospitalises . ' patients hospitalisés (+ ' .
                    $nouvellesHospitalisations . ' nouveaux). Source : Santé publique France Data.';
            } else {
                return new JsonResponse([
                    'success' => false,
                ]);
            }
            
            
        }
    }