<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Assist;
use App\Models\Parameter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    protected $student;
    /* protected $totalClasses; */
    protected $attendedClasses;
    protected $condition;
    protected $percentage;

    public function __construct($student, /* $totalClasses, */ $attendedClasses, $condition, $percentage)
    {
        $this->student = $student;
        /* $this->totalClasses = $totalClasses; */
        $this->attendedClasses = $attendedClasses;
        $this->condition = $condition;
        $this->percentage = $percentage;
    }

    public function view(): View
    {
        return view('student.excel', [
            'student' => $this->student,
            /* 'totalClasses' => $this->totalClasses, */
            'attendedClasses' => $this->attendedClasses,
            'condition' => $this->condition,
            'percentage' => $this->percentage,
        ]);
    }
}
