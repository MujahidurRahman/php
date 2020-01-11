<?php
//use datatable;
include "datatable.php";
$dataSet = [
    [
        "title"=> "JavaScript",
        "author"=> " qqq",
        "phone"=> "12345"
    ],
    [
        "title"=> "c++",
        "author"=> " www",
        "phone"=> " 45841"
    ],
    [
        "title"=> "Java",
        "author"=> " eee",
        "phone"=> " 875585"
    ]
];

//$data = json_decode($json);
//echo datatable::of($data);
//$tableData = new datatable($dataSet);

$formattedData = new datatable($dataSet);
echo $formattedData
            ->addColumn('action',function($customData){
                return '<a href="/edit/' . $customData['phone'] . '">Edit</a>';
            })
            ->editColumn('title',function($customData){
               return 'Language: '.$customData['title'];
            })
            ->make();
            //->convertToJson();
            //->toXML();


?>