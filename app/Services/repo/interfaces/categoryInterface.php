<?php


namespace App\Services\repo\interfaces;


interface categoryInterface{



    public function store($name,$status,$rank,$description,$meta_description,$meta_title,$url,$meta_logo,$parent_id);
    public function update($category,$name,$status,$rank,$description,$meta_description,$meta_title,$url,$meta_logo);


    public function getallcategory();

    public function deletecategory($category);

}