<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Editor\StoreEditorRequest;
use App\Http\Requests\Editor\UpdateEditorRequest;
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
        return view('admin.editor.index', compact('editors'));
    }
    public function show($id)
    {
        $editor = $this->editorRepository->find($id);
        return view('admin.editor.show', compact('editor'));
    }


    public function create()
    {
        return view('admin.editor.create');
    }

    public function store(StoreEditorRequest $request)
{
    $data = $request->validated();
    $data['password'] = bcrypt($data['password']);
    $this->editorRepository->create($data);
    return redirect()->route('editors.index')->with('success', 'Editor created successfully.');
}

    public function edit($id)
    {
        $editor = $this->editorRepository->find($id);
        return view('admin.editor.edit', compact('editor'));
    }

   public function update(UpdateEditorRequest $request, $id)
{
    $data = $request->validated();
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
