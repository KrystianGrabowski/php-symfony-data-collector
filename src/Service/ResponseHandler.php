<?php
namespace App\Service;

use App\Entity\AdStats;
use App\Entity\AdStatsSettings;
use Doctrine\ORM\EntityManagerInterface;

class ResponseHandler
{
    private $conn;

    function __construct(EntityManagerInterface $em)
    {
        $this->conn = $em;
    }
    
    public function handle($response)
    {
        $settings_id = $this->handleSettings($response['settings']);
        $headers = $this->handleHeaders($response['headers']);
        $this->handleData($response['data'], $headers, $settings_id);
    }

    private function handleSettings($settings) :int
    {
        $ad_settings = $this->conn
            ->getRepository(AdStatsSettings::class)
            ->findOneBy(['currency' => $settings['currency'],
                         'period_length' => $settings['PeriodLength']]
            );

        if ($ad_settings == null)
        {
            $ad_settings = new AdStatsSettings();
            $ad_settings->setCurrency($settings['currency']);
            $ad_settings->setPeriodLength($settings['PeriodLength']);
            $this->conn->persist($ad_settings);
            $this->conn->flush();
        }

        return $ad_settings->getId();
    }

    private function handleHeaders($headers)
    {
        return array_flip($headers);
    }

    private function handleData($data, $headers, $settings_id)
    {
        foreach($data as $record)
        {
            $adStats = new AdStats;
            $adStats->setUrl($record[$headers['URLs']]);
            $adStats->setTags($record[$headers['Tags']]);
            $adStats->setDate(\DateTime::createFromFormat('Y-m-d', $record[$headers['DATE']]));
            $adStats->setEstimatedRevenue($record[$headers['Estimated revenue']]);
            $adStats->setAdImpressions($record[$headers['Ad impressions']]);
            $adStats->setAdEcpm($record[$headers['Ad eCPM']]);
            $adStats->setClicks($record[$headers['CLICKS']]);
            $adStats->setAdCtr($record[$headers['Ad CTR']]);
            $adStats->setAdSettingsId($settings_id);

            $this->conn->persist($adStats);
            $this->conn->flush();
        }
    }
}
?>