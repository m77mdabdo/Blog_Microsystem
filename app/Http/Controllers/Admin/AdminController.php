<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $this->adminRepository->create($data);

        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $admin = $this->adminRepository->find($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

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

