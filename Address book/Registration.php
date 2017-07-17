<!DOCTYPE html>

<?php
session_start();
$con = mysqli_connect("localhost","root","","php");
?>

<html>
        <head>
        <title> Registration Form</title>
        </head>


        <style>
        body{
            padding:0;
            margin:0;
            background:skyblue;
        }

        table{
            color:white;
            padding:10px;
            width:400px;
        }
        input{
            padding:5px;
        }

        </style>








<body>

    <form action="Registration.php" method="post" enctype="multipart/form-data">

    <table align="center" bgcolor="gray" width="600">

        <tr align="center">
            <td colspan="8"><h2>New Users ? Register Here</h2></td>
        </tr>


             <tr>

                 <td align="right" > <strong>Full Name:</strong></td>
    
                     <td>
                         <input type="text" name="user_full_name" placeholder="Enter your Full Name" required="required"/>
    
                     </td>
    
            </tr>



              <tr>

                 <td align="right" > <strong>Nick Name:</strong></td>
    
                     <td>
                         <input type="text" name="user_nick_name" placeholder="Enter your nick Name" />
    
                     </td>
    
            </tr>



              <tr>

                 <td align="right" > <strong>Password:</strong></td>
    
                     <td>
                         <input type="password" name="user_pass" placeholder="Enter your pass" required="required"/>
    
                     </td>
    
            </tr>

              <tr>

                 <td align="right" > <strong>Email:</strong></td>
    
                     <td>
                         <input type="text" name="user_email" placeholder="Enter your email" required="required"/>
    
                     </td>
    
            </tr>

              <tr>

                 <td align="right" > <strong>Country:</strong></td>
    
                     <td>
                        <select name = "user_country">
                            <option>Select a Country</option>
                            <option>Bangladesh</option>
                            <option>USA</option>
                            <option>UK</option>
                            <option>Australia</option>

                        </select>
    
                     </td>
    
            </tr>

              <tr>

                 <td align="right" > <strong>Phone No:</strong></td>
    
                     <td>
                         <input type="text" name="user_no" placeholder="Enter your phone no" required="required"/>
    
                     </td>
    
            </tr>

              <tr>

                 <td align="right" > <strong>Address:</strong></td>
    
                     <td>
                         <textarea name="user_address" cols="20" rows="5" ></textarea>
    
                     </td>
    
            </tr>

            <tr>

            <td align="right" > <strong>Gender:</strong></td>
    
                     <td>
                        Male: <input type="radio" name="user_gender" value="Male"/>
                        Female: <input type="radio" name="user_gender" value="Female"/>
                     </td>
    
            </tr>


              <tr>

                 <td align="right" > <strong>Birthday:</strong></td>
    
                     <td>
                         <input type="date" name="b_day" required="required"/>
    
                     </td>
    
            </tr>




            
              <tr>

                 <td align="right" > <strong>Image:</strong></td>
    
                     <td>
                         <input type="file" name="user_image" required="required"/>
    
                     </td>
    
            </tr>




            <tr align="center" >

                <td>
                <input type="submit" name="register" value="Register Now"/>
                
                </td>
            </tr>




    
    </table>
    
    </form>

<h3>
<center>
Already Registered? <a href = "Login.php">Login Here</a>
</center>
</h3>


<?php
if(isset($_POST['register'])){


$user_full_name = mysqli_real_string($con,$_POST['user_full_name']);
$user_nick_name =mysqli_real_string($con, $_POST['user_nick_name']);
$user_pass =mysqli_real_string($con, $_POST['user_pass']);
$user_email =mysqli_real_string($con, $_POST['user_email']);
$user_country =mysqli_real_string($con, $_POST['user_country']);
$user_no =mysqli_real_string($con, $_POST['user_no']);
$user_address =mysqli_real_string($con, $_POST['user_address']);
$user_gender =mysqli_real_string($con, $_POST['user_gender']);
$user_b_day =mysqli_real_string($con, $_POST['b_day']);

$user_image = $_FILES['user_image']['name'];
$user_tmp= $_FILES['user_image']['tmp_name'];


if($user_address=='' OR $user_country=='' OR $user_image=='' OR $user_gender==''){

echo "<script>alert('Please fill all the fields!')</script>";
exit();
}

if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)){

echo"<script>alert('Your email is not valid!')</script>";
exit();
}

if(strlen($user_pass)<8){
echo"<script>alert('Please select a password of 8 letters minimum!')</script>";
exit();

}

$sel_email = "select * from register_user where user_email='$user_email'";
$run_email = mysqli_query($con,$sel_email);

$check_email = mysqli_num_rows($run_email);

if($check_email==1) {
    echo"<script>alert('This email is already registered, try another one!')</script>";
exit();
}

else{
$_SESSION{'user_email'}=$user_email;

move_uploaded_file($user_tmp,"images/$user_image");
$insert = "insert into register_user(user_full_name,user_nick_name,user_pass,user_email ,user_country,user_no,user_address,user_gender ,b_day,user_image)
values('$user_full_name','$user_nick_name','$user_pass','$user_email ','$user_country','$user_no','$user_address ','$user_gender ','$user_b_day ','$user_image ',) ";

$run_insert = mysqli_query($con,$insert);

if($run_insert){
echo "<script>alert('Registration successful')</script>";
echo "<script>window.open('home.php','_self')</script>";

}

}



}


?>









</body>


</html>