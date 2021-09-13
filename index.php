
<?php

session_start();


class Product{
    public $name;
    public $price;
    public $id;
    public function createProduct($name,$price,$id)
    {
        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
    }

}

$product = new Product();


for($i=1;$i<=10;$i++)
{
    $products[$i] =  new Product();
    $products[$i]->createProduct("Товар".$i, $i*11-4,$i);
}

$_POST = json_decode(file_get_contents('php://input'), true);


if(isset($_POST["data"]["type"]))
{
    echo json_encode($products,JSON_UNESCAPED_UNICODE);
}

if(isset($_POST["data"]["cart"]))
{
    foreach ($products as $item)
    {
        foreach ($_SESSION as $key=>$value)
        {
            if ("id:".$item->id == $key) {
                $arr[] = $item;
                $arr["count"] = $value;

                $arrRes[] = $arr;
                $arr = null;
            }
        }
    }
    echo json_encode($arrRes,JSON_UNESCAPED_UNICODE);
}


if(isset($_POST["data"]["id"]))
{
$id = $_POST["data"]["id"];
    if(isset($_SESSION["id:".$id] ))
        $_SESSION["id:".$id]++;
    else
        $_SESSION["id:".$id] = 1;

    echo json_encode($_SESSION,JSON_UNESCAPED_UNICODE);
}
