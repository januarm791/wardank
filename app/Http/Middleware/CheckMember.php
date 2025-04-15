<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMember {
    public function handle(Request $request, Closure $next): Response {
        if (!auth()->check() || !auth()->user()->is_member) {
            return redirect()->route('membership.register')->with('error', 'Anda harus menjadi member terlebih dahulu.');
        }
        return $next($request);
    }
}
