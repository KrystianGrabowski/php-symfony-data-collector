<?php
namespace App\Service;

use App\Entity\AdStats;
use App\Entity\AdStatsSettings;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Exception;

class ResponseHandler
{
    public function handleSettings($settings) :AdStatsSettings
    {
        $ad_settings = new AdStatsSettings();
        $ad_settings->setCurrency($settings['currency']);
        $ad_settings->setPeriodLength($settings['PeriodLength']);
        $ad_settings->setGroupBy($settings['groupby']);

        return $ad_settings;
    }

    public function handleHeaders($headers)
    {
        return array_flip($headers);
    }

    public function handleData($data, $headers, $settings_id, $source)
    {
        $adStatsArray = [];
        foreach($data as $record)
        {
            $adStats = new AdStats;
            $adStats->setUrl($record[$headers['URLs']])
                    ->setTags($record[$headers['Tags']])
                    ->setDate(\DateTime::createFromFormat('Y-m-d', $record[$headers['DATE']]))
                    ->setEstimatedRevenue($record[$headers['Estimated revenue']])
                    ->setAdImpressions($record[$headers['Ad impressions']])
                    ->setAdEcpm($record[$headers['Ad eCPM']])
                    ->setClicks($record[$headers['CLICKS']])
                    ->setAdCtr($record[$headers['Ad CTR']])
                    ->setAdSettingsId($settings_id)
                    ->setSourceId($source->getId());

            $adStatsArray[] = $adStats;
        }
        return $adStatsArray;
    }
}
?>