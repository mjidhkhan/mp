<?php
require_once dirname(__DIR__) . "/config/config.php";

if(Session::get('status')< 9){
    $details = array('path' => IMAGES,
    'fullname' => Session::get('fullname'),
    'image'=>Session::get('user-image')
    );


    $stock = new Stock();
    $outof_stock = $stock->checkOutOfStock();
    $low_stock = $stock->checkLowStock();

    $orders = new Orders();
    $todays_orders = $orders->orderForToday();
    $sevendays_orders = $orders->orderForSevenDays();
    $pending_orders = $orders->pendingOrderForToday();
    $completed_orders = $orders->completedOrdersForToday();

    $stock_data = array(
        'outofstock' => sizeof($outof_stock),
        'lowstock' => sizeof($low_stock)
    );
    // Customer Order Data 
    $order_data =array(
        'today' => sizeof($todays_orders),
        'nextweek' => sizeof($sevendays_orders),
        'pending' => sizeof($pending_orders),
        'completed' => sizeof($completed_orders)
    );

    
}


$id = explode('=', $_SERVER['REQUEST_URI']);
if (array_key_exists('1', $id)) {
    if ($id[1] != '') {
        define('ID', $id[1]); 
       // require_once('client-function.php'); 

        response(ID);
    }
} else {
    define('ID', '');
}
$type = explode('/', $id[0]);
if (sizeof($type)>=4){
    if ($type[3] == 'v' || $type[3] == 'nv') {
        define('TYPE', $type[3]);
    }else{
        define('TYPE', $type[3]);
    }
}else{
    define('TYPE', 'N');
}



function response($id){
    echo $id;
    echo $twig->render('mp-admin/update-item.twig', array('stock' => 'Stock', 
        'page' => 'Update Item',
        'stock'=>$data, 
        'admin_data' =>$details,
        'stock_data'=>$stock_data,
        'order_data'=>$order_data
        ));

}