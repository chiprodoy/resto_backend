<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public $title;

    public $description;

    public String $keyword;

    public $meta;

    public $metaImage;


    public $keywords=[];

    public function __construct()
    {
        $this->keyword = env('KEYWORDS');
        $this->keywords = explode(',',env('KEYWORDS'));
        if(method_exists($this,'setOpenGraphMeta')) $this->setOpenGraphMeta();


    }
}

trait useOpenGraphMeta{

    public function setOpenGraphMeta(){
        $this->title;
    }
}


