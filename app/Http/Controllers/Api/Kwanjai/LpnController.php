<?php

namespace App\Http\Controllers\Api\Kwanjai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kwanjai\EmployeeModel;

class LpnController extends Controller
{
    private $emp_model;

    public function __construct()
    {
        $this->auth_username = 'lpn-kwanjai@2020';
        $this->auth_password = 'lpn@2020-kwanjai-cnt';
        $this->auth_key = 'Basic ' . base64_encode($this->auth_username . ':' . $this->auth_password);

        $this->emp_model = new EmployeeModel();
    }

    //ค้นหาพนักงาน
    protected function find_lpnEmployees(Request $request)
    {

        // ตรวจสอบ authen
        $auth_header = $request->header('authorization');
        if ($auth_header != $this->auth_key) {
            return  response()->json(
                array(
                    'status'   => 'error',
                    'message' => "Unauthorized"
                ),
                401
            );
        }


        //รับค่า input
        $input = $request->input();
        //กำหนดค่าให้กับตัวแปร จาก input em_code
        $emp_code =  isset($input['em_code']) ? $input['em_code'] : '';

        //กำหนด response message
        $responseBody = array(
            'status'   => 'error',
            'message' => "ค้นหาข้อมูลพนักงานด้วย รหัส EM_CODE = {$emp_code}"
        );

        //ตรวจสอบข้อมูล input
        if ($emp_code != '') {

            //เรียก คิวรี เพื่อค้นหาข้อมูล
            $find_result = $this->emp_model->getLpnEmployees($emp_code);
            $responseBody['message'] = "ค้นหาข้อมูลพนักงานด้วย รหัส EM_CODE = {$emp_code} สำเร็จ";

            //ตรวจสอบผลลัพธ์
            if (sizeof($find_result)) {
                $responseBody['status'] = "success";
                $responseBody['result'] = $find_result;     //ใส่ค่าผลลัพธ์ ลงใน response
            } else {
                $responseBody['status'] = "warning";
                $responseBody['message'] = "ไม่พบข้อมูลพนักงาน";
            }
        } else {
            $responseBody['message'] =  "รหัสพนักงาน (em_code) ไม่สามารถเป็นค่าว่างได้";
        }

        // ส่งผลลัพธ์ทั้งหมดกลับไปในรูปแบบ json
        return  response()->json($responseBody, 200);
    }



    protected function getEmployeeResign(Request $request)
    {

        // ตรวจสอบ authen
        $auth_header = $request->header('authorization');
        if ($auth_header != $this->auth_key) {
            return  response()->json(
                array(
                    'status'   => 'error',
                    'message' => "Unauthorized"
                ),
                401
            );
        }

        //กำหนด response message
        $responseBody = array(
            'status'   => 'error',
            'message' => "ค้นหาข้อมูลพนักงานลาออก"
        );

        //เรียก คิวรี เพื่อค้นหาข้อมูล
        $find_result = $this->emp_model->employeesResignList();

        //ตรวจสอบผลลัพธ์
        if (sizeof($find_result)) {
            $responseBody['status'] = "success";
            $responseBody['message'] = "ค้นหาข้อมูลพนักงานลาออก สำเร็จ!!";

            $responseBody['result'] = $find_result;     //ใส่ค่าผลลัพธ์ ลงใน response
        } else {
            $responseBody['status'] = "warning";
            $responseBody['message'] = "ไม่พบข้อมูลพนักงานลาออก";
        }

        // ส่งผลลัพธ์ทั้งหมดกลับไปในรูปแบบ json
        return  response()->json($responseBody, 200);
    }



    protected function getEmployeeResign_byDate(Request $request)
    {

        // ตรวจสอบ authen
        $auth_header = $request->header('authorization');
        if ($auth_header != $this->auth_key) {
            return  response()->json(
                array(
                    'status'   => 'error',
                    'message' => "Unauthorized"
                ),
                401
            );
        }


        //รับค่า input
        $input = $request->input();
        //กำหนดค่าให้กับตัวแปร จาก input em_code
        $date =  isset($input['date']) ? $input['date'] : '';

        //กำหนด response message
        $responseBody = array(
            'status'   => 'error',
            'message' => "ค้นหาข้อมูลพนักงานด้วยวันที่ = {$date}"
        );

        //ตรวจสอบข้อมูล input
        if ($date != '') {

            //เรียก คิวรี เพื่อค้นหาข้อมูล
            $find_result = $this->emp_model->employeesResignParams($date);
            $responseBody['message'] = "ค้นหาข้อมูลพนักงานด้วยวันที่ = {$date} สำเร็จ";

            //ตรวจสอบผลลัพธ์
            if (sizeof($find_result)) {
                $responseBody['status'] = "success";
                $responseBody['result'] = $find_result;     //ใส่ค่าผลลัพธ์ ลงใน response
            } else {
                $responseBody['status'] = "warning";
                $responseBody['message'] = "ไม่พบข้อมูลพนักงานลาออก";
            }
        } else {
            $responseBody['message'] =  "วันที่ไม่สามารถเป็นค่าว่างได้ เเละต้องอยู่ในรูปแบบ YYYYMMDD เท่านั้น";
        }

        // ส่งผลลัพธ์ทั้งหมดกลับไปในรูปแบบ json
        return  response()->json($responseBody, 200);
    }
}
