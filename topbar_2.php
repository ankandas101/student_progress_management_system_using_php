<head>
    <title> Student Progress Managment System</title>
</head>
<body>
<div class="header">
    <div class="inner_header">

        <lable class="top-title"> <a href="./index.php"> Student Progress Managment System </a></lable>
   

      <ul class="navigation">
            <a href="./index.php"><li>Home</li></a>
            <a href="./about.php"><li>About</li></a>
            <a href="contact_team.php" target="_self"><li>Contact</li></a>
        </ul>
    </div>
</div>
<style>
    *{
        margin: 0;
    }
.inner_header ul{
    display: inline-block;
    margin: auto;
}
.header{
width: 100%;
height: 60px;
display: block;
background-color: #101010;
}

.inner_header{
width: 1000px;
height: 100%;
display: block;
margin: auto;
}


.navigation{
    float: right;
    height: 100%;

}

.navigation a{
    height: 100%;
    display: table;
    float: left;
    padding: 0px 20px;
}
.navigation a:hover{
    background-color: #FF0000;

}
.navigation a:last-child{
padding-right: 0;
}

.navigation a li{
    display: table-cell;
    vertical-align: middle;
    height: 100%;
    color: white;
    font-family: monospace;
    font-size: 16px;

}
.top-title a{
    font-size: 20px;
    color: white;
    display: inline-block;
    margin-top: 13px;
    text-decoration: none;
}
</style>