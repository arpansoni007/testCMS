<?php

namespace App\Repositories;
use Illuminate\Http\Request;

interface RepositoryInterface 
{  

    /* ------------------------------ List Function ----------------------------- */

    public function getAll();



    /* ----------------------------- Create Function ---------------------------- */

    public function create(Request $request);


    /* ----------------------------- Update Function ---------------------------- */

    public function update(Request $request,$id);


    /* ------------------------------ Show Function ----------------------------- */

    public function show($id);

    
    /* ----------------------------- Delete Function ---------------------------- */

    public function delete($id);

   
    /* ----------------------------- Get Model Name ----------------------------- */

    public function getModel();
}