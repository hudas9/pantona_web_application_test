<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function datatable(Request $request)
    {
        $sortableColumns = [
            0 => 'email',
            1 => 'nama',
        ];

        $query = User::query();

        $search = trim($request->input('search.value', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('nama',  'like', "%{$search}%");
            });
        }

        $recordsTotal    = User::count();
        $recordsFiltered = $query->count();

        $orderColumnIndex = (int) $request->input('order.0.column', 0);
        $orderDir         = $request->input('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $orderColumn      = $sortableColumns[$orderColumnIndex] ?? 'email';
        $query->orderBy($orderColumn, $orderDir);

        $start  = max(0, (int) $request->input('start', 0));
        $length = max(1, (int) $request->input('length', 10));
        $users  = $query->skip($start)->take($length)->get();

        $data = $users->map(function (User $user) {
            $imageUrl = $user->image_profile
                ? asset('storage/' . $user->image_profile)
                : 'https://placehold.co/200x200';

            $imageHtml = sprintf(
                '<img src="%s" alt="%s" class="rounded object-cover" style="width: 200px; height: 200px;">',
                e($imageUrl),
                e($user->nama)
            );

            $actionHtml = sprintf(
                '<div class="d-flex gap-2 justify-content-center">
                    <button class="btn-edit btn btn-md btn-warning"
                        data-id="%d"
                        data-email="%s"
                        data-name="%s"
                        data-image="%s">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn-delete btn btn-md btn-danger"
                        data-id="%d">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>',
                $user->id,
                e($user->email),
                e($user->nama),
                e($imageUrl),
                $user->id
            );

            return [
                'email'  => e($user->email),
                'nama'   => e($user->nama),
                'image'  => $imageHtml,
                'action' => $actionHtml,
            ];
        });

        return response()->json([
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email',
            'nama'     => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'image_profile'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image_profile')) {
            $validated['image_profile'] = $request->file('image_profile')->store('users', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return response()->json([
            'message' => 'User berhasil ditambahkan!',
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image_profile')) {
            if ($user->image_profile) {
                Storage::disk('public')->delete($user->image_profile);
            }
            $validated['image_profile'] = $request->file('image_profile')->store('users', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User berhasil diubah!',
        ]);
    }
}
