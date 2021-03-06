<?php 
//get all products 
function getAllProducts($db) 
{
$sql = 'Select p.name, p.description, p.price, c.name as category from products p ';
$sql .='Inner Join categories c on p.category_id = c.id';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//get product by name
function getProduct($db, $productName)
{
$sql = 'Select p.description, p.price, c.name as category from products p ';
$sql .= 'Inner Join categories c on p.category_id = c.id ';
$sql .= 'Where p.name = :name';
$stmt = $db->prepare ($sql);
$name = $productName;
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createProduct($db,$form_data)
{
    $sql = 'Insert into products (name, description, price, category_id, created)';
    $sql .= 'values (:name, :description, :price, :category_id, :created)';
    $stmt = $db -> prepare ($sql);
    $stmt -> bindParam(':name', $form_data['name']);
    $stmt -> bindParam(':description', $form_data['description']);
    $stmt -> bindParam(':price', floatval( $form_data['price']));
    $stmt -> bindParam(':category_id',intval( $form_data['category_id']));
    $stmt -> bindParam(':created', $form_data['created']);
    $stmt->execute();
    return $db ->lastInsertID(); //insert last number.. continue
};

//delete product by name
function deleteProduct($db,$productName) {
    $sql = ' Delete from products where name = :name';
    $stmt = $db->prepare($sql);
    $name = $productName;
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
}

function updateProduct($db,$form_dat,$productName,$date)
{
    $sql = 'UPDATE products SET name = :name , description = :description , price = :price , category_id = :category_id , modified = :modified ';
    $sql .=' WHERE name = :name';

    $stmt = $db->prepare ($sql);
    $name = (int)$productName;
    $mod = $date;

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_dat['name']);
    $stmt->bindParam(':description', $form_dat['description']);
    $stmt->bindParam(':price', floatval($form_dat['price']));
    $stmt->bindParam(':category_id', intval($form_dat['category_id']));
    $stmt->bindParam(':modified', $mod , PDO::PARAM_STR);
    $stmt->execute();
  
    $sql1 = 'Select p.description, p.price, c.name as category from products as p ';
    $sql1 .= 'Inner Join categories c on p.category_id = c.id ';
    $sql1 .= 'Where p.name = :name'; 
    $stmt1 = $db->prepare ($sql1);
    $stmt1->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt1->execute();
    return $stmt1->fetchAll(PDO::FETCH_ASSOC);
}
