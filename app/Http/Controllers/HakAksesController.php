<?php

namespace App\Http\Controllers;

use App\Entities\AparatDesa;
use App\Permission;
use App\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


class HakAksesController extends Controller
{
    public function index()
    {
        return view('content.hak-akses');
    }

    public function users()
    {
        if(request()->wantsJson()){
            $table = [];
            if(Auth()->user()->admin)
                $aparat = AparatDesa::has('role_users')->get();
            else
                $aparat = AparatDesa::has('role_users')->where('admin', '=', 0)->get();
            $i=1;
            foreach($aparat as $a){
                $row['nomor'] = $i++;
                $row['nip'] = ($a->nip) ? $a->nip : $a->niap;
                $row['nama'] = ($a->induk) ? $a->induk->penduduk->nama: $a->nip;
                $row['jabatan'] = ($a->jabatan) ? $a->jabatan->nama: 'admin';
                $row['roles'] = $a->roles->first()['name'];
                if(!$a->admin)
                $row['act'] = '
                <button class="btn btn-default btn-xs" onclick="return edit_users(\''.$a->id.'\', \''.(($a->induk) ? $a->induk->penduduk->nama: $a->nip).'\')"><i class="fa fa-edit"></i> </button>
                <button class="btn btn-default btn-xs" onclick="return hapus_users(\''.$a->id.'\', \''.(($a->induk) ? $a->induk->penduduk->nama: $a->nip).'\')"><i class="fa fa-trash"></i> </button>
                ';
                else
                    $row['act'] = '';
                    $table[] = $row;
            }
            return response()->json(['table'=>$table], 200);
        }
    }

    public function roles()
    {
        if(request()->wantsJson()){
            $table = [];
            $role = Role::all();
            foreach($role as $r){
                $row['id'] = $r->id;
                $row['name'] = $r->name;
                $row['display_name'] = $r->display_name;
                $row['desc'] = $r->descriotion;
                $row['action'] = '
                <a class="btn btn-xs btn-default" onclick="return edit_permission(\''.$r->id.'\')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-xs btn-default" onclick="return hapus_permission(\''.$r->id.'\', \''.$r->name.'\')"><i class="fa fa-trash"></i></a>
                ';
                $table[] = $row;
            }

            return response()->json(['table'=>$table], 200);
        }
    }

    public function permision()
    {
        if(request()->wantsJson()){
            $table = [];
            $permision = Permission::all();
            foreach($permision as $p){
                $row['id']           = $p->id;
                $row['name']         = $p->name;
                $row['display_name'] = $p->tampilan.' - '.$p->display_name;
                $row['desc']         = $p->descriotion;
                $row['action']       = '';
                $table[] = $row;
            }

            return response()->json(['table'=>$table], 200);
        }
    }

    public function store(Request $request, Role $role, Permission $permission)
    {
        if($request->wantsJson()){
            $this->validate($request, [
                'name' => 'required'
            ]);
            try{
                $r = [
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'description' => $request->description,
                ];
                DB::transaction(function() use($role, $r, $request){
                    $id_role =$role->firstOrCreate($r);
                    $j=0;
                    for($i=1; $i<= count($request->permission); $i++){
                        DB::table('permission_role')->insert([
                            'role_id'       => $id_role['id'],
                            'permission_id' => $request->permission[$j],
                        ]);
                        $j++;
                    }
                });

                return response()->json(['message'=>'Data Berhasil Ditambahkan'], 201);
            }catch (ValidationException $e){
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }

    public function update($id, Request $request, Role $role, Permission $permission)
    {
        if($request->wantsJson()){
            $this->validate($request, [
                'name' => 'required'
            ]);
            try{
                try{
                    $r = [
                        'name' => $request->name,
                        'display_name' => $request->display_name,
                        'description' => $request->description,
                    ];
                    DB::transaction(function() use($id, $role, $r, $request){
                        $role->find($id)->update($r);
                        DB::table('permission_role')->where('role_id', $id)->delete();
                        $j=0;
                        for($i=1; $i<= count($request->permission); $i++){
                            DB::table('permission_role')->insert([
                                'role_id'       => $id,
                                'permission_id' => $request->permission[$j],
                            ]);
                            $j++;
                        }
                    });
                    return response()->json(['message'=>'Data Berhasil Diubah'], 201);
                }catch (QueryException $e){
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessage()
                    ], 500);
                }
            }catch (ValidationException $e){
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }

    public function destroy($id)
    {
        if(request()->wantsJson()){
            try {

                $role = Role::find($id);
                DB::transaction(function()use($id, $role){
                    DB::table('permission_role')->where('role_id', $id)->delete();
                    DB::table('roles')->where('id', $id)->delete();
                });

                return response()->json(['message'=>'Data Berhasil Dihapus', 'data'=>$role], 201);

            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }

    public function storeUsers(Request $request){
        if($request->wantsJson()){
            $this->validate($request, [
                'user' => 'required',
                'role' => 'required'
            ]);
            try{
                $users = [
                    'user_id' => $request->user,
                    'role_id'    => $request->role
                ];

                DB::table('role_user')->insert($users);

                return response()->json(['message'=>'Data Berhasil Ditambahkan'], 201);
            }catch (ValidationException $e){
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }
    public function updateUsers($id, Request $request){
        if($request->wantsJson()){
            $this->validate($request, [
                'id' => 'required',
                'role' => 'required'
            ]);
            try{
                $users = [
                    'role_id'    => $request->role
                ];

                DB::table('role_user')->where('user_id', $request->id)->update($users);

                return response()->json(['message'=>'Data Berhasil DiUbah'], 201);
            }catch (ValidationException $e){
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }
    public function destroyUsers($id){
        if(request()->wantsJson()){
            try {

                DB::table('role_user')->where('user_id', $id)->delete();

                return response()->json(['message'=>'Data Berhasil Dihapus'], 201);

            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
