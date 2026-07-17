<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preorder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PreorderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $statusCounts = Preorder::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');
        $preorders = Preorder::query()
            ->when(array_key_exists($status, Preorder::STATUSES), fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.preorders.index', compact('preorders', 'status', 'statusCounts'));
    }

    public function update(Request $request, Preorder $preorder): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Preorder::STATUSES))],
        ]);
        $preorder->update($data);

        return back()->with('success', "Status preorder #{$preorder->id} berhasil diperbarui.");
    }
}
