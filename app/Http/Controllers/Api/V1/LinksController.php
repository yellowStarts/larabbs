<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index(Link $link)
    {
        $links = $link->getAllCached();

        LinkResource::wrap('data');
        return LinkResource::collection($links);
    }
}
