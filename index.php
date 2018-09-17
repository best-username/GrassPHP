<?php

interface BaseM {
    public function info();
    public function getPrice($discount=0);
}

class Size {
    public $width = 40;
    public $height = 40;
    public function Size() {
        return ($this->height) * ($this->width);
    }
}

class Base extends Size implements BaseM {
    public $title;
    protected $price;

    public function getPrice($discount=0) {
        if($discount <= 1 && $discount > 0)
            return $this->price * $discount;
        else
            return $this->price;  
    }
    public function setPrice($data) {
        return $this->price = $data;
    } 
    
    public function info(){
        $params = (get_object_vars($this));
        if(count($params)) {
            echo '<table style="width: 100%">';
            foreach ($params as $key => $value) {
            if($value!='')
            echo '<tr><th>' . $key . '</th><th>' . $value . '</th></tr>';
        } 
        echo '</table>';
        }
               
    }
    
}

class Postcard extends Base {
    public $country;
    public $series;
}

class PostStamp extends Postcard {
    public $denomination;
}

class Calendar extends Base {
    public $year;
    public $type;
}

class Poster extends Base {
    public $type;
    public $series;
    
    public function customize() {
       echo 'Fuction of cutomize was called!' . PHP_EOL;
    }
}
class Book extends Base {
    public $author = 'Steven King';
    public $pages = 10;
    public $publisher = 'Ivan Petrov';
    public $year = 2018;
    public $hardcover = true;
    public $genres = ['Science', 'Classic'];
    
    public function reserve() {
        echo 'Function reserve was called';
    }
     public function getGenres() {
         foreach ($this->genres as $key => $value) {
             echo "$key => $value" . PHP_EOL;
         }
    }
}



class EBook extends Base {
    public $author = 'Steven King';
    public $pages = 20;
    public $publisher = 'someone';
    public $year = 2018;
    public $fileSize = '10MB';
    public function preview() {
        echo "Function preview was called";
    }
}

class Magazine extends Base {
    private $subscriptionPrice = 100;
    public $number = 10;
    public $numsPerYear = 24;
    public function getSubscriptionPrice($discount = 0) {
        if($this->subscriptionPrice == 0){
            if($discount == 0) return $this->getPrice() * $this->numsPerYear;
            else return $this->getPrice($discount) * $this->numsPerYear;
        }
        else return $this->subscriptionPrice;
    }
}

class EMagazine extends Magazine {
    public function preview() {
        echo 'Function preview was called';
    }
}

class Newspaper extends Magazine {
    public $isColor = true;
}