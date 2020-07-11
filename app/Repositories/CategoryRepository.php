<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;
use Exception;
use DB;

class CategoryRepository  implements RepositoryInterface
{  

    public $model;

    public function __construct(Model $model)
    {
         $this->model = $model;
    }

    /* ------------------------------ List Function ----------------------------- */

    public function getAll()
    {
        try{
            $data = $this->model->get();
            return $data;
        }  
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }


    /* ----------------------------- Create Function ---------------------------- */

    public function create(Request $request)
    {    
        try{ 
            DB::beginTransaction();
            $data = $this->model->create($request->all());
            DB::commit();
            return $data;
          
        }
        catch(Exception $e)
        {     DB::rollback();
              return $e->getMessage();
        }

    }


    /* ----------------------------- Update Function ---------------------------- */

    public function update(Request $request,$id)
    {

    }


    /* ------------------------------ Show Function ----------------------------- */

    public function show($id)
    {

    }

    
    /* ----------------------------- Delete Function ---------------------------- */

    public function delete($id)
    {

    }

   
    /* ----------------------------- Get Model Name ----------------------------- */

    public function getModel()
    {

    }
}