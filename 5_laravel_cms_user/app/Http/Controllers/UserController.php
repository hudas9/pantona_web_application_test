<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            1 => 'name',
        ];

        $query = User::query();

        $search = trim($request->input('search.value', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('name',  'like', "%{$search}%");
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
            $imageUrl = $user->image
                ? asset('storage/' . $user->image)
                : 'https://placehold.co/200x200';

            $imageHtml = sprintf(
                '<img src="%s" alt="%s" class="rounded w-200px h-200px object-cover">',
                e($imageUrl),
                e($user->name)
            );

            $actionHtml = sprintf(
                '<div class="d-flex gap-2 justify-content-center">
                    <button class="btn-edit btn btn-md btn-warning"
                        data-id="%d"
                        data-name="%s"
                        data-email="%s"
                        data-image="%s">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <button class="btn-delete btn btn-md btn-danger"
                        data-id="%d">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>',
                $user->id,
                e($user->name),
                e($user->email),
                e($imageUrl),
                $user->id
            );

            return [
                'email'  => e($user->email),
                'name'   => e($user->name),
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
}
