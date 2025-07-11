<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadsController extends Controller
{
    public function create(Request $req){

        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'number' => 'nullable|string|max:20',
            'source' => 'nullable|string|max:255',
            'cname' => 'nullable|string|max:255',
            'status' => 'required|string|in:New,Open,Closed',
        ]);

        $data = new Lead();
        $data->name=$req->name;
        $data->email=$req->email;
        $data->number=$req->number;
        $data->source=$req->source;
        $data->company_name=$req->cname;
        $data->status=$req->status;
        $result=$data->save();

        if($req){
            return redirect('/lead');
        }
        else {
            return "done done";
        }
    }

    public function list()
{
    $result = Lead::all(); // or however you're getting the data
    return view('leads.leads', compact('result'));
}
    

    public function edit($id)
    {  
        $data=Lead::find($id);
        return view('leads.leads', compact('data'));
    }

     public function EditMember(Request $req,$id)
      {
          $data=Lead::find($id);
          $data->name=$req->name;
          $data->email=$req->email;
          $data->number=$req->number;
          $data->source=$req->source;
          $data->company_name=$req->cname;
          $data->status=$req->status;
          if($data->save()){
            return redirect('/lead');
          }
          else{
              echo "error";
          }
      }

      public function delete($id)
     {
        echo $isDeleted=Lead::destroy($id);

         if($isDeleted){
         return redirect('/lead');
         }  
     }
}
