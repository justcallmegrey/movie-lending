<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DB;
use DataTables;

use App\Models\Constants;
use App\Models\Movie;

class MoviesController extends Controller
{
    public function index()
    {
        $genres = Constants::GENRES;

        return view('movies.index', [
            'slug' => 'movies',
            'genres' => $genres,
        ]);
    }

    public function datatable()
    {
        $genre = request()->has('genre') ? request('genre') : '';

        $data = Movie::select([
            'id',
            'title',
            'genre',
            'released_date',
            'created_at',
            'is_rented',
        ])
        ->filterByGenre($genre);

        return DataTables::of($data)
            ->editColumn('title', function ($data) {
                return isset($data->title) ? $data->title  : '-';
            })
            ->editColumn('released_date', function ($data) {
                return !empty($data->released_date) ? date('d-m-Y', strtotime($data->released_date)) : '-';
            })
            ->addColumn('is_available', function ($data) {
                return isset($data->is_rented) && $data->is_rented === 1
                    ? '<img class="small-icon" src="'.asset('images/cancel.svg').'" />'
                    : '<img class="small-icon" src="'.asset('images/checked-green.svg').'" />' ;
            })
            ->editColumn('created_at', function ($data) {
                return !empty($data->created_at) ? $data->created_at->diffForHumans() : '-';
            })
            ->addColumn('action', function ($data, $action = null) {
                $action .= '<div class="d-flex">';
                if (auth()->user()->can('movies_edit') && $data->is_rented == false) {
                    $action .= '<button class="btn-action btn-modal-edit btn btn-primary-custom btn-sm"'
                    . ' data-type="edit"'
                    . ' data-href="'.route('movies.edit', encrypt($data->id)).'"'
                    . ' >'
                    . ' <img class="small-icon" src="'. asset('images/write.svg') .'" />'
                    . ' </button>';
                }
                if (auth()->user()->can('movies_delete') && $data->is_rented == false) {
                    $action .= '<button class="btn-action btn-modal-delete btn btn-danger-custom ml-2 btn-sm"'
                    . ' data-type="delete"'
                    . ' data-href="'.route('movies.show-delete', encrypt($data->id)).'"'
                    . ' >'
                    . ' <img class="small-icon" src="'. asset('images/delete.svg') .'" />'
                    . ' </button>';
                }
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['is_available', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        $genres = Constants::GENRES;

        return view('movies.partials.create', [
            'genres' => $genres,
        ]);
    }

    public function store(MovieRequest $request)
    {
        try {
            DB::beginTransaction();

            $requests = $request->only('title', 'genre', 'released_date');
            $requests['is_rented'] = false;
            $requests['released_date'] = Carbon::createFromFormat('d-m-Y',  $requests['released_date'])->format('Y-m-d');

            Movie::create($requests);

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
            $genres = Constants::GENRES;
            $id = decrypt($id);

            $data = Movie::findOrFail($id);

            return view('movies.partials.edit', [
                'data' => $data,
                'genres' => $genres,
            ]);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }

    public function update(string $id, MovieRequest $request)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $requests = $request->only('title', 'genre', 'released_date');
            $requests['released_date'] = Carbon::createFromFormat('d-m-Y',  $requests['released_date'])->format('Y-m-d');

            $data = Movie::findOrFail($id);
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
            $data = Movie::findOrFail($id);

            return view('movies.partials.delete', [
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
            $data = Movie::select('id')->findOrFail($id);
            $data->delete();

            DB::commit();

            return json_response('success', trans('general.message.delete-success'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_exception($e);
        }
    }

    public function getMovies(Request $request)
    {
        try {
            return Movie::select(['id', 'title'])
                ->where('title', 'LIKE', '%'.$request->term.'%')
                ->paginate($request->per_page);
        } catch (\Exception $e) {
            return json_exception($e);
        }
    }
}
