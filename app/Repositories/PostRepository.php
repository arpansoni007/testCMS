<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;
use Exception;
use DB;

class PostRepository  implements RepositoryInterface
{  
  
    public $model;
    public const pageSize = 10;
    public function __construct(Model $model)
    {
         $this->model = $model;
    }

    /* ------------------------------ List Function ----------------------------- */

    public function getAll()
    {
        try{
            $data = $this->model->with('category')->paginate(\Config::get('default.perPage'));
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

            $image = $request->hasFile('photo') ? $request->photo->store('public') : null;
            $request->merge(['image' => $image]);
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
        try{ 
           
            $image = $request->hasFile('photo') ? $request->photo->store('public') : null;
            if($image != null)
            {
                $this->model->deleteImage();
                $request->merge(['image' => $image]);
            }

           
            $data = $this->model->where('id',$id)->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'content'=>$request->content,
                'image'=>$request->image,
                'published_at'=>$request->published_at,
                'category_id'=>$request->category_id
                ]);
            
            
            return $data;
          
        }
        catch(Exception $e)
        {  
              return $e->getMessage();
        }
    }


    /* ------------------------------ Show Function ----------------------------- */

    public function show($id)
    {
        try{ 
            $data = $this->model->with('category')->find($id);
            return $data;
          
        }
        catch(Exception $e)
        {     
              return $e->getMessage();
        }
    }

    
    /* ----------------------------- Delete Function ---------------------------- */

    public function delete($id)
    {   

        try{ 
            DB::beginTransaction();
            $data = $this->model->find($id);
            $data->delete();
            DB::commit();
            return $data;
          
        }
        catch(Exception $e)
        {     
            DB::rollback();
            return $e->getMessage();
        }

    }

   
    /* ----------------------------- Get Model Name ----------------------------- */

    public function getModel()
    {
         return $this->model;
    }
    
}