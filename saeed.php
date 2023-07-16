

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Coda+Caption:800|Pacifico|Hind|Anton|Chewy|Bangers|Montserrat:400,700' rel='stylesheet' type='text/css'>
  <style>
  
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
  </style>
       <div class="container">
	<div class="row">
        <hr>
        <div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="/page.html">
                Main Menu <span class="caret"></span>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="#">Add New Student</a></li>
              <li class="divider"></li>
              <li class="dropdown-submenu">
                <a tabindex="-1" href="#">Subjects</a>
                <ul class="dropdown-menu">
                  <li><a tabindex="-1" href="#">Maths</a></li>
                  <li class="dropdown-submenu">
                    <a href="#">Science</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Physics</a></li>
                    	<li><a href="#">Chemistry</a></li>
                    </ul>
                  </li>
               
                </ul>
              </li>
            </ul>
        </div>
	</div>
</div>