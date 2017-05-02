<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\book;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class BooksController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //if($this->attemptLogin($request)){
            return book::simplePaginate(20);
        /*}else{
            return ['errors' => 'Please Login!',
                    'user' => Auth::user(),
                    'request' => $request
                    ];
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isbn' => 'string|unique:books',
            'title' => 'string',
            'author' => 'string',
            'press' => 'string',
            'location' => 'string',
            'owner' => 'integer'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }
        return book::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //if(Auth::guest()){
            return ['Info' => book::findOrFail($id), 
                    'Owner' => book::findOrFail($id)->Owner()->get()];
        //}else{
        //    return ['errors' => 'Please Login!'];
        //}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function search(Request $request)
    {
        $isbn = $request->isbn;
        $result = book::where('isbn', '=', $isbn)->get();

        if($result == "[]"){
            return 'null';
        }else{
            return redirect()->route('book-single', 
                    ['id' => $result[0]->id]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
