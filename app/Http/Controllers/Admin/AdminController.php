<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\RepositoryInterface\AdminRepositoryInterface;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $admins = $this->adminRepository->all();
        return view('admin.admin.index', compact('admins'));
    }
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);
        return view('admin.admin.show', compact('admin'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(StoreAdminRequest $request)
{
    $data = $request->validated();
    $data['password'] = bcrypt($data['password']);
    $this->adminRepository->create($data);
    return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
}

    public function edit($id)
    {
        $admin = $this->adminRepository->find($id);
        return view('admin.admin.edit', compact('admin'));
    }

   public function update(UpdateAdminRequest $request, $id)
{
    $data = $request->validated();
    if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    } else {
        unset($data['password']);
    }
    $this->adminRepository->update($id, $data);
    return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
}

    public function destroy($id)
    {
        $this->adminRepository->delete($id);

        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }
}

