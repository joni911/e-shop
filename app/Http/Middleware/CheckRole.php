<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware pemisah hak akses berdasarkan kolom `users.hak_akses`.
 *
 * Pemakaian:
 *   ->middleware('role:admin')            # hanya admin
 *   ->middleware('role:user,peserta')     # user hasil register / peserta
 *
 * Catatan: nilai 'user' (default saat registrasi publik) diperlakukan
 * setara dengan 'peserta' agar satu aturan berlaku untuk keduanya.
 */
class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $normalize = fn (string $r) => ($r === 'user') ? 'peserta' : $r;
        $userRole  = $normalize($user->hak_akses);
        $allowed   = array_map($normalize, $roles);

        if (! in_array($userRole, $allowed, true)) {
            abort(403);
        }

        return $next($request);
    }
}
