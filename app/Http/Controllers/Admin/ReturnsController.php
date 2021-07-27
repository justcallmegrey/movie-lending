<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;
use DataTables;

use App\Models\Constants;
use App\Models\Lending;

class ReturnsController extends Controller
{
    public function index()
    {
        return view('returns.index', [
            'slug' => 'returns',
        ]);
    }

    public function datatable()
    {
        $data = Lending::select([
            'id',
            'movie_id',
            'member_id',
            'lending_date',
            'due_date',
            'returned_date',
            'lateness_charge',
            'created_at',
        ])
        ->with(['member', 'movie'])
        ->searchByMovieTitle(request()->movie_title)
        ->searchByMemberName(request()->member_name);

        return DataTables::of($data)
            ->editColumn('movie_id', function ($data) {
                return $data->has('movie') && isset($data->movie->title) ? $data->movie->title : '-';
            })
            ->editColumn('member_id', function ($data) {
                return isset($data->member_id) ? $data->member->name  : '-';
            })
            ->editColumn('lending_date', function ($data) {
                return !empty($data->lending_date) ? $data->lending_date->format('d-M-Y') : '-';
            })
            ->editColumn('due_date', function ($data) {
                return !empty($data->due_date) ? $data->due_date->format('d-M-Y') : '-';
            })
            ->editColumn('returned_date', function ($data) {
                return !empty($data->returned_date) ? $data->returned_date->format('d-M-Y') : '-';
            })
            ->editColumn('lateness_charge', function ($data) {
                return !empty($data->lateness_charge) ? currency($data->lateness_charge, true, 2) : '-';
            })
            ->editColumn('created_at', function ($data) {
                return !empty($data->created_at) ? $data->created_at->diffForHumans() : '-';
            })
            ->addColumn('action', function ($data, $action = null) {
                $action .= '<div class="d-flex">';
                if (auth()->user()->can('returns_return') && !$data->returned_date) {
                    $action .= '<button class="btn-action btn-modal-return btn btn-primary-custom btn-sm"'
                    . ' data-type="return"'
                    . ' data-href="'.route('returns.show-return', encrypt($data->id)).'"'
                    . ' >'
                    . trans('general.label.return')
                    . ' </button>';
                }
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function calculateLatenessCharge($due_date)
    {
        # lets say lateness charge is 0,25 BND / day
        $charge = 0;
        $endOfToday = now()->setTime(24, 0, 0);
        $difference = $endOfToday->diff($due_date)->days;

        if ((today() > $due_date) && $difference > 0) {
            $charge = 0.25 * $difference;
        }
        return $charge;
    }

    public function showReturn($id)
    {
        try {
            $id = decrypt($id);
            $data = Lending::findOrFail($id);
            $lateness_charge = $this->calculateLatenessCharge($data->due_date);

            return view('returns.partials.return', [
                'data' => $data,
                'lateness_charge' => $lateness_charge,
            ]);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }

    public function return(string $id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $data = Lending::findOrFail($id);
            $lateness_charge = $this->calculateLatenessCharge($data->due_date);

            $data->update([
                'returned_date' => today(),
                'lateness_charge' => $lateness_charge,
            ]);

            DB::commit();

            return json_response('success', trans('general.message.update-success'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_exception($e);
        }
    }
}
