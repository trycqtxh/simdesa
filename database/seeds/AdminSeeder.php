<?php

use Illuminate\Database\Seeder;
use App\Entities\AparatDesa;
use App\Role;
use App\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $aparat = [
            'nip' => '10112671',
            'admin' => 1,
            'password' => '123456'
        ];
        $user = AparatDesa::firstOrCreate($aparat);

        $admin = [
            'name' => 'admin',
            'display_name' => 'User Administrator',
            'description'  => 'User is allowed to manage and edit other users'
        ];
        $role = Role::firstOrCreate($admin);
        $user->attachRole($role);

        $izin = ['name'=>'select-akses-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_akses', 'description'=>'master'];
        $permission = Permission::firstOrCreate($izin);
        $role->attachPermission($permission);
        $izin = ['name'=>'add-akses-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_akses', 'description'=>'master'];
        $permission = Permission::firstOrCreate($izin);
        $role->attachPermission($permission);
        $izin = ['name'=>'edit-akses-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_akses', 'description'=>'master'];
        $permission = Permission::firstOrCreate($izin);
        $role->attachPermission($permission);
        $izin = ['name'=>'remove-akses-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_akses', 'description'=>'master'];
        $permission = Permission::firstOrCreate($izin);
        $role->attachPermission($permission);
        $izin = ['name'=>'edit-profil-desa', 'tampilan'=> 'Ubah','display_name'=>'master_profil', 'description'=>'master'];
        $permission = Permission::firstOrCreate($izin);
        $role->attachPermission($permission);
        $izin = ['name'=>'select-profil-desa', 'tampilan'=> 'Lihat','display_name'=>'master_profil', 'description'=>'master'];
        $permission = Permission::firstOrCreate($izin);
        $role->attachPermission($permission);


    }
}
