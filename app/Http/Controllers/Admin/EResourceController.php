<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\EResource;
use Illuminate\Http\Request;
class EResourceController extends Controller {
    public function index() {
        $resources = EResource::with('uploader')->latest()->paginate(10);
        return view('admin.eresources.index', compact('resources'));
    }
    public function create() {
        return view('admin.eresources.create');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:file,link',
            'file_path' => 'nullable|file|max:10240',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        $data = $request->only('title','type','url','description');
        $data['uploaded_by'] = auth()->id();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('eresources','public');
        }
        EResource::create($data);
        return redirect()->route('admin.eresources.index')->with('success','E-Resource berhasil ditambahkan.');
    }
    public function edit(EResource $eresource) {
        return view('admin.eresources.edit', compact('eresource'));
    }
    public function update(Request $request, EResource $eresource) {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:file,link',
            'file_path' => 'nullable|file|max:10240',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        $data = $request->only('title','type','url','description');
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('eresources','public');
        }
        $eresource->update($data);
        return redirect()->route('admin.eresources.index')->with('success','E-Resource berhasil diperbarui.');
    }
    public function destroy(EResource $eresource) {
        $eresource->delete();
        return redirect()->route('admin.eresources.index')->with('success','E-Resource berhasil dihapus.');
    }
}
