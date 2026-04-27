<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{User, Member};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class MemberController extends Controller {
    public function index(Request $request) {
        $query = Member::with('user');
        if ($request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name','like',"%{$request->search}%")
                  ->orWhere('email','like',"%{$request->search}%");
            })->orWhere('nim_nidn','like',"%{$request->search}%");
        }
        $members = $query->latest()->paginate(10)->withQueryString();
        return view('admin.members.index', compact('members'));
    }
    public function create() {
        return view('admin.members.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'nim_nidn' => 'required|string|max:50',
            'prodi' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);
        Member::create([
            'user_id' => $user->id,
            'nim_nidn' => $request->nim_nidn,
            'prodi' => $request->prodi,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('admin.members.index')->with('success','Anggota berhasil ditambahkan.');
    }
    public function show(Member $member) {
        $member->load('user','loans.loanItems.book');
        return view('admin.members.show', compact('member'));
    }
    public function edit(Member $member) {
        $member->load('user');
        return view('admin.members.edit', compact('member'));
    }
    public function update(Request $request, Member $member) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$member->user_id,
            'nim_nidn' => 'required|string|max:50',
            'prodi' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);
        $member->user->update(['name' => $request->name, 'email' => $request->email]);
        $member->update($request->only('nim_nidn','prodi','no_hp','alamat'));
        return redirect()->route('admin.members.index')->with('success','Anggota berhasil diperbarui.');
    }
    public function destroy(Member $member) {
        $member->user->delete();
        return redirect()->route('admin.members.index')->with('success','Anggota berhasil dihapus.');
    }
}
