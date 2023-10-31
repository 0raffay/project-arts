<?php
session_start();

//GLOBALS:
global $currentCustomer;
global $currentProduct;
global $productsInCart;
global $productsInCartQuantity;

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
    public $errorStatements = array();

    // CREATES PRODUCT OBJECT -- RUNNING IN createInstancesOfProduct();
    public function __construct($name, $SKU, $category, $stock, $img, $productKeywords, $price, $description, $warranty, $brand)
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

            //PRODUCT SKU GENERATION:
            $initials = $productName[0] . $productName[1];
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

            //PRODUCT CATEGROY:
            $productCategory = $_POST["productCategory"];

            //PRODUCT KEYWORDS:
            $productKeywords = $_POST['productKeywords'];
            $allProductKeywords = strtolower($productKeywords) . " " . strtolower($productCategory) . " " . strtolower($productName) . " " . strtolower($productSKU);

            //PRODUCT DESCRIPTION:
            $productDescription = $_POST["productDescription"];


            //PRODUCT WARRANTY:
            $productWarranty = "";
            $productWarrantyStatus = $_POST["productWarranty"];
            if ($productWarrantyStatus == "1") {
                $productWarranty = "W-" . random_int(100000, 999999);
            } else {
                $productWarranty = "No Warranty";
            }

            //Product Brand;
            $productBrand = $_POST["productBrand"];

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
                    "INSERT INTO `products` (`Product Id`, `Product Name`, `Product Stock`, `Product Category`, `Product SKU`, `Images`,  `Keywords`, `Warranty`, `Product Price`, `Product Description`, `Product Brand`) VALUES (NULL, '$productName', '$productStock', '$productCategory', '$productSKU', '$imgUrl', '$productKeywords', '$productWarranty', '$productPrice', '$productDescription', '$productBrand')";


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
    public static function createInstancesOfProduct($connection)
    {
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

                new Product($name, $SKU, $category, $stock, $imagePaths, $keywords, $price, $description, $warranty, $brand);
            }
        }
    }

    // TO DELETE THE PRODUCT FROM THE DB AND FROM THE INSTANCES
    function deleteProduct($connection)
    {
        $deleteSQL = "DELETE FROM `products` WHERE `Product SKU` = '$this->SKU'";
        $deleteResult = mysqli_query($connection, $deleteSQL);

        if (!$deleteResult) {
            $this->errorStatements['deleteProduct'] = "Product Couldn't Be Deleted";
        } else {
            $this->errorStatements['deleteProduct'] = "Product Was Deleted";
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }
    }
}
// CREATING INITIAL PRODUCT BASE:
Product::createInstancesOfProduct($connection);


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
    public static function editProductQuantityInCart($connection, $productIndex, $updatedQuantity)
    {
        global $currentCustomer;
        $customerId = $currentCustomer["Customer Id"];

        $query = "SELECT * FROM `cart` WHERE `Customer Id` = '$customerId'";
        $result = mysqli_query($connection, $query);
        if ($result && $result->num_rows > 0) {
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
                // Quantity updated successfully
                return true;
            } else {
                // Failed to update quantity
                return false;
            }
        } else {
            // Handle the case where the customer's cart data doesn't exist.
            return false;
        }
    }
}

if (isset($_COOKIE["currentCustomer"])) {
    $currentCustomer = json_decode($_COOKIE["currentCustomer"], true);
} else {
    $currentCustomer = null;
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
