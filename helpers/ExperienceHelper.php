<?php

namespace app\modules\experience\helpers;

class ExperienceHelper
{

    /**
     * @param array $groupedCarTrials
     * @param int $carTrialId
     * @return int|string
     */
    public static function searchComponentByTrialId(array $groupedCarTrials, int $carTrialId)
    {
        foreach ($groupedCarTrials as $component => $trials) {
            if (array_key_exists($carTrialId, $trials)) {
                return $component;
            }
        }
        return 0;
    }
}
