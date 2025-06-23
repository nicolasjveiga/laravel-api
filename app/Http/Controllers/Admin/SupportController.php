<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use App\Http\Requests\StoreUpdateSupport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SupportService;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $supportService
    ) {}

    public function index(Request $request)
    {

        $supports = $this->servie->getAll($request->filter);

        return view('/admin/supports/index', compact('supports'));
    }

    public function show(Support $support, int $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('/admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('/admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support)
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    public function edit(int $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('/admin/supports/edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, int $id)
    {

        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request, $id)
        );

        if(!$support) {
            return back();
        }

        $support->update($request->validated());

        return redirect()->route('supports.index');
    }

    public function destroy(int $id)
    {

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
