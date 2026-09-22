<%@page contentType="text/html" pageEncoding="UTF-8"%> 
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width,initial-scale=1.0"> 
<title>Registration Details</title> 
<style> 
*{box-sizing:border-box;margin:0;padding:0} 
body{font-family:Arial;background:linear-gradient(135deg,#667eea,#764ba2);min
height:100vh;display:flex;justify-content:center;align-items:center;padding:30px} 
.card{background:white;width:100%;max-width:650px;padding:35px;border-radius:18px;box
shadow:0 15px 40px rgba(0,0,0,.25)} 
.success{text-align:center;margin-bottom:25px} 
.icon{width:55px;height:55px;background:#2ecc71;color:white;border
radius:50%;display:flex;justify-content:center;align-items:center;font-size:30px;margin:0 auto 
15px} 
h1{color:#333;margin-bottom:8px}.success p{color:#777} 
.details{border:1px solid #eee;border-radius:10px;overflow:hidden} 
.row{display:flex;padding:15px 18px;border-bottom:1px solid #eee} 
.row:last-child{border-bottom:0} 
.label{width:40%;font-weight:bold;color:#555} 
.value{width:60%;color:#333;word-break:break-word} 
.back{display:block;text-align:center;margin-top:25px;padding:13px;background:linear
gradient(135deg,#667eea,#764ba2);color:white;text-decoration:none;border-radius:8px;font
weight:bold} 
@media(max-width:600px){.card{padding:25px 
20px}.row{display:block}.label,.value{width:100%}.value{margin-top:5px}} 
</style> 
</head> 
<body> 
<% 
String username=request.getParameter("username"); 
String password=request.getParameter("password"); 
String name=request.getParameter("name"); 
String creditcardno=request.getParameter("creditcardno"); 
String email=request.getParameter("email"); 
String phoneno=request.getParameter("phoneno"); 
String dob=request.getParameter("dob"); 
String gender=request.getParameter("gender"); 
String address=request.getParameter("address"); 
String city=request.getParameter("city"); 
String state=request.getParameter("state"); 
String pincode=request.getParameter("pincode"); 
%> 
<div class="card"> 
<div class="success"> 
<div class="icon">✓</div> 
<h1>Registration Successful</h1> 
<p>User registration details</p> 
</div> 
<div class="details"> 
<div class="row"><div class="label">Username</div><div 
class="value"><%=username%></div></div> 
<div class="row"><div class="label">Password</div><div 
class="value"><%=password%></div></div> 
<div class="row"><div class="label">Full Name</div><div 
class="value"><%=name%></div></div> 
<div class="row"><div class="label">Credit Card No</div><div 
class="value"><%=creditcardno%></div></div> 
<div class="row"><div class="label">Email</div><div class="value"><%=email%></div></div> 
<div class="row"><div class="label">Phone Number</div><div <div class="row"><div 
class="label">Date of Birth</div><div class="value"><%=dob%></div></div> 
<div class="row"><div class="label">Gender</div><div 
class="value"><%=gender%></div></div> 
<div class="row"><div class="label">Address</div><div 
class="value"><%=address%></div></div> 
<div class="row"><div class="label">City</div><div class="value"><%=city%></div></div> 
<div class="row"><div class="label">State</div><div class="value"><%=state%></div></div> 
<div class="row"><div class="label">Pincode</div><div 
class="value"><%=pincode%></div></div> 
</div> 
<a href="index.html" class="back">← Register Another User</a> 
</div> 
</body> 
</html>