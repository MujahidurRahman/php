<?php

class datatable{

    public static $formattedData = [];
    public function __construct($dataSet)
    {
        self::$formattedData = $dataSet;
    }

    public function addColumn($column, $func)
    {
       // var_dump($columnValue);exit();
        $addColumnData = self::$formattedData;
        foreach ($addColumnData as $key => $value){
            $addColumnData[$key][$column] = is_callable($func) ? call_user_func($func,$value) : $func;
        }
        self::$formattedData = $addColumnData;
        return $this;
    }

    public function editColumn($column,$func)
    {
        $editColumnData = self::$formattedData;
        foreach ($editColumnData as $key => $value){
            $editColumnData[$key][$column] = is_callable($func) ? call_user_func($func, $value) : $func;
        }
        self::$formattedData = $editColumnData;

        return $this;
    }

    public static function make(){
        $head = '<tr style="background: cornflowerblue">';
        foreach (self::$formattedData as $key=>$value){
            foreach ($value as $val=>$data) {
                $head .= '<th>' . $val . '</th>';
            }
            break;
        }
        $head .= '</tr>';

        $body = '';
        foreach (self::$formattedData as $key=>$value){
            $body .= '<tr>';
            foreach ($value as $val=>$data){
                $body .= '<td>'. $data .'</td>';
            }
            $body .= '</tr>';
        }

        $fullTable = '<table border="1" style="background: lightgray;">'.$head.$body.'</table>';

        return $fullTable;

    }

    public function convertToJson(){
        return json_encode(self::$formattedData);
    }

    public function toXML(){
       return  self::convertToXML(self::$formattedData, $rootElement = null, $xml = null);
    }

    public function convertToXML($array= null, $rootElement = null, $xml = null){
        // Reference : https://www.geeksforgeeks.org/

        $_xml = $xml;

            // If there is no Root Element then insert root
            if ($_xml === null) {
                $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
            }

            // Visit all key value pair
            foreach ($array as $k => $v) {

                // If there is nested array then
                if (is_array($v)) {

                    // Call function for nested array
                    self::convertToXML($v, $k, $_xml->addChild($k));
                }

                    else {

                        // Simply add child element.
                        $_xml->addChild($k, $v);
                    }
                }

                return $_xml->asXML();


    }

//    public static function of($source)
//    {
//        return self::make($source);
//    }



}



?>