<?php

namespace App\Models\System;

use App\Models\Services\Applicant;
use Illuminate\Database\Eloquent\Model;

class Paginator
{

    public static function process($model, $request, $query, $parameters = [])
    {

        if(!is_string($model)) {
            $query = $model::accessFilter($query , $request);
            $table = app($model)->getTable();
        }else{
            $table = $model;
        }

        //Parameters
        //===========================================
        $transformRecord = array_get($parameters, 'transform_record');
        $order = array_get($parameters, 'order');
        $defaultOrderBy = array_get($parameters, 'default_order_by', 'id');
        $defaultOrderDirection = array_get($parameters, 'default_order_direction', 'DESC');
        $transformResult = array_get($parameters, 'transform_result');
        $textSearch = array_get($parameters, 'text_search');
        $ignoreRemoved = array_get($parameters, 'ignore_removed', false);
        $ignoreTextSearch = array_get($parameters, 'ignore_text_search', false);
        $ignoreTransformDataList = array_get($parameters, 'ignore_transform_data_list', false);
        $complexQueryCount = array_get($parameters, 'complex_query_count', false);
        $lookup = array_get($parameters, 'lookup');
        $details = array_get($parameters, 'details' , null);

        if (strpos($defaultOrderBy, ".") === false) $defaultOrderBy = "$table.$defaultOrderBy";

        //Search Text
        //===========================================
        if (!$ignoreTextSearch) {
            if ($request->has('keywords')) {

                $keywords = mb_ereg_replace(" ", "%", getFTS($request->keywords));

                if ($textSearch) {
                    $textSearch($query, $keywords);
                } else {
                    $query->whereRaw("COALESCE($table.search_text,'') like '%$keywords%'");

                }
            }
        }

        //Removed
        //===========================================
        if (!$ignoreRemoved) {

            if ($request->removed !== null) {

                $query->where("$table.removed", $request->removed);
            } else {

                $query->where("$table.removed", 0);
            }
        }

        //Order
        //===========================================
        $orderBy = ($request->order_by) ? $request->order_by : $defaultOrderBy;
        $orderDirection = ($request->order_direction) ? $request->order_direction : $defaultOrderDirection;

        if ($order) {
            $order($query, $orderBy, $orderDirection);
        } else $query->orderBy($orderBy, $orderDirection);
        
        //Offset / Limit
        //===========================================
        $offset = ($request->offset) ? $request->offset : 0;
        $limit = ($request->limit) ? $request->limit : 10;

        $cloneQuery = clone $query;
        $count = $complexQueryCount?$cloneQuery->get()->count():$cloneQuery->count();

        if ($limit > 0) {

            $query->offset($offset);
            $query->limit($limit + 1);
        }

        $records = $query->get();
        $more = ($limit > 0 && count($records) > $limit);

        //Transform Records
        //===========================================
        $list = [];
        if (!$ignoreTransformDataList){
            foreach ($records as $record) {
                $list[] = ($transformRecord) ? $transformRecord($record) : $record->data(System::DATA_LIST);
            }
        }else{
            $list=is_array($records)?$records:$records->toArray();
        }

        if ($more) array_pop($list);

        //Transform Result
        //===========================================
        $meta = (object)[];
        $meta->more = $more;
        $meta->count = $count;
        $meta->lookup = $lookup;
        if ($details){
            $meta->details = $details;
        }

        $result = (object)[];
        $result->data = $list;
        $result->meta = $meta;
        if ($transformResult) $result = $transformResult($result, $query);

        return response()->json($result);
    }

    //to handle simple processing paginator with only search text
    public static function simpleProcess($table, $request, $query, $parameters = [])
    {
        //Parameters
        $defaultOrderBy = array_get($parameters, 'default_order_by', 'id');
        $defaultOrderDirection = array_get($parameters, 'default_order_direction', 'DESC');
        $querySearch = array_get($parameters, 'querySearch', false);
        $processResults = array_get($parameters, 'processResults', false);

        //for searching
        if ($request->has('keywords')) {
            $keywords = mb_ereg_replace(" ", "%", getFTS($request->keywords));
            if ($querySearch) {
                $querySearch($query, $keywords);
            } else {
                $query->whereRaw("COALESCE($table.search_text,'') like '%$keywords%'");
            }
        }

        //Order
        if (strpos($defaultOrderBy, ".") === false) $defaultOrderBy = "$table.$defaultOrderBy";
        $orderBy = ($request->order_by) ?: $defaultOrderBy;
        $orderDirection = ($request->order_direction) ?: $defaultOrderDirection;
        $query->orderBy($orderBy, $orderDirection);

        //Offset / Limit
        $offset = ($request->offset) ?: 0;
        $limit = ($request->limit) ?: 10;

        $cloneQuery = clone $query;
        $count = $cloneQuery->count();

        if ($limit > 0) {
            $query->offset($offset);
            $query->limit($limit + 1);
        }

        $list = $query->get();
        if($processResults){
            $list=$processResults($list);
        }
        $more = ($limit > 0 && count($list) > $limit);


        if ($more) array_pop($list);

        //Result
        $meta = (object)[];
        $meta->more = $more;
        $meta->count = $count;

        $result = (object)[];
        $result->data = $list;
        $result->meta = $meta;

        return response()->json($result);
    }
}
