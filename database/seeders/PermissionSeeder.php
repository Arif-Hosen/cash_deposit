<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {

//        Permission
    Permission::create([
      'type' => 'Permission',
      'name' => 'Manage Permission'
    ]);
//      User
    Permission::create([
      'type' => 'User',
      'name' => 'List Of User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'Create User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'Manage User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'Delete User'
    ]);
    Permission::create([
      'type' => 'User',
      'name' => 'View User'
    ]);

//      Role
    Permission::create([
      'type' => 'Role',
      'name' => 'List Of Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'Create Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'Manage Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'Delete Role'
    ]);
    Permission::create([
      'type' => 'Role',
      'name' => 'View Role'
    ]);

    //      Event
    Permission::create([
      'type' => 'Event',
      'name' => 'List Of Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'Create Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'Manage Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'Delete Event'
    ]);
    Permission::create([
      'type' => 'Event',
      'name' => 'View Event'
    ]);

//      Division
    Permission::create([
      'type' => 'Division',
      'name' => 'List Of Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'Create Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'Manage Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'Delete Division'
    ]);
    Permission::create([
      'type' => 'Division',
      'name' => 'View Division'
    ]);


//      District
    Permission::create([
      'type' => 'District',
      'name' => 'List Of District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'Create District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'Manage District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'Delete District'
    ]);
    Permission::create([
      'type' => 'District',
      'name' => 'View District'
    ]);


//      Upazila
    Permission::create([
      'type' => 'Upazila',
      'name' => 'List Of Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'Create Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'Manage Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'Delete Upazila'
    ]);
    Permission::create([
      'type' => 'Upazila',
      'name' => 'View Upazila'
    ]);


//      Voucher Type
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'List Of Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'Create Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'Manage Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'Delete Voucher Type'
    ]);
    Permission::create([
      'type' => 'Voucher Type',
      'name' => 'View Voucher Type'
    ]);


    //      Voucher
    Permission::create([
      'type' => 'Voucher',
      'name' => 'List Of Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'Create Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'Manage Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'Delete Voucher'
    ]);
    Permission::create([
      'type' => 'Voucher',
      'name' => 'View Voucher'
    ]);
  }
}
