<?php


function shamsiToMiladi($date)
{
    if($date == null)
    {
        return null;
    }

    $pattern = "/[\s\/]/";
    $shamsiDateArray = preg_split($pattern, $date);
    $miladiDateArrayWithOutSeconds = verta()->getGregorian($shamsiDateArray[2],$shamsiDateArray[3],$shamsiDateArray[4]);
    return implode('-', $miladiDateArrayWithOutSeconds)." ".$shamsiDateArray[0];

}