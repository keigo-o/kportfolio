<?php

namespace App\Imports;

use App\DbModels\notebook\PublicHoliday;
use Maatwebsite\Excel\Concerns\ToModel;

class PublicHolidayImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PublicHoliday([
            'date'=>$row[0],
            'name'=>$row[1],
        ]);
    }
}
