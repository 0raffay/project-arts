<?php
class Product
{
    public static $sortedInstances = array();
    public static $instances = array();
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
