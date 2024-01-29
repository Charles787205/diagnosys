<?php
require_once 'Services.php';
require_once 'Patient.php';
class Request
{
    const APPROVED = 'Approved';
    const REJECT = 'Reject';
    const PAID = 'Paid';
    const PENDING = 'Pending';
    public ?Int $id, $patient_id;
    public ?Patient $patient;
    public String $status;
    public ?String $request_date, $result_date;
    public $services;
    public Float $total;
    public ?int $user_id;
    public $comment, $payment, $account_number, $insurance, $company, $date_paid;

    public function getTotal()
    {
        $total = 0;
        if (isset($services)) {
            foreach ($services as $service) {
                $total += $service->price();
            }
            return $total;
        } else {
            throw new Error('services not set');
        }
    }
    public function fill($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
    public function getResultDate()
    {
        return date("F d, Y", strtotime($this->result_date));
    }
    public function getResultTime()
    {
        return date("g:i A", strtotime($this->result_date));
    }
}
