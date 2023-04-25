<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Credential\BulkDestroyCredential;
use App\Http\Requests\Admin\Credential\DestroyCredential;
use App\Http\Requests\Admin\Credential\IndexCredential;
use App\Http\Requests\Admin\Credential\StoreCredential;
use App\Http\Requests\Admin\Credential\UpdateCredential;
use App\Models\Credential;
use App\Models\State;
use App\Models\Category;
use App\Models\Service;
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

class CredentialsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCredential $request
     * @return array|Factory|View
     */
    public function index(IndexCredential $request)
    {
        // Obtener el conteo total de registros de la tabla Credential
        $totalCredentials = Credential::count();

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Credential::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'descripcion', 'url', 'category_id', 'service_id'],

            // set columns to searchIn
            ['id', 'descripcion', 'url']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.credential.index', compact('data'));
        //return view('nuevo');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.credential.create');
        //$state = State::all();
        $category = Category::all();
        $service = Service::all();
        return view('admin.credential.create',compact('category','service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCredential $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCredential $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        //$sanitized ['state_id']=  $request->getStateId();
        $sanitized ['category_id']=  $request->getCategoryId();
        $sanitized ['service_id']=  $request->getServiceId();

        // Store the Credential
        $credential = Credential::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/credentials'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/credentials');
    }

    /**
     * Display the specified resource.
     *
     * @param Credential $credential
     * @throws AuthorizationException
     * @return void
     */
    public function show(Credential $credential)
    {
        $this->authorize('admin.credential.show', $credential);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Credential $credential
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Credential $credential)
    {
        $this->authorize('admin.credential.edit', $credential);

        $category = Category::all();
        $service = Service::all();

        return view('admin.credential.edit', [
            'credential' => $credential,
            'category'=>$category,
            'service'=>$service,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCredential $request
     * @param Credential $credential
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCredential $request, Credential $credential)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized ['category_id']=  $request->getCategoryId();
        $sanitized ['service_id']=  $request->getServiceId();


        // Update changed values Credential
        $credential->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/credentials'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/credentials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCredential $request
     * @param Credential $credential
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCredential $request, Credential $credential)
    {
        $credential->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect('admin/credentials');
    }
}
