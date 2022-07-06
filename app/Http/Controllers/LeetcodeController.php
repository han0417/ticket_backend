<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeetcodeController extends Controller
{
    /**
     * get todo list
     * @param int limit 顯示筆數限制
     * @param int page  頁數
     *
     * @return json
     */
    public function returnIntArray(Request $request)
    {
        $inputData = $request->all();

        $answer = [];
        $tempArr = [];
        //原始陣列
        $originArray = $inputData['params'];
        //用於排序的陣列
        $sortArray = $inputData['params'];
        sort($sortArray);

        //掃一次，建立array mapping
        $counter = 0;
        foreach ($sortArray as $index => $val) {
            //排在第一個肯定沒有比其他人大
            if ($index === 0) {
                $tempArr[$val] = 0;
            } else {
                $counter++;
                //如果跟前面的元素不一樣大，建立新元素到暫時陣列當中
                if ($val !== $sortArray[$index-1]){
                    $tempArr[$val] = $counter;
                }
            };
        }

        //掃一次，透過key去轉換正確的順序
        foreach ($originArray as $val){
            $answer[] = $tempArr[$val];
        }
        return $answer;
    }
}
