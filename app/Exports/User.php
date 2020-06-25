<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class User implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $users;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function  __construct($users='')
    {
        if($users) {
            $this->users = $users;
        }

    }

    public function headings(): array
    {
        return [
            'id',
            'Fornavn',
            'Etternavn',
            'Brukernavn',
            'Mobilnr',
            'E-post',
            'konto status',
            'Rolle'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->users) {
            $users = $this->users;

        } else {
            // custom query to find users
        }
        $users = $users->map(function ($user)  {
            return [
                'id'                    => $user->id,
                'first_name'            => $user->first_name ? $user->first_name : 'NH-Bruker',
                'last_name'             => $user->last_name ? $user->last_name : 'NH-Bruker',
                'username'              => $user->username ? $user->username : 'NH-Bruker',
                'mobile_number'         => $user->mobile_number ? $user->mobile_number : 'N/A',
                'email'                 => $user->email,
                'account_status'        => ($user->account_status == 1) ? 'Aktiv':'Deaktivert',
                'role'                  =>  isset($user->roles[0]) ? ucfirst($user->roles[0]->name) : 'N/A',
            ];
        });
        return $users;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
