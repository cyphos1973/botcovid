<?php
    
    namespace App\Command;
    
    use App\Service\GetDatasService;
    use App\Service\TwitterApiService;
    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;
    
    class CommandCovidHospitalises2021 extends Command
    {
        private $getData;
        private $twitterApi;
        protected static $defaultName = 'bot:post';
        
        public function __construct(GetDatasService $getData, TwitterApiService $twitterApi)
        {
            parent::__construct();
            $this->getData = $getData;
            $this->twitterApi = $twitterApi;
        }
        
        protected function configure()
        {
        
        }
        
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $content = $this->getData->fromGouv();
            $this->twitterApi->post($content);
            return Command::SUCCESS;
        }
    }