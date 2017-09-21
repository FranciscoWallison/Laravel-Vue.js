<?php

namespace SisFin\Http\Controllers\Api;

use Carbon\Carbon;

trait BillControllerTrait
{
    public function findToPayToToday(){
        $dateStart = new Carbon();
        $dateEnd = $dateStart->copy();
        return $this->repository->getTotalFromPeriod($dateStart, $dateEnd);
    }

    public function findToPayRestOfMonth(){
        $dateStart = (new Carbon())->addDays(1);//31/3 ~ 1/04
        if($dateStart->month != (new Carbon())->month){
            $dateStart->subDays(1);
        }
        $dateEnd = $dateStart->copy()->day($dateStart->daysInMonth);//ultimo dia no mês 
        return $this->repository->getTotalFromPeriod($dateStart, $dateEnd);
    }
}