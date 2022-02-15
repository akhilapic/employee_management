<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table="users";
    protected $fillable =[
        'name', 'employee_id', 'full_name', 'username', 'email', 'agency', 'valid_upto', 'authorized_by', 'blood_group', 'status', 'Level', 'doj', 'date_of_training', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at', 'role', 'image', 'emergency_contact_no', 'gender', 'dob', 'work_station', 'upload_doc', 'address', 'login_check', 'email_verified', 'approved', 'reason', 'fcm_token'];
}
