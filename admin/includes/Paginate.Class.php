<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/18/2020 AD
 * Time: 12:28 PM
 */
class Paginate
{
    public $current_page;
    public $item_per_page;
    public $item_total_count;

    public function __construct($page=1, $items_per_page=3, $item_total_count=0)
    {
        $this->current_page = (int)$page;
        $this->item_per_page = (int)$items_per_page;
        $this->item_total_count = (int)$item_total_count;
    }

    public function next(){
        return $this->current_page +1;
    }

    public function previous(){
        return $this->current_page -1;
    }

    public function page_total(){
        return ceil($this->item_total_count/$this->item_per_page);
    }

    public function has_previous(){
        return $this->previous() >= 1 ? true : false;
    }

    public function has_next(){
        return $this->next() <= $this->page_total() ? true : false;
    }

    public function offset(){
        return ($this->current_page -1)*$this->item_per_page;
    } //ตอนนี้ถ้าคลิกซื้อเครื่องดื่ม ถ้าก็ออเดอร์แล้วมันจะกลับไปหน้า cocktail เดิมที่ตั้งไว้ ต้องlink
}