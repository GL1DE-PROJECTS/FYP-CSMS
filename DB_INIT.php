<?php
$db_host='sql109.infinityfree.com';
$db_user='if0_34445728';
$db_pass='r8aJGkwE6vo';
$db_name='if0_34445728_fyp_csms';

$conn=mysqli_connect($db_host,$db_user,$db_pass);

// $sql = "CREATE DATABASE dataproject";
// if (mysqli_query($conn, $sql)) 
// {
//   echo "Database created successfully";
// } 
// else 
// {
//   echo "Error creating database: " . mysqli_error($conn);
// }

$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
$sql = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            Last_Name VARCHAR(255),
            phone VARCHAR(255),
            position VARCHAR(255),
            Level INT null,
            status INT null,
            ADD delStat INT null
        )";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table users created successfully</h3>";
        }
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

$sql = "CREATE TABLE customers (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            address VARCHAR(200),
            phone VARCHAR(20),
            email VARCHAR(100),
            PRIMARY KEY (id)
        );";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table customers created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

$sql = "CREATE TABLE cars (
            id INT NOT NULL AUTO_INCREMENT,
            make VARCHAR(50) NOT NULL,
            model VARCHAR(50) NOT NULL,
            year INT,
            color VARCHAR(50),
            price DECIMAL(10,2),
            PRIMARY KEY (id)
        )";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table sales created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

$sql = "CREATE TABLE sales (
            id INT NOT NULL AUTO_INCREMENT,
            sale_date DATE,
            customer_id INT,
            car_id INT,
            sale_price DECIMAL(10,2),
            PRIMARY KEY (id),
            FOREIGN KEY (customer_id) REFERENCES customers(id),
            FOREIGN KEY (car_id) REFERENCES cars(id)
        )";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table sales created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

$sql = "CREATE TABLE salespersons (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            address VARCHAR(200),
            phone VARCHAR(20),
            email VARCHAR(100),
            PRIMARY KEY (id)
        );";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table salespersons created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

        $sql = "CREATE TABLE payments (
            id INT NOT NULL AUTO_INCREMENT,
            sale_id INT,
            amount DECIMAL(10,2),
            payment_date DATE,
            payment_method VARCHAR(50),
            PRIMARY KEY (id),
            FOREIGN KEY (sale_id) REFERENCES sales(id)
        );";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table payments created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }
        
        $sql = "CREATE TABLE service (
            id INT NOT NULL AUTO_INCREMENT,
            car_id INT,
            service_date DATE,
            service_type VARCHAR(50),
            cost DECIMAL(10,2),
            PRIMARY KEY (id),
            FOREIGN KEY (car_id) REFERENCES cars(id)
        );";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table service created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

        $sql = "CREATE TABLE inventory (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            Make VARCHAR(255) NOT NULL,
            Model VARCHAR(255) NOT NULL,
            Year INT NOT NULL,
            Price DECIMAL(10, 2) NOT NULL,
            Color VARCHAR(255) NOT NULL,
            Mileage INT NOT NULL,
            Condition VARCHAR(255) NOT NULL,
            Location VARCHAR(255) NOT NULL,
            Status VARCHAR(255) NOT NULL,
            chasis VARCHAR(255) NOT NULL,
            delStat int null
        );";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table inventory created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

        $sql = "CREATE TABLE CarSales (
            sales_id INT AUTO_INCREMENT PRIMARY KEY,
            sales_date DATETIME,
            customer_id VARCHAR(255),
            product_id INT,
            quantity INT,
            unit_price DECIMAL(10, 2),
            total_price DECIMAL(10, 2),
            salesperson_id VARCHAR(255),
            payment_method VARCHAR(50),
            discount DECIMAL(5, 2),
            tax DECIMAL(8, 2),
            shipping_address VARCHAR(100),
            order_status VARCHAR(20),
            payment_status VARCHAR(20),
            salesRef VARCHAR(255),

        );";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<h3>Table CarSales created successfully</h3>";
        } 
        else 
        {
            echo "Error creating table: " . mysqli_error($conn);
        }

$sql = "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Toyota', 'Camry', 2022, 25000.00, 'Red', 15000, 'Excellent', 'New York', 'Available', '1HGCM82633A123456');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Honda', 'Civic', 2021, 22000.00, 'Blue', 20000, 'Good', 'Los Angeles', 'Available','JM1BK12F571235678
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Ford', 'Mustang', 2023, 35000.00, 'Yellow', 1000, 'Like New', 'Chicago', 'Available','5YJSA1E12HF123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Chevrolet', 'Silverado', 2020, 30000.00, 'Black', 25000, 'Very Good', 'Houston', 'Available','WBAYA6C54ED123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Nissan', 'Altima', 2019, 18000.00, 'White', 35000, 'Good', 'Miami', 'Available','1G1BL52P2TR123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('BMW', 'X5', 2022, 45000.00, 'Silver', 8000, 'Excellent', 'San Francisco', 'Available','JTHCE1D20E5001234
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Mercedes-Benz', 'C-Class', 2020, 40000.00, 'Silver', 12000, 'Like New', 'New York', 'Available','3VWRF71K89M612345
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Audi', 'A4', 2018, 28000.00, 'Gray', 30000, 'Good', 'Los Angeles', 'Available','WBAKC6C54CC123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Volkswagen', 'Golf', 2017, 15000.00, 'Black', 40000, 'Fair', 'Chicago', 'Available','2HGFB2F56DH123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Jeep', 'Wrangler', 2021, 35000.00, 'Green', 8000, 'Excellent', 'Miami', 'Available','1G6DH5E51C0145678
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Hyundai', 'Elantra', 2019, 18000.00, 'Blue', 25000, 'Good', 'Houston', 'Available','WAUZZZ8K9CA123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Kia', 'Sorento', 2022, 32000.00, 'White', 15000, 'Excellent', 'San Francisco', 'Available','1FTSW21R68EB12345
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Subaru', 'Impreza', 2018, 20000.00, 'Red', 50000, 'Good', 'New York', 'Available','JN8AZ2KR5AT123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Lexus', 'RX 350', 2020, 45000.00, 'Black', 15000, 'Excellent', 'Los Angeles', 'Available','KM8JN72D38U123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('GMC', 'Sierra 1500', 2019, 32000.00, 'White', 30000, 'Very Good', 'Chicago', 'Available','1C4RJFAGXFC123456
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Volvo', 'XC60', 2021, 40000.00, 'Silver', 10000, 'Like New', 'Miami', 'Available','SCA663S50EUX12345
');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Mazda', 'CX-5', 2017, 18000.00, 'Blue', 45000, 'Good', 'Houston', 'Available','');";
$sql .= "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, chasis)
VALUES ('Jeep', 'Cherokee', 2022, 35000.00, 'Gray', 20000, 'Excellent', 'San Francisco', 'Available','4T1BF1FK6EU123456
');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-07 09:30:00', '7', 107, 3, 6.99, 20.97, '101', 'Credit Card', 0.75, 1.50, '567 Pine St, Cityville', 'Shipped', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-08 15:15:00', '8', 108, 2, 14.50, 29.00, '102', 'Cash', 0.0, 3.50, '678 Oak St, Townsville', 'Delivered', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status) 
VALUES ('2023-05-09 12:00:00', '9', 109, 1, 9.99, 9.99, '103', 'Credit Card', 0.0, 1.00, '789 Elm St, Villageland', 'Pending', 'Pending');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-04 11:20:00', '4', 104, 2, 8.75, 17.50, '101', 'Credit Card', 0.25, 1.20, '234 Maple Ave, Citytown', 'Shipped', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-05 16:10:00', '5', 105, 1, 19.99, 19.99, '103', 'PayPal', 0.0, 2.50, '345 Oakwood Dr, Villageville', 'Delivered', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-06 13:45:00', '6', 106, 4, 12.50, 50.00, '102', 'Cash', 0.5, 3.75, '456 Elm St, Townsville', 'Shipped', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-01 10:30:00', '1', 101, 2, 10.99, 21.98, '101', 'Credit Card', 0.5, 1.50, '123 Main St, Cityville', 'Shipped', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-02 14:45:00', '2', 102, 1, 25.50, 25.50, '102', 'Cash', 0.0, 3.00, '456 Elm St, Townsville', 'Delivered', 'Paid');";
$sql .= "INSERT INTO CarSales (sales_date, customer_id, product_id, quantity, unit_price, total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status)
VALUES ('2023-05-03 09:15:00', '3', 103, 3, 5.99, 17.97, '103', 'Credit Card', 1.0, 0.75, '789 Oak St, Villageland', 'Pending', 'Pending');";

if (mysqli_multi_query($conn, $sql)) 
{
    echo "<h3>New records created successfully</h3>";
} 
else 
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>