<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit sale</title>
    <link rel="stylesheet" href="styles/headerfooter.css"/>
    
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

<h3>Sell Your Land</h3>
   
   <form  method="post" action="saleform.php"><!--clicking submit executes saleform.php-->

       <!--//Form to input details-->
       <fieldset>

           <p>Title: 
               <input type="text" id="stitle"  name="stitle" required >
           </p>
           <p>Location: 
               <input type="text" id="slocation" name="slocation" required >
            </p>
           <p>Description : 
               <br><textarea type="text" name="sdescript" id="sdescript" rows="7" cols="50"required></textarea>
            </p>
           <p>City : 
               <input type="text" id="scity"  name="scity"required>
            </p>
           <p>District : 
               <input type="text" id="sdistrict"  name="sdistrict" required>
            </p>
           <p>Province : 
               <input type="text" id="sprovince"  name="sprovince"required >
            </p>
           <p>Price : 
               <input type="text" id="sprice"  name="sprice" required> Rs.
            </p>
           <p>Landa Area : 
               <input type="text" id="slandarea"  name="slandarea"required > Perch
             </p>
           <p>Address:
               <input type="text" id=" saddress" name="saddress" required>
            </p>
           <p>Upload photo : <input type="file" name="sphoto" id="sphoto" >

       </fieldset>
       <br>
       <input type="submit" value="Submit"  name="submit" >
   </form>


    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>