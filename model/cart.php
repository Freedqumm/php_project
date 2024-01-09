git <?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();

    }

    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );

        $query = $db->prepare("SELECT price FROM PRODUCTS WHERE id = $id");
        $query->execute();
        $price = $query->fetch(PDO::FETCH_ASSOC)['price'];


        $query = $db->prepare("SELECT name FROM PRODUCTS WHERE id = $id");
        $query->execute();
        $name = $query->fetch(PDO::FETCH_ASSOC)['name'];

        $query = $db->prepare("SELECT image FROM PRODUCTS WHERE id = $id");
        $query->execute();
        $image = $query->fetch(PDO::FETCH_ASSOC)['image'];

    } catch (Exception $e) {
        echo "PDO Problem";
    }

    $index = array_search($id, array_column($_SESSION['cart'], 'id'));
    if ($index !== false) {
        $_SESSION['cart'][$index]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][] = array('id' => $id, 'name' => $name, 'image' => $image, 'price' => $price, 'quantity' => $quantity);
    }


    header("Location: ../public/?page=buy");
}