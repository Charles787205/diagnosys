<?php
require_once 'Services.php';
require_once 'Patient.php';
class Appointment
{
    public Int $id, $patient_id;
    public Patient $patient;
    public String $status;
    public String $appointment_date;
    public $services;
    public ?Float $total;
    public ?int $user_id;
    const APPROVED = 'Approved';
    const REJECT = 'Reject';
    const PAID = 'Paid';
    const PENDING = 'Pending';
    public $comment;

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
}
