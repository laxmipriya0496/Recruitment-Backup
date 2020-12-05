<!DOCTYPE html>
<html>
<style>

body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    text-align:center;
}



.sidenav a:hover{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <?php include '../sidenav.php';?>
</div>
<div class="head_breadcrumb" style="position: absolute;width: 100%;top: 45px;border-bottom: 1px solid #333;box-shadow: 0px 0px 4px 0px;">
<span style="font-size: 25px;padding: 0px 10px;cursor:pointer;color:#179b77;float:right;" onclick="openNav()">&#9776; Menu</span>

</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";    
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";    
}
</script>
     
</body>

</html> 
