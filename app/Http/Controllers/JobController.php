<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Applicant;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $applicant;

    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    public function apply(Request $request, Applicant $applyService)
{
    $validatedData = $request->validate([
        'user_id' => 'required',
        'job_id' => 'required',
    ]);

    return $applyService->applyJob($validatedData['user_id'], $validatedData['job_id']);

}
}
