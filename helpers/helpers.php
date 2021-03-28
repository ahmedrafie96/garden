<?php

use Illuminate\Support\Facades\Schema;

function resource_array($request, $resource)
{
    $excluded = $request->excluded ? $request->excluded : [];
    $attrs = Schema::getColumnListing($resource->getTable());
    $attrs = array_filter($attrs, function ($attr) use ($excluded) {
        return !in_array($attr, $excluded);
    });
    $item = $resource;
    $data = array_reduce(array_map(function ($attr) use ($item) {
        $relation = explode("_id", $attr);
        if (sizeof($relation) == 2 && $attr != null) {
            $function = $relation[0];
            $related = $item->$function;
            return [$relation[0] => $related, $attr => $item->$attr];
        }
        return [$attr => $item->$attr];
    }, $attrs), function ($c, $n) {
        return $c + $n;
    }, []);
    return $data;
}
