<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\LendingRequest;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;
use DataTables;

use App\Models\Constants;
use App\Models\Lending;
use App\Models\Movie;
use App\Models\Member;

class LendingsController extends Controller
{
    public function index()
    {
        return view('lendings.index', [
            'slug' => 'lendings',
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
        ->activeRent()
        ->searchByMovieTitle(request()->movie_title)
        ->searchByMemberName(request()->member_name);

        return DataTables::of($data)
            ->editColumn('movie_id', function ($data) {
                return $data->has('movie') && isset($data->movie->title) ? $data->movie->title : '-';
            })
            ->editColumn('member_id', function ($data) {
                return $data->has('member') && isset($data->member->name) ? $data->member->name : '-';
            })
            ->editColumn('lending_date', function ($data) {
                return !empty($data->lending_date) ? $data->lending_date->format('d-M-Y') : '-';
            })
            ->editColumn('due_date', function ($data) {
                return !empty($data->due_date) ? $data->due_date->format('d-M-Y') : '-';
            })
            ->editColumn('created_at', function ($data) {
                return !empty($data->created_at) ? $data->created_at->diffForHumans() : '-';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        try {
            $movies = Movie::select(['id', 'title'])->isAvailable()->get();
            $members = Member::select(['id', 'name'])->isActive()->get();

            return view('lendings.partials.create', [
                'movies' => $movies,
                'members' => $members,
            ]);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }

    public function store(LendingRequest $request)
    {
        try {
            DB::beginTransaction();

            $requests = $request->only('member_id', 'due_date');
            $requests['due_date'] = Carbon::createFromFormat('d-m-Y',  $requests['due_date'])->format('Y-m-d');
            $requests['lending_date'] = today()->format('Y-m-d');

            if (is_array($request->movies)) {
                foreach ($request->movies as $movie_id) {
                    Lending::create($requests + [
                        'movie_id' => $movie_id,
                    ]);
                }

                $movieTable = (new Movie())->getTable();
                DB::table($movieTable)->whereIn('id', $request->movies)->update([
                    'is_rented' => true,
                ]);
            }

            DB::commit();

            return json_response('success', trans('general.message.create-success'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_exception($e);
        }
    }

}
