<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;
use DataTables;

use App\Models\Constants;
use App\Models\Member;

class MembersController extends Controller
{
    public function index()
    {
        return view('members.index', [
            'slug' => 'members',
        ]);
    }

    public function datatable()
    {
        $data = Member::select([
            'id',
            'name',
            'age',
            'address',
            'telephone',
            'identity_number',
            'date_of_joined',
            'is_active',
            'created_at',
        ]);

        return DataTables::of($data)
            ->editColumn('telephone', function ($data) {
                return isset($data->telephone) ? '+'.$data->telephone  : '-';
            })
            ->editColumn('created_at', function ($data) {
                return !empty($data->created_at) ? $data->created_at->diffForHumans() : '-';
            })
            ->editColumn('is_active', function ($data) {
                return $data->is_active === 1 ? trans('general.label.active') : trans('general.label.non_active');
            })
            ->addColumn('action', function ($data, $action = null) {
                $action .= '<div class="d-flex">';
                if (auth()->user()->can('members_edit')) {
                    $action .= '<button class="btn-action btn-modal-edit btn btn-primary-custom btn-sm"'
                    . ' data-type="edit"'
                    . ' data-href="'.route('members.edit', encrypt($data->id)).'"'
                    . ' >'
                    . ' <img class="small-icon" src="'. asset('images/write.svg') .'" />'
                    . ' </button>';
                }
                if (auth()->user()->can('members_delete')) {
                    $action .= '<button class="btn-action btn-modal-delete btn btn-danger-custom ml-2 btn-sm"'
                    . ' data-type="delete"'
                    . ' data-href="'.route('members.show-delete', encrypt($data->id)).'"'
                    . ' >'
                    . ' <img class="small-icon" src="'. asset('images/delete.svg') .'" />'
                    . ' </button>';
                }
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        return view('members.partials.create');
    }

    public function store(MemberRequest $request)
    {
        try {
            DB::beginTransaction();

            $requests = $request->all();
            $requests['date_of_joined'] = now()->format('Y-m-d');
            $requests['is_active'] = $requests['is_active'][0];

            $data = Member::create($requests);

            DB::commit();

            return json_response('success', trans('general.message.create-success'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_exception($e);
        }
    }

    public function edit($id)
    {
        try {
            $id = decrypt($id);
            $data = Member::findOrFail($id);

            return view('members.partials.edit', [
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }

    public function update(string $id, MemberRequest $request)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $requests = $request->all();
            $requests['is_active'] = $requests['is_active'][0];

            $data = Member::findOrFail($id);
            $data->update($requests);

            DB::commit();

            return json_response('success', trans('general.message.update-success'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_exception($e);
        }
    }

    public function showDelete(string $id)
    {
        try {
            $id = decrypt($id);
            $data = Member::findOrFail($id);

            return view('members.partials.delete', [
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }

    public function delete(string $id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $data = Member::select('id')->findOrFail($id);
            $data->delete();

            DB::commit();

            return json_response('success', trans('general.message.delete-success'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_exception($e);
        }
    }

    public function getMembers(Request $request)
    {
        try {
            return Member::select(['id', 'name'])
                ->where('name', 'LIKE', '%'.$request->term.'%')
                ->paginate($request->per_page);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }
}
