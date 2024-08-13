<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends WebController
{
    public $blogs;

    public $relateProducts;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title='Blog Ucapan Bunga - Pesan Ucapan Papan bunga sekarang di ucapanbunga.com';
        $this->description = 'Berikan kesan yang tak terlupakan dengan ucapan papan bunga kami.
                                Pesan sekarang di UcapanBunga.com';

        $this->keywords = explode(',',$this->keyword);
        $this->metaImage = asset('images/product1.jpg');

        $this->blogs=Blog::all();
        return view('blog.index',get_object_vars($this));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $this->blogs = Blog::where('slug',$slug)->first();
        $this->title=$this->blogs->title;
        $this->description = strip_tags($this->blogs->content);

        $this->blogs->content = str_replace('UcapanBunga.com',"<a href='ucapanbunga.com'>UcapanBunga.com</a>",$this->blogs->content);

        $this->metaImage = asset('images/'.$this->blogs->image_cover);

        if(!empty($this->blogs->meta_title)){
            $this->title = $this->blogs->meta_title;
        }

        if(!empty($this->blogs->meta_keyword)){
            $this->keyword = $this->blogs->meta_keyword;
        }

        if(!empty($this->blogs->meta_description)){
            $this->description = $this->blogs->meta_description;
        }

        $keywords=str_replace(',','',$this->keyword);
        $keywords=explode(' ',$keywords);
        $sql=Product::query();

        foreach($keywords as $k => $v){
            $sql->orwhere('product_slug','like','%'.$v.'%');
        }

        $this->relateProducts=$sql->get();

        return view('blog.show',get_object_vars($this));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
