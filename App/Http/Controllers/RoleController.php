<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\RoleRepository;
use App\Enums\UserPermissionsEnum;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{

    private $roleRepository;

    public function __construct()
    {
        $this->roleRepository = app(RoleRepository::class);
    }

    public function index()
    {
        $roles= $this->roleRepository->getAll();

        return view('roles.index',compact("roles"));
    }

    public function create()
    {
        $permissions = UserPermissionsEnum::getKeys();
        return view('roles.create',compact("permissions"));
    }

    public function edit($id)
    {
        $role = $this->roleRepository->find($id);
        if ($role!=null)
        {
            $permissions = UserPermissionsEnum::getKeys();
            return view('roles.edit',compact("permissions","role"));
        }
        else
        {
            return redirect()->route('role_index')->withErrors("Role with id ". $id ." not found");
        }
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
                $permissions[] = $permission;
            }
        }
        $role->setPermissionsToCreate($permissions);

        $role = $this->roleRepository->create($role);

        return redirect()->route('role_index');
    }

    public function update(Request $request,$id)
    {
          $this->validate($request, [
              'name' => 'required|unique:roles,name,'.$id,
          ]);

          $role = $this->roleRepository->find($id);

          if ($role!=null)
          {
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
                     $permissionsToCreate[] = $permission;
                 }
              }

              if (count($permissions)>0)
              {
                  foreach ($permissions as $permission)
                  {
                    if ($request->get($permission->type) === null)
                    {
                        $permissionsToRemove[] =$permission;
                    }
                  }
              }

              $role->setPermissionsToCreate($permissionsToCreate);
              $role->setPermissionsToRemove($permissionsToRemove);

              $this->roleRepository->update($role);

              return redirect()->route('role_index');
          }
          else
          {
              return redirect()->route('role_index')->withErrors("Role with id ". $id ." not found");
          }

    }

    public function delete($id)
    {
        $this->roleRepository->delete($id);

        return redirect()->route('role_index');
    }
}
