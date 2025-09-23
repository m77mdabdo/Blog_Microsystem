<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepositoryInterface\EditorRepositoryInterface;

class EditorController extends Controller
{
    protected $editorRepository;

    public function __construct(EditorRepositoryInterface $editorRepository)
    {
        $this->editorRepository = $editorRepository;
    }

    public function index()
    {
        $editors = $this->editorRepository->all();
        return view('editor.index', compact('editors'));
    }

    public function create()
    {
        return view('editor.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $this->editorRepository->create($data);

        return redirect()->route('editors.index')->with('success', 'Editor created successfully.');
    }

    public function edit($id)
    {
        $editor = $this->editorRepository->find($id);
        return view('editor.edit', compact('editor'));
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

        $this->editorRepository->update($id, $data);

        return redirect()->route('editors.index')->with('success', 'Editor updated successfully.');
    }

    public function destroy($id)
    {
        $this->editorRepository->delete($id);
        return redirect()->route('editors.index')->with('success', 'Editor deleted successfully.');
    }
}
