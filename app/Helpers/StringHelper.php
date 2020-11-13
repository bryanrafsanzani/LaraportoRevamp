<?php
namespace App\Helpers;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class StringHelper
{

    public static function formatDate($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y/m/d'); //2020/06/04
    }

    public static function addDays($value)
    {
        return Carbon::now()->addDays($value);
    }

    public static function formatDateTimePicker($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d'); //2020-06-13
    }

    public static function formatMonthDate($value)
    {
        return \Carbon\Carbon::parse($value)->format('m-d'); //06-13
    }

    public static function formatYearDate($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y'); //2020
    }

    public static function formatTimestampsToClock($value)
    {
        return \Carbon\Carbon::parse($value)->format('g:i A'); //9:14 AM
    }

    public static function diffInDay($start, $end) //2020-06-30 - 2020-06-15 = 15
    {
        $date = \Carbon\Carbon::parse($start);
        $now = \Carbon\Carbon::parse($end);
        $diff = $date->diffInDays($now);
        return $diff;
    }

    public static function diffInYear($start, $end) //2019-06-30 - 2020-06-15 = 1
    {
        $date = \Carbon\Carbon::parse($start);
        $now = \Carbon\Carbon::parse($end);
        $diff = $date->diffInYears($now);
        return $diff;
    }

    public static function formatNumberPhoneRegion($value) //add +62
    {
        $region = substr($value, 0, 3);
        if($region === '+62'){
            return $value;
        }

        $region = substr($value, 0, 2);
        if($region === '08'){
            return '+62'.substr($value, 1);
        }

        $region = substr($value, 0, 1);
        if($region === '8'){
            return '+62'.$value;
        }

        return null;
    }

    public static function generateRandomInteger($length = 12) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomString($length = 12) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }


    public static function customePaginate($data, $paginate)
    {
        $article = collect($data);
        $total = $article->count();

        // set current page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // set limit
        $perPage = $paginate;

        // generate pagination
        $currentResults = $article->slice(($currentPage - 1) * $perPage, $perPage)->all();
        return $results = new LengthAwarePaginator($currentResults, $article->count(), $perPage);
    }
}