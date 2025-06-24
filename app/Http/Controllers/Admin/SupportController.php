<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use App\Http\Requests\StoreUpdateSupport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SupportService;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service
    ) {}

    public function index(Request $request)
    {

        $supports = $this->service->getAll($request->filter);
        return view('/admin/supports/index', compact('supports'));
    }

    public function show(int $id)
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

    public function store(StoreUpdateSupport $request)
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

    public function update(StoreUpdateSupport $request, int $id)
    {

        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if(!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    public function destroy(int $id)
    {

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
