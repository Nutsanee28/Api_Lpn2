<?php

namespace App\Models\Kwanjai;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    private $db;
    private $query_string;

    protected $connection = 'sqlsrv';
    protected $table = '';

    public function __construct()
    {
        $this->db = DB::connection('sqlsrv');
    }

    function getLpnEmployees($id = null)
    {
        $this->table = 'V_LPN_ACTIVEEMP_KWUNJAI';
        $employee = $this::select('*')->where('EM_CODE', $id)->get();
        return $employee;
    }

    function employeesResignList()
    {
        $this->table = 'V_EM_RESIGNATION_KWUNJAI';
        $employee_list = $this::select('*')->get();
        return $employee_list;
    }
    function employeesResignParams($date = null)
    {
        $this->table = 'V_EM_RESIGNATION_KWUNJAI_30DAY';
        $employee_params = $this::select('*')->where('RESIGN_DATE_YYYYMMDD', $date)->get();
        return $employee_params;
    }
}
