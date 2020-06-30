<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\Exportable;//Exportableトレイトを使う

class UsersExport implements FromCollection,WithHeadings
// class UsersExport implements FromCollection//Exportableトレイトを使う
{
    // use Exportable;//Exportableトレイトを使う


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id', 'name', 'email')->get();
        // return User::all();//Exportableトレイトを使う

    }

    public function title(): string{
        return 'test';
    }

    public function headings():array
    {
        return [
            '#',
            'name',
            'email',
        ];
    }
}
