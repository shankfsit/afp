<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Readfile extends REST_Controller {
    
    public function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}
 
 
// Set path to CSV file
$csvFile = 'Stumak.csv';
 
$csv = readCSV($csvFile);


/*echo '<pre>';
print_r($csv);
echo '</pre>';*/
// exit;

$max_iterations = count($csv);
$items = array();
for ($i=1;$i <=$max_iterations;$i++)
{
    if ($i <= count($csv ))
      { 

        


    $title=$csv[$i][0];
   $quantity=$csv[$i][1];
   $price=$csv[$i][2];


array_push($items, array(
           "title"=> $title,
        "price"=> $price,
        "quantity"=> $quantity,
            "taxable" => false,
            "tax_exempt" => false,
            "taxes_included" => false,
            "tax_lines"  => false,
));

   

   }


    else
        break;      
}

echo "<pre>";
// print_r($items);
echo "</pre>";

   $data = array("draft_order" => array(

"line_items" => $items,
),
"customer" =>array(
//"id" => 616685502563
 // "id" => 935647477859    
  "id" => 1770247848013
),
"note_attributes" => array(array(
"name" => "Invoice Due Date",
"value" => "2019-05-01"
)),
"use_customer_default_address"=>true);
 /*echo "<pre>";
print_r($data);
echo "</pre>";*/
$data_string = json_encode($data);
$ch = curl_init('https://e3d5dbb3946465ae26dc116fc9546e90:b792b6c8c8eaa3dc3924e7cacd889e79@fisssion-bottle-club.myshopify.com/admin/draft_orders.json'); 

 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                         
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
     'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)));                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);

 print_r($result);
 curl_close($ch);
    	
}