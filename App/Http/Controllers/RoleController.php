<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\RoleRepository;
use App\Enums\UserPermissionsEnum;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roleRepository = new RoleRepository();
        $roles= $roleRepository->getAll();

        return view('roles.index',compact("roles"));
    }

    public function create()
    {
        $permissions = UserPermissionsEnum::getKeys();
        return view('roles.create',compact("permissions"));
    }

    public function edit($id)
    {
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($id);
        $permissions = UserPermissionsEnum::getKeys();
        return view('roles.edit',compact("permissions","role"));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required','unique:roles']
        ]);
        $role = new Role($request->all());

        $permissions =[];
        $permissionTypes = UserPermissionsEnum::getKeys();
        foreach($request->all() as $permissionType => $value)
        {
            if(in_array($permissionType, $permissionTypes))
            {
                $permission = new Permission();
                $permission->type = $permissionType;
                $permissions[count($permissions)] = $permission;
            }
        }
        $role->setPermissionsToCreate($permissions);

        $roleRepository = new RoleRepository();
        $role = $roleRepository->create($role);

        return redirect('/roles/index');
    }

    public function update(Request $request,$id)
    {
          $this->validate($request, [
              'name' => 'required|unique:roles,name,'.$id,
          ]);

          $roleRepository = new RoleRepository();
          $role = $roleRepository->find($id);

          $role->name=$request->get('name');

          $permissions= $role->permissions;

          $permissionsToRemove=[];
          $permissionsToCreate=[];

          $permissionTypes = UserPermissionsEnum::getKeys();
          foreach($request->all() as $permissionType => $value)
          {
             if(in_array($permissionType, $permissionTypes) && ! $role->isPermissionEnable($permissionType) )
             {
                 $permission = new Permission();
                 $permission->type = $permissionType;
                 $permissionsToCreate[count($permissionsToCreate)] = $permission;
             }
          }

          if (count($permissions)>0)
          {
              foreach ($permissions as $permission)
              {
                if ($request->get($permission->type) === null)
                {
                    $permissionsToRemove[count($permissionsToRemove)] =$permission;
                }
              }
          }

          $role->setPermissionsToCreate($permissionsToCreate);
          $role->setPermissionsToRemove($permissionsToRemove);

          $roleRepository = new RoleRepository();
          $roleRepository->update($role);

          return redirect('/roles/index');

    }

    public function delete($id)
    {
        $roleRepository = new RoleRepository();
        $roleRepository->delete($id);

        return redirect('/roles/index');
    }
}
