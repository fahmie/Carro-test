<?php

namespace App\Services\EmployeeManagement;

use App\Models\JobVacancy;
use App\Models\User;

class Staff implements Employee
{

    protected $monthlySalary = 6000;

    public function applyJob($user,$jobVacancy)
    {
        $user = User::find($user);
        $job = JobVacancy::find($jobVacancy);
 
        $user->applyJob()->toggle($job->id);
 
        return response()->json([
            'status' => 200,
            'message' => 'Apply job successfully',
        ]);
    }

    public function salary($month)
    {
        return $month * $this->monthlySalary;
    }
 
}
