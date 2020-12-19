<?php
use Illuminate\Support\Facades\Session;
namespace App\Exports;
use App\Calendar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;
class VisitExports implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $visits=   \DB::table('projects')
            ->join('calendars' , 'calendars.project_id' , '=','projects.id')
            ->where('calendars.visit_status', 'Pending and On Window')
            ->orderBy('project_id')
            ->select(   'patient_id',
                        'projects.name',
                        'site_name',
                        'visit',
                        'visit_date',
                        'windows_start_date',
                        'windows_end_date',
                        'window_period',
                        'visit_status',
                        )
            ->get();
            return $visits;
    }
    
    public function headings(): array
    {
        return [        'patient_id',
                        'project_id',
                        'site_name',
                        'visit',
                        'visit_date',
                        'windows_start_date',
                        'windows_end_date',
                        'window_period',
                        'visit_status',
        ];
    }

}
