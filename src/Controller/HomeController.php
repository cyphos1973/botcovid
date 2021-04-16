<?php
    
    namespace App\Controller;
    
    use App\Service\ApiCoronavirusFrance;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\JsonResponse;
    
    class HomeController extends AbstractController
    {
        
        /**
         * @Route("/department/{department}", name="app_department")
         */
        public function index(string $department, ApiCoronavirusFrance $apiCoronavirusFrance): JsonResponse
        {
            $data1 = $apiCoronavirusFrance->getDepartmentData('Marne');
            $data2 = $apiCoronavirusFrance->getFranceData();
            dump($data1);
            dump($data2);
            die();
            $datas = array_combine($data1, $data2);
//            $datas = array_merge($data1['LiveDataByDepartement'], $data2['allLiveFranceData']);
            $hospitalises = [];
            $reanimation = [];
            $nouvellesHospitalisations = [];
            $nouvellesReanimations = [];
            dump($datas);
            foreach ($datas as $data) {
                if( $data['nom'] === $department) {
                    $date[] = $data['date'];
                    $hospitalises[] = $data['hospitalises'];
                    $reanimation[] = $data['reanimation'];
                    $nouvellesHospitalisations[] = $data['nouvellesHospitalisations'];
                    $nouvellesReanimations[] = $data['nouvellesReanimations'];
                }
            }
    
            return new JsonResponse([
                'date' =>   $date,
                'hospitalises' =>   $hospitalises,
                'nouvellesHospitalisations' =>   $nouvellesHospitalisations,
                'reanimation' =>   $reanimation,
                'nouvellesReanimations' =>   $nouvellesReanimations,
            ]);
        }
    }
