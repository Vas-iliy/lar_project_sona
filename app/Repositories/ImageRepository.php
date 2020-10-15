<?php


namespace App\Repositories;

use App\Image;

class ImageRepository extends Repository
{
    public function __construct(Image $image)
    {
        $this->model = $image;
    }
}
