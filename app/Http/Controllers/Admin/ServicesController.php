<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\BulkDestroyService;
use App\Http\Requests\Admin\Service\DestroyService;
use App\Http\Requests\Admin\Service\IndexService;
use App\Http\Requests\Admin\Service\StoreService;
use App\Http\Requests\Admin\Service\UpdateService;
use App\Models\Service;
use App\Models\State;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexService $request
     * @return array|Factory|View
     */
    public function index(IndexService $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Service::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'descripcion', 'state_id'],

            // set columns to searchIn
            ['id', 'descripcion']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.service.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.service.create');
        $state = state::all();

        return view('admin.service.create',compact('state'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreService $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreService $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['service_id']=  $request->getServiceId();
        $sanitized ['state_id']=  $request->getStateId();

        // Store the Service
        $service = Service::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/services'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @throws AuthorizationException
     * @return void
     */
    public function show(Service $service)
    {
        $this->authorize('admin.service.show', $service);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Service $service)
    {
        $this->authorize('admin.service.edit', $service);
        $state = State::all();


        return view('admin.service.edit', [
            'service' => $service,
            'state'=>$state,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateService $request
     * @param Service $service
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateService $request, Service $service)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Service
        $service->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/services'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyService $request
     * @param Service $service
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyService $request, Service $service)
    {
        $service->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyService $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyService $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Service::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
