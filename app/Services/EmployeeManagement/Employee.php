<?php

namespace App\Services\EmployeeManagement;

interface Employee
{
    public function applyJob($user,$jobVacancy);

    public function salary($month);
}
