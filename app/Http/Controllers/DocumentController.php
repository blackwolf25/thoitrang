<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Document;
use App\CategoryDocument;

class DocumentController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_document(){
        $this->AuthLogin();
    	$all_category_document = DB::table('tbl_category_document')->orderBy('category_id','DESC')->paginate();
    	$all_document = DB::table('tbl_document')->join('tbl_category_document','tbl_category_document.category_id','=','tbl_document.document_cate')->orderBy('document_id','DESC')->paginate();
    	return view('admin.manage_document')->with(compact('all_category_document'))->with(compact('all_document'));

    }
    public function save_category_document(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_document_name;
        $data['category_desc'] = $request->category_document_desc;
        $data['category_status'] = $request->category_document_status;
        $data['category_slug'] = to_slug($request->category_document_name);

        $get_image = $request->file('category_document_image');
       
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/document',$new_image);
            $data['category_image'] = $new_image;
            DB::table('tbl_category_document')->insert($data);
            Session::put('message','Thêm tài liệu thành công.');
            return Redirect::to('manage-document');
        } else{
        $data['category_image'] = 'logo.png';
        DB::table('tbl_category_document')->insert($data);
        Session::put('message','Thêm danh mục bài biết thành công.');
        return Redirect::to('manage-document');
    }
}
    public function unactive_category_document($category_document_id){
        $this->AuthLogin();
        DB::table('tbl_category_document')->where('category_id',$category_document_id)->update(['category_status'=>0]);
        Session::put('message','Tắt kích hoạt danh mục bài biết thành công.');
        return Redirect::to('manage-document');

    }
    public function active_category_document($category_document_id){
        $this->AuthLogin();
        DB::table('tbl_category_document')->where('category_id',$category_document_id)->update(['category_status'=>1]);
        Session::put('message','Bật kích hoạt danh mục bài biết thành công.');
        return Redirect::to('manage-document');

    }
    
    public function update_category_document(Request $request,$category_document_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_document_name;
        $data['category_desc'] = $request->category_document_desc;
        $data['category_status'] = $request->category_document_status;
        $data['category_slug'] = to_slug($request->category_document_name);
        $get_image = $request->file('category_document_image');
       
        if($get_image){
            $category_document = CategoryDocument::find($category_document_id);
            unlink('public/uploads/images/document/'.$category_document->category_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/document',$new_image);
            $data['category_image'] = $new_image;
            DB::table('tbl_category_document')->where('category_id',$category_document_id)->update($data);
            Session::put('message','Cập nhật danh mục tài liệu thành công.');
            return Redirect::to('manage-document');
        } else{
        $data['category_image'] = 'logo.png';
        DB::table('tbl_category_document')->where('category_id',$category_document_id)->update($data);
        Session::put('message','Cập nhật danh mục bài biết thành công.');
        return Redirect::to('manage-document');
    }
}
    public function delete_category_document($category_document_id){
        $this->AuthLogin();
        $category_document = CategoryDocument::find($category_document_id);
        unlink('public/uploads/images/document/'.$category_document->category_image);

        DB::table('tbl_category_document')->where('category_id',$category_document_id)->delete();
        Session::put('message','Xóa danh mục bài biết thành công.');
        return Redirect::to('manage-document');
    }

    public function save_document(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['document_name'] = $request->document_name;
    	$data['document_desc'] = $request->document_desc;
        $data['document_cate'] = $request->document_cate;
        $data['document_status'] = $request->document_status;

        $data['document_date'] = date('y-m-d',strtotime($request->document_date));

        $data['document_slug'] = to_slug($request->document_name);
        $get_image = $request->file('document_image');
      	$get_file = $request->file('document_file');
            $get_name_file = $get_file->getClientOriginalName();
            $name_file = current(explode('.',$get_name_file));
            $new_file =  $name_file.time().'.'.$get_file->getClientOriginalExtension();
            $get_file->move('public/uploads/files/',$new_file);
            $data['document_file'] = $new_file;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/document',$new_image);
            $data['document_image'] = $new_image;
            DB::table('tbl_document')->insert($data);
            Session::put('message','Thêm tài liệu thành công.');
            return Redirect::to('manage-document');
        } else{
        $data['document_image'] = 'logo.png';
    	DB::table('tbl_document')->insert($data);
    	Session::put('message','Thêm tài liệu thành công');
    	return Redirect::to('manage-document');
    }
    	
        

}

    public function unactive_document($document_id){
        $this->AuthLogin();
        DB::table('tbl_document')->where('document_id',$document_id)->update(['document_status'=>0]);
        Session::put('message','Tắt kích hoạt tài liệu thành công.');
        return Redirect::to('manage-document');

    }

    public function active_document($document_id){
        $this->AuthLogin();
        DB::table('tbl_document')->where('document_id',$document_id)->update(['document_status'=>1]);
        Session::put('message','Bật kích hoạt tài liệu thành công.');
        return Redirect::to('manage-document');
    }

    public function update_document(Request $request,$document_id){
         $this->AuthLogin();
        $data = array();
       	$data['document_name'] = $request->document_name;
    	$data['document_desc'] = $request->document_desc;
        $data['document_cate'] = $request->document_cate;

        $data['document_date'] = date('y-m-d',strtotime($request->document_date));
        
        $data['document_status'] = $request->document_status;
        $data['document_slug'] = to_slug($request->document_name);
       
        
        $get_file = $request->file('document_file');
        if($get_file){
            $document = Document::find($document_id);
            unlink('public/uploads/files/'.$document->document_file);

            $get_name_file = $get_file->getClientOriginalName();
            $name_file = current(explode('.',$get_name_file));
            $new_file =  $name_file.time().'.'.$get_file->getClientOriginalExtension();
            $get_file->move('public/uploads/files/',$new_file);
            $data['document_file'] = $new_file;
        }

        $get_image = $request->file('document_image');
        if($get_image){
                    $document = Document::find($document_id);
                    unlink('public/uploads/images/document/'.$document->document_image);

                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/document',$new_image);
                    $data['document_image'] = $new_image;
                    DB::table('tbl_document')->where('document_id',$document_id)->update($data);
                    Session::put('message','Cập nhật tài liệu thành công.');
                    return Redirect::to('manage-document');
        }
            
        DB::table('tbl_document')->where('document_id',$document_id)->update($data);
        Session::put('message','Cập nhật tài liệu thành công.');
        return Redirect::to('manage-document');
    }
    
    public function delete_document($document_id){
        $this->AuthLogin();
        $document = Document::find($document_id);
        unlink('public/uploads/files/'.$document->document_file);
        unlink('public/uploads/image/document/'.$document->document_image);

        DB::table('tbl_document')->where('document_id',$document_id)->delete();
        Session::put('message','Xóa tài liệu thành công.');
        return Redirect::to('manage-document');
    }
}
