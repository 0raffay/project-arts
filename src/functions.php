<?php
session_start();

//GLOBALS:
global $currentCustomer;
global $currentProduct;
global $productsInCart;
global $productsInCartQuantity;
global $currentAdmin;
global $connection;

//CLASSES:
class Product
{
    public static $Id;
    public static $sortedInstances = array();
    public static $instances = array();
    public $userQuantity;
    public $price;
    public $name;
    public $SKU;
    public $category;
    public $stock;
    public $images;
    public $keywords;
    public $description;
    public $warranty;
    public $brand;
    public $uploadDate;

    // CREATES PRODUCT OBJECT -- RUNNING IN createInstancesOfProduct();
    public function __construct($name, $SKU, $category, $stock, $img, $productKeywords, $price, $description, $warranty, $brand, $uploadDate)
    {
        $this->price = $price;
        $this->name = $name;
        $this->category = $category;
        $this->SKU = $SKU;
        $this->stock = $stock;
        $this->images = $img;
        $this->keywords = $productKeywords;
        $this->description = $description;
        $this->warranty = $warranty;
        $this->brand = $brand ? $brand : "Brand";
        $this->uploadDate = $uploadDate;

        self::$instances[] = $this;
    }

    // UPLOAD PRODUCTS:
    public static function uploadProduct($connection)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            //Product Price:
            $productPrice = $_POST['productPrice'];

            //PRODUCT NAME:
            $productName = $_POST['productTitle'];

            //PRODUCT CATEGROY:
            $productCategory = $_POST["productCategory"];


            //PRODUCT SKU GENERATION:
            $initials = $productCategory[0] . $productCategory[1];
            $initials = strtoupper($initials);
            $productSKU = $initials . "-" . random_int(100000, 999999);
            $checkSKU = "SELECT `Product SKU` FROM products WHERE `Product SKU` = '$productSKU'";
            $checkSKUQuery = mysqli_query($connection, $checkSKU);
            if ($checkSKUQuery) {
                if ($checkSKUQuery->num_rows > 0) {
                    $productSKU = $initials . "-" . random_int(100000, 999999);
                }
            } else {
                echo "Error checking SKU: " . mysqli_error($connection);
            }

            //PRODUCT STOCK:
            $productStock = $_POST["productQuantity"];


            //PRODUCT DESCRIPTION:
            $productDescription = $_POST["productDescription"];

            //Product Brand;
            $productBrand = $_POST["productBrand"];


            //PRODUCT KEYWORDS:
            $productKeywords = explode(",", $_POST['productKeywords']);
            $titleArray = explode(" ", strtolower($productName));
            $productCategoryArray = explode(" ", strtolower($productCategory));
            $productBrandArray = explode(" ", strtolower($productBrand));

            $allProductKeywordsArray = array_merge($productKeywords, $titleArray, $productCategoryArray, $productBrandArray);

            $allProductKeywordsArrayString = implode(",", $allProductKeywordsArray);

            // $allProductKeywords = strtolower($productKeywords) . " " . strtolower($productCategory) . " " . strtolower($productName) . " " . strtolower($productSKU);


            //PRODUCT WARRANTY:
            $productWarranty = "";
            $productWarrantyStatus = $_POST["productWarranty"];
            if ($productWarrantyStatus == "1") {
                $productWarranty = "W-" . random_int(100000, 999999);
            } else {
                $productWarranty = "0";
            }


            //CREATING IMAGE FILES
            if ($_FILES['productImages']['error'] === 0) {
                $img_name = $_FILES['productImages']['name'];
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
                global $em;

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = __DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'product-images' . DIRECTORY_SEPARATOR . $new_img_name;
                    if (move_uploaded_file($_FILES['productImages']['tmp_name'], $img_upload_path)) {
                        $imgUrl = $new_img_name;
                    } else {
                        $em = "Error uploading the image.";
                    }
                } else {
                    $em = "You can't upload files of this type";
                }
            } else {
                $em = "Unknown error occurred!";
            }

            if (!isset($em)) {
                $insertSQL =
                    "INSERT INTO `products` (`Product Id`, `Product Name`, `Product Stock`, `Product Category`, `Product SKU`, `Images`,  `Keywords`, `Warranty`, `Product Price`, `Product Description`, `Product Brand`) VALUES (NULL, '$productName', '$productStock', '$productCategory', '$productSKU', '$imgUrl', '$allProductKeywordsArrayString', '$productWarranty', '$productPrice', '$productDescription', '$productBrand')";


                $resultOfQuery = mysqli_query($connection, $insertSQL);

                if ($resultOfQuery) {
                    $_SESSION["prodjuctUploadStatus"] = "Product Has been Uploaded";
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    exit;
                } else {
                    echo "<script>alert('Product Couldn't be Uploaded. Check Connection')</script>";
                }
            } else {
                // Handle the error, show an error message, or redirect as needed
                // For example, you can display the error message on the current page.
                echo "Error: $em";
            }
        }
    }

    // CREATE INSTANCES OF PRODUCTS IN CLASS ON PAGE LOAD
    public static function createInstancesOfProduct()
    {
        global $connection;
        $showSQL = "SELECT * FROM `products`";
        $showQueryResult = mysqli_query($connection, $showSQL);

        if ($showQueryResult->num_rows > 0) {

            while ($eachRow = $showQueryResult->fetch_assoc()) {
                Product::$Id = $eachRow["Product Id"];
                $price = $eachRow["Product Price"];
                $name = $eachRow['Product Name'];
                $stock = $eachRow['Product Stock'];
                $category = $eachRow['Product Category'];
                $SKU = $eachRow['Product SKU'];
                $keywords = $eachRow["Keywords"];
                $imagePaths = $eachRow["Images"];
                $description = $eachRow["Product Description"];
                $warranty = $eachRow["Warranty"];
                $brand = $eachRow["Product Brand"];
                $uploadDate = $eachRow["upload_date"];

                new Product($name, $SKU, $category, $stock, $imagePaths, $keywords, $price, $description, $warranty, $brand, $uploadDate);
            }
        }
    }

    // TO DELETE THE PRODUCT FROM THE DB AND FROM THE INSTANCES
    function deleteProduct($connection)
    {
        $deleteSQL = "DELETE FROM `products` WHERE `Product SKU` = '$this->SKU'";
        $deleteResult = mysqli_query($connection, $deleteSQL);

        if (!$deleteResult) {
            echo  "Product Couldn't Be Deleted";
        } else {
            echo  "Product Was Deleted";
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }
    }

    public static function sortProducts($keyword)
    {
        $lowerCaseKeywords = strtolower($keyword);
        $keywordsArray = explode(" ", $lowerCaseKeywords);
        foreach ($keywordsArray as $keyword) {
            $keywordsArray[] = $keyword . "s";
        }
        $matchingProducts = [];

        $products = Product::$instances;

        foreach ($products as $product) {
            $keys = strtolower($product->keywords);
            $keyArray = explode(",", $keys);
            foreach ($keyArray as $key) {
                $keyArray[] = $key . "s";
            }

            // Check if any of the keywords are present in the product's title
            if (array_intersect($keywordsArray, $keyArray)) {
                $matchingProducts[] = $product;
            }
        }
        return json_encode($matchingProducts);
    }


    // public static function fetchSpecificProducts($column, $value)
    // {
    //     global $connection;
    //     $query = "SELECT * FROM `products` WHERE `$column` = '$value'";
    //     $result = mysqli_query($connection, $query);
    //     if ($result) {
    //         $rows = array();
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     } else {
    //         return " RESULT NOT FOUND;";
    //     }
    // }
}


class Customer
{
    public static $instances = array();
    public $customerName;
    public $customerEmail;
    public $customerPassword;
    public $customerPhone;


    // REINITIALIZAIN CUSTOMER INTO COOKIE;
    public static function reInitializeCustomerInCookie($connection, $newRow)
    {
        setcookie('currentCustomer', json_encode($newRow), time() + (86400 * 30), "/");
        Customer::creatingCustomerCart($connection, $newRow);
    }


    //CUSTOMER SIGN UP;
    function __construct($connection, $name, $email, $password, $phone)
    {
        $this->customerName = $name;
        $this->customerEmail = $email;
        $this->customerPassword = $password;
        $this->customerPhone = $phone;

        $query = "INSERT INTO `customer` (`Customer Id`, `Customer Name`, `Customer Email`, `Customer Password`, `Customer Phone`, `Customer Address`, `Customer City`, `Customer Zipcode`) VALUES (NULL, '$name', '$email', '$password', '$phone', '', '', '')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $rowQuery = "SELECT * FROM `customer` WHERE `Customer Email` = '$email' AND `Customer Password` = '$password'";
            $forRowResult = mysqli_query($connection, $rowQuery);
            if ($forRowResult) {
                while ($row = $forRowResult->fetch_assoc()) {
                    Customer::reInitializeCustomerInCookie($connection, $row);
                }
            }
            header("location: customer-profile.php");
            exit();
        } else {
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit();
        }
    }

    // CUSTOMER LOGIN:
    public static function customerLogin($connection, $email, $password)
    {
        $query = "SELECT * FROM `customer` WHERE `Customer Email` = '$email' AND `Customer Password` = '$password'";
        $result = mysqli_query($connection, $query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            Customer::reInitializeCustomerInCookie($connection, $row);
            return true;
        } else {
            return false;
        }
    }

    // FOR DASHBOARD GETTING ALL CUSTOMER:
    public static function getAllCustomerData($connection)
    {
        $query = "SELECT * FROM `customer`";
        $result = mysqli_query($connection, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                Customer::$instances[] = $row;
            }
        } else {
            return "There Are No Customer Accounts.";
        }
    }

    // SETTING UP CUSTOMER CART:
    public static function creatingCustomerCart($connection, $currentCustomer)
    {
        $customerId = $currentCustomer["Customer Id"];
        $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId' ";
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "Cart Already Exists";
        } else {
            $insertQuery = "INSERT INTO `cart` (`Cart Id`, `Customer Id`, `Products`) VALUES (NULL, '$customerId', '')";
            $insertResult = mysqli_query($connection, $insertQuery);
            if ($insertResult) {
                echo "Cart Created";
            } else {
                echo "Cart Not Created";
            }
        }
    }


    // SETTING CUSTOMER ADDRESS/BILLING DETAILS:
    public static function setBillingDetails($connection, $address,  $city, $zip)
    {
        global $currentCustomer;
        if ($currentCustomer !== null) {
            $customerId = $currentCustomer["Customer Id"];
            $query = "UPDATE `customer` SET `Customer Address` = '$address', `Customer City` = '$city', `Customer Zipcode` = '$zip' WHERE `Customer Id` = '$customerId'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                echo "Something Went Wrong";
            } else {
                $query = "SELECT * FROM `customer` WHERE `Customer Id` = '$customerId'";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    $newRow = $result->fetch_assoc();
                    Customer::reInitializeCustomerInCookie($connection, $newRow);
                }
            }
        }
    }

    // EDIT CART QUANTITY:
    public static function editProductQuantityInCart($connection, $productSKU, $productIndex, $updatedQuantity)
    {
        global $currentCustomer;
        $customerId = $currentCustomer["Customer Id"];
        $error = array(
            "errorLevel" => 1,
            "error" => 1,
        );

        $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
        $result = mysqli_query($connection, $query);
        if ($result && $result->num_rows > 0) {
            $checkQuery = "SELECT * FROM `products` WHERE `Product SKU`='$productSKU'";
            $checkResult = mysqli_query($connection, $checkQuery);
            if ($checkResult) {
                $row = $checkResult->fetch_assoc();
                $quantity = $row["Product Stock"];
                if ($updatedQuantity > $quantity) {
                    // $error = array(
                    //     "errorLevel" => 0,
                    //     "error" => "There is not enough quantity in stock",
                    // );
                    $error["errorLevel"] = 0;
                    $error["error"] = "There is not enough quantity in stock";
                    // print_r(json_encode($error));
                } else {
                    $resultArray = $result->fetch_assoc();

                    $previousProductsQuantity = $resultArray["Product Quantity"];
                    $previousProductsQuantityArray = explode(",", $previousProductsQuantity);


                    $previousProductsQuantityArray[$productIndex] = $updatedQuantity;
                    $previousProductsQuantityArray = array_values($previousProductsQuantityArray);
                    $newQuantity = implode(",", $previousProductsQuantityArray);

                    // Update the Product Quantity with the new value
                    $updateQuery = "UPDATE `cart` SET `Product Quantity` = '$newQuantity' WHERE `Customer Id` = '$customerId'";
                    $updateResult = mysqli_query($connection, $updateQuery);
                    if ($updateResult) {
                        // echo "product quanitity was updated";
                        // echo json_decode($error);
                    } else {
                        // echo "something went wrong could'nt update quantity";
                        // echo json_decode($error);
                    }
                }
            } else {
                // echo "Product Not found";
                // echo json_decode($error);
            }
        } else {
            // echo " cart doesn't exist";
            // echo json_decode($error);
        }
        echo json_encode($error);
    }

    public static function fetchOrders()
    {
        global $connection;
        global $currentCustomer;
        $customerID = $currentCustomer["Customer Id"];
        $query = "SELECT * FROM `order` WHERE `Customer Id` = '$customerID' ORDER BY `order_date` DESC";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
                // print_r($rows);
            }
            return $rows;
        } else {
            return " RESULT NOT FOUND;";
        }
    }

    public static function fetchAllOrders()
    {
        global $connection;
        $query = "SELECT * FROM `order` ORDER BY `order_date` DESC";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return " RESULT NOT FOUND;";
        }
    }

    public static function fetchSpecificProducts($column, $value)
    {
        global $connection;
        $query = "SELECT * FROM `order` WHERE `$column` = '$value'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return " RESULT NOT FOUND;";
        }
    }
}

class Category
{
    public static function fetchAllCategory()
    {
        global $connection;
        $query = "SELECT * FROM `category`";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return "No Categories";
        }
    }

    public static function createCategory($catName)
    {
        global $connection;
        $query = "INSERT INTO `category` (`Category Id`, `Category Name`) VALUES (NULL, '$catName')
        ";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "Category was set";
        } else {
            echo "Something went wrong";
        }
    }
    public static function deleteCategory($catId)
    {
        global $connection;
        $query = "DELETE  FROM `category` WHERE `Category Id` = '$catId' ";
        $result = mysqli_query($connection, $query);
        if ($result) {
            return "category has been deleted";
        } else {
            return "No Categories";
        }
    }

    public static function renameCategory($catId, $newName)
    {
        global $connection;
        $query = "UPDATE  `category` SET `Category Name` = '$newName'  WHERE `Category Id` = '$catId' ";
        $result = mysqli_query($connection, $query);
        if ($result) {
            return "Category Has been renamed";
        } else {
            return "Error: " . mysqli_error($connection);
        }
    }
}

class Admin
{
    public $adminName;
    public $adminEmail;
    public $adminPass;
    public $adminPhone;
    public $rights;

    public function __construct($adminName, $adminEmail, $adminPhone, $adminPass, $rights)
    {
        $this->adminName = $adminName;
        $this->adminEmail = $adminEmail;
        $this->adminPhone = $adminPhone;
        $this->adminPass = $adminPass;
        $this->rights = $rights;
    }

    public static function createAdmin($adminName, $adminEmail, $adminPhone, $adminPass, $rights)
    {
        global $connection;
        //check email before;
        $query = "SELECT * FROM `admin` WHERE `Admin Email` = '$adminEmail'";
        $result = mysqli_query($connection, $query);
        $state = 'empty';
        if ($result->num_rows > 0) {
            $state = "User Already exists. Try with another Email Address";
        } else {
            $insertQuery = "INSERT INTO `admin` (`Admin Id`, `Admin Name`, `Admin Email`, `Admin Password`, `Admin Phone`, `Rights`) VALUES (NULL, '$adminName', '$adminEmail', '$adminPass', '$adminPhone', '$rights')";

            $insertQuery = mysqli_query($connection, $insertQuery);
            if ($insertQuery) {
                $state = "New Admin was created";
                // new Admin($adminName, $adminEmail, $adminPhone, $adminPass, $rights);
            } else {
                $state = "There was a problem creating new admin";
            }
        }
        return $state;
    }

    public static function login($adminEmail, $password)
    {
        global $connection;
        global $currentAdmin;
        $state = "empty";
        $passQuery = "SELECT * FROM `admin` WHERE `Admin Email` = '$adminEmail' AND `Admin Password` = '$password'";
        $passResult = mysqli_query($connection, $passQuery);
        if ($passResult && $passResult->num_rows > 0) {
            $row = $passResult->fetch_assoc();
            $state = "Logged In";
            Admin::setCurrentAdmin($row);
        } else {
            $state = "Couldn't Find User";
        }
        return $state;
    }

    public static function setCurrentAdmin($_this)
    {
        global $currentAdmin;
        $currentAdmin =  $_SESSION["currentAdmin"] = $_this;
    }

    public static function fetchAllAdmin()
    {
        global $connection;
        $query = "SELECT * FROM `admin` ";
        $result = mysqli_query($connection, $query);
        $admins = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $admins[] = $row;
            }
        } else {
            $admins = "No admins found";
        }
        return $admins;
    }


    public static function deleteAdmin($adminId)
    {
        global $connection;
        $query = "DELETE FROM `admin` WHERE `Admin Id` = '$adminId'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "User Deleted";
        }
    }

    public static function updateDetails($adminName, $adminEmail, $adminPhone, $adminPass)
    {
        global $connection;

        // You may want to add validation for inputs here

        // Check for duplicate entries
        $emailQuery = "SELECT * FROM `admin` WHERE `Admin Email` = '$adminEmail' AND `Admin Id` != " . $_SESSION["currentAdmin"]["Admin Id"];
        $emailResult = mysqli_query($connection, $emailQuery);

        if ($emailResult->num_rows > 0) {
            return "Email already in use. Please choose a different one.";
        }

        $phoneQuery = "SELECT * FROM `admin` WHERE `Admin Phone` = '$adminPhone' AND `Admin Id` != " . $_SESSION["currentAdmin"]["Admin Id"];
        $phoneResult = mysqli_query($connection, $phoneQuery);

        if ($phoneResult->num_rows > 0) {
            return "Phone number already in use. Please choose a different one.";
        }

        // Update details in the database
        $currentAdminId = $_SESSION["currentAdmin"]["Admin Id"];
        $updateQuery = "UPDATE `admin` SET
                        `Admin Name` = '$adminName',
                        `Admin Email` = '$adminEmail',
                        `Admin Phone` = '$adminPhone',
                        `Admin Password` = '$adminPass'
                        WHERE `Admin Id` = $currentAdminId";

        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            // Update the current admin session variable
            $_SESSION["currentAdmin"]["Admin Name"] = $adminName;
            $_SESSION["currentAdmin"]["Admin Email"] = $adminEmail;
            $_SESSION["currentAdmin"]["Admin Phone"] = $adminPhone;
            $_SESSION["currentAdmin"]["Admin Password"] = $adminPass;

            return true; // Success
        } else {
            return "Error updating details. Please try again.";
        }
    }
}

if (isset($_COOKIE["currentCustomer"])) {
    $currentCustomer = json_decode($_COOKIE["currentCustomer"], true);
} else {
    $currentCustomer = null;
}

if (isset($_SESSION["currentAdmin"])) {
    $currentAdmin = $_SESSION["currentAdmin"];
} else {
    $currentAdmin = null;
}

function checkCurrentProduct($productId)
{
    global $currentProduct;
    $products = Product::$instances;
    foreach ($products as $product) {
        if ($product->SKU == $productId) {
            $currentProduct = $product;
            return $currentProduct;
        }
    }
}


function fetchCartProducts($connection, $currentCustomer)
{
    global $productsInCart;
    global $productsInCartQuantity;
    if ($currentCustomer == null) {
    } else {
        $customerId = $currentCustomer['Customer Id'];
        $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $data = $result->fetch_assoc();

            if ($data["Products"] != null && $data["Products"] != "") {
                $productsInCart = explode(",",  $data["Products"]);
                $productsInCartQuantity = explode(",",  $data["Product Quantity"]);
            }
        }
    }
}

fetchCartProducts($connection, $currentCustomer);
function returnerBySqlQuery($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    $_returned = array();

    if (!$result) {
        return "0";
    } else {
        if (mysqli_num_rows($result) < 2) {
            $_returned = $result->fetch_assoc();
        } else {
            while ($row = $result->fetch_assoc()) {
                $_returned[] = $row;
            }
        }
        return $_returned;
    }
}


// CREATING INITIAL PRODUCT BASE:
Product::createInstancesOfProduct();


function deliverOrders()
{
    global $connection;
    $currentDate = date('Y-m-d');
    $query = "UPDATE `order` SET `Order Status` = 'delivered' WHERE `est_delivery_date` = '$currentDate'";

    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "";
    }
}

deliverOrders();

class Returns
{

    public static function fetchReturns($column, $value)
    {
        global $connection;
        $query = "SELECT * FROM `returns` WHERE `$column` = '$value'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return "RESULT NOT FOUND";
        }
    }

    public static function fetchAll()
    {
        global $connection;
        $query = "SELECT * FROM `returns` ORDER BY `return_date` ASC ";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return "RESULT NOT FOUND";
        }
    }

    public static function createReturn($orderId, $orderNum, $customerId, $returnItem, $returnItemQuantity, $returnDetails, $returnStatus)
    {
        global $connection;
        $insert = "INSERT INTO `returns` (`return_id`, `order_id`, `order_num`, `customer_id`, `return_item`, `return_item_quantity`, `return_details`, `return_status`, `return_date`) VALUES (NULL, '$orderId', '$orderNum', '$customerId', '$returnItem', '$returnItemQuantity', '$returnDetails', '$returnStatus', current_timestamp())";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function updateReturn($query)
    {
        global $connection;
        $result = mysqli_query($connection, $query);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
}
