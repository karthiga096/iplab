<%@ page import="java.sql.*" %> 
<%@ page contentType="text/html;charset=UTF-8" language="java" %> 
<% 
// ========================================= 
// DATABASE DETAILS 
// ========================================= 
 
String dbUrl = "jdbc:mysql://localhost:3306/online_shopping"; 
String dbUser = "root"; 
String dbPassword = "mysql";   // CHANGE TO YOUR MYSQL PASSWORD 
 
String message = ""; 
String messageColor = "green"; 
 
String action = request.getParameter("action"); 
 
Connection con = null; 
 
try { 
 
    // ========================================= 
    // CONNECT DATABASE 
    // ========================================= 
 
    Class.forName("com.mysql.jdbc.Driver"); 
 
    con = DriverManager.getConnection( 
        dbUrl, 
        dbUser, 
        dbPassword 
    ); 
 
 
    // ========================================= 
    // SAVE NEW ORDER 
    // ========================================= 
 
    if ("order".equals(action)) { 
 
        String customerName = 
            request.getParameter("customer_name"); 
 
        String product = 
            request.getParameter("product"); 
 
        String quantityText = 
            request.getParameter("quantity"); 
 
        String payment = 
            request.getParameter("payment"); 
 
        String priceText = 
            request.getParameter("price"); 
 
 
        // Remove spaces 
        if (customerName != null) { 
            customerName = customerName.trim(); 
        } 
 
        if (product != null) { 
            product = product.trim(); 
        } 
 
        if (payment != null) { 
            payment = payment.trim(); 
        } 
 
 
        // ===================================== 
        // VALIDATION 
        // ===================================== 
 
        if (customerName == null || 
            customerName.equals("")) { 
 
            message = "Order Failed: Name is required."; 
            messageColor = "red"; 
 
        } else if (product == null || 
                   product.equals("")) { 
 
            message = "Order Failed: Product is required."; 
            messageColor = "red"; 
 
        } else if (quantityText == null || 
                   quantityText.equals("")) { 
 
            message = "Order Failed: Quantity is required."; 
            messageColor = "red"; 
 
        } else if (payment == null || 
                   payment.equals("")) { 
 
            message = "Order Failed: Payment method is required."; 
            messageColor = "red"; 
 
        } else if (priceText == null || 
                   priceText.equals("")) { 
 
            message = "Order Failed: Price is required."; 
            messageColor = "red"; 
 
        } else { 
 
            try { 
 
                int quantity = 
                    Integer.parseInt(quantityText); 
 
                double price = 
                    Double.parseDouble(priceText); 
 
 
                // ===================================== 
                // INSERT ORDER 
                // ===================================== 
 
                String insertSQL = 
                    "INSERT INTO orders " + 
                    "(name, product, quantity, payment_method, price) " + 
                    "VALUES (?, ?, ?, ?, ?)"; 
 
 
                PreparedStatement insertPS = 
                    con.prepareStatement(insertSQL); 
 
 
                /* 
                 * customer_name from index.html 
                 * is saved into database "name" 
                 * column. 
                 */ 
 
                insertPS.setString(1, customerName); 
                insertPS.setString(2, product); 
                insertPS.setInt(3, quantity); 
                insertPS.setString(4, payment); 
                insertPS.setDouble(5, price); 
 
 
                int result = 
                    insertPS.executeUpdate(); 
 
 
                insertPS.close(); 
 
 
                if (result > 0) { 
 
                    message = 
                        "Order Successful! Your order has been saved."; 
 
                    messageColor = "green"; 
 
                } else { 
 
                    message = 
                        "Order Failed: Order was not saved."; 
 
                    messageColor = "red"; 
                } 
 
            } catch (NumberFormatException e) { 
 
                message = 
                    "Order Failed: Invalid quantity or price."; 
 
                messageColor = "red"; 
            } 
        } 
    } 
 
} catch (Exception e) { 
 
    message = 
        "Order Failed: " + e.getMessage(); 
 
    messageColor = "red"; 
} 
 
 
%> 
 
<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> 
 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 
<title>QuickShop - All Orders</title> <style> /* 
========================================= BASIC 
========================================= */ * { box-sizing: border-box; margin: 0; 
padding: 0; } body { font-family: Arial, sans-serif; min-height: 100vh; padding: 30px; background: 
url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWfwicrQ1IrjlUym7HqFJGIt
3_c35xKbZVDBXBSugq-5ho9Nz-uEpkOTM&s=10') no-repeat center center fixed; background
size: cover; background-color: pink; } /* ========================================= 
MAIN CARD ========================================= */ .container { width: 100%; 
max-width: 1100px; margin: auto; padding: 30px; background: rgba(255,255,255,0.95); border
radius: 18px; box-shadow: 0 10px 35px rgba(0,0,0,0.25); } /* 
========================================= TITLE 
========================================= */ h1 { text-align: center; color: #ff3366; 
margin-bottom: 8px; font-size: 32px; } .subtitle { text-align: center; color: #777; margin-bottom: 
25px; } /* ========================================= MESSAGE 
========================================= */ .message { text-align: center; padding: 
15px; margin-bottom: 25px; background: #fff5f8; border-radius: 10px; font-size: 18px; font
weight: bold; color: <%= messageColor %>; } /* 
========================================= TABLE 
========================================= */ .table-title { color: #333; margin-bottom: 
15px; font-size: 22px; } .table-wrapper { width: 100%; overflow-x: auto; border-radius: 10px; } 
table { width: 100%; min-width: 850px; border-collapse: collapse; background: white; } th { 
background: #ff3366; color: white; padding: 14px 12px; text-align: center; font-size: 15px; } td { 
padding: 13px 12px; text-align: center; border-bottom: 1px solid #eee; color: #333; } tr:nth
child(even) { background: #fff5f8; } tr:hover { background: #ffe0e9; } /* 
========================================= PRICE 
========================================= */ .price { color: #e60039; font-weight: bold; 
} /* ========================================= BACK BUTTON 
========================================= */ .back-button { display: block; width: 
220px; margin: 30px auto 0; padding: 13px; text-align: center; text-decoration: none; color: 
white; background: #ff3366; border-radius: 8px; font-weight: bold; } .back-button:hover { 
background: #e60039; } /* ========================================= NO ORDERS 
========================================= */ .no-orders { padding: 30px; color: #777; 
font-size: 17px; } /* ========================================= MOBILE 
========================================= */ @media(max-width:600px) { body { 
padding: 15px; } .container { padding: 20px 12px; } h1 { font-size: 25px; } } </style> </head> 
<body> <div class="container"> 
<h1>     QuickShop</h1> 
<p class="subtitle"> 
Order Successful &nbsp; | &nbsp; All Orders 
</p> 
<% if (!message.equals("")) { %> 
<div class="message"> 
<%= message %> 
</div> 
<% } %> 
<h2 class="table-title"> 
             All Previous & Current Orders 
</h2> 
 
 
<div class="table-wrapper"> 
 
 
    <table> 
 
 
        <thead> 
 
            <tr> 
 
                <th>ID</th> 
 
                <th>Name</th> 
 
                <th>Order Date</th> 
 
                <th>Product</th> 
 
                <th>Quantity</th> 
 
                <th>Payment Method</th> 
 
                <th>Price</th> 
 
            </tr> 
 
        </thead> 
 
 
        <tbody> 
 
 
<% 
PreparedStatement selectPS = null; 
ResultSet rs = null; 
 
try { 
 
    String selectSQL = 
        "SELECT id, name, order_date, product, " + 
        "quantity, payment_method, price " + 
        "FROM orders " + 
        "ORDER BY id DESC"; 
 
 
    selectPS = 
        con.prepareStatement(selectSQL); 
 
 
    rs = 
        selectPS.executeQuery(); 
 
 
    boolean hasOrders = false; 
 
 
    while (rs.next()) { 
 
        hasOrders = true; 
 
 
%> 
 
            <tr> 
 
                <td> 
                    <%= rs.getInt("id") %> 
                </td> 
 
 
                <td> 
                    <%= rs.getString("name") %> 
                </td> 
 
 
                <td> 
                    <%= rs.getTimestamp("order_date") %> 
                </td> 
 
 
                <td> 
                    <%= rs.getString("product") %> 
                </td> 
 
 
                <td> 
                    <%= rs.getInt("quantity") %> 
                </td> 
 
 
                <td> 
                    <%= rs.getString("payment_method") %> 
                </td> 
 
 
                <td class="price"> 
 
                    ₹<%= rs.getBigDecimal("price") %> 
 
                </td> 
 
            </tr> 
 
 
<% 
 
    } 
 
 
 
    if (!hasOrders) { 
 
 
%> 
 
            <tr> 
 
                <td colspan="7" 
                    class="no-orders"> 
 
                    No orders found in database. 
 
                </td> 
 
            </tr> 
 
 
<% 
 
    } 
 
 
} catch (Exception e) { 
 
 
%> 
 
            <tr> 
 
                <td colspan="7" 
                    style="color:red; padding:20px;"> 
 
                    Database Error: 
                    <%= e.getMessage() %> 
 
                </td> 
 
            </tr> 
 
 
<% 
 
} finally { 
 
    try { 
 
        if (rs != null) 
            rs.close(); 
 
    } catch (Exception e) {} 
 
 
    try { 
 
        if (selectPS != null) 
            selectPS.close(); 
 
    } catch (Exception e) {} 
 
} 
 
 
%> 
 
        </tbody> 
 
 
    </table> 
 
 
</div> 
 
 
<a href="index.html" 
   class="back-button"> 
 
    ← Back to Home 
 
</a> 
</div> 
<% 
try { 
if (con != null) 
con.close(); 
} catch (Exception e) {} 
%> 
</body> </html>