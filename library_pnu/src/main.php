<?php
session_start();
$user_number = $_SESSION['user_number'];
$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="utf-8">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>부산대학교 도서관</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    $(document).ready(function(){
        $('#contentFrame').attr('src','./BookSearch/bookSearch.php');
        $('#bookSearch').click(function(){
            $('#contentFrame').attr('src','./BookSearch/bookSearch.php');
        });
        $('#borrowedBookCheck').click(function(){
            $('#contentFrame').attr('src','./BorrowedBookCheck/borrowedBookCheck.php');
        });
        $('#studyRoomReservationCheck').click(function(){
            $('#contentFrame').attr('src','./studyRoom/studyRoomReservationCheck.php');
        });
        $('#studyRoomReserve').click(function(){
            $('#contentFrame').attr('src','./studyRoom/studyRoomList.php');
        });
        $('#ReadingRoom_extension').click(function(){
            $('#contentFrame').attr('src','./ReadingRoom/ReadingRoom_extension.php');
        });
        $('#ReadingRoom_state').click(function(){
            $('#contentFrame').attr('src','./ReadingRoom/ReadingRoom_state.php');
        });
        $('#questionBoard').click(function(){
            $('#contentFrame').attr('src','./QuestionBoard/index.php');
        });
        $('#doseogwanri').click(function(){
            $('#contentFrame').attr('src','./doseogwanri/doseogwanri.php');
        });
    });    
    </script>
    <style>
        @import url(//fonts.googleapis.com/earlyaccess/jejugothic.css);
        body { font-family: 'Jeju Gothic'; }
    </style>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="main.php" class="logo"><b>부산대학교 도서관</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
 
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <?php
                if($user_number != ""){
                ?>
                <ul class="nav pull-right top-menu">
            	    <li><a class="logout" href="./logout.php">Logout</a></li>
            	</ul>
            	<?php
                }else{
                ?>
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="./login.php">Login</a></li>
            	</ul>
            	<?php
                }
                ?>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <!--<p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>-->
              	  <p class="centered"><img src="assets/img/user.png" class="img-circle" width="60"></a></p>
              	<?php
                    if(isset($_SESSION['user_number']) || isset($_SESSION['user_name'])) {
                ?>
              	  <h5 class="centered"><?=$user_name?></h5>
              	<?php
                    }else{
                ?>
                    <h5 class="centered">로그인 필요</h5>
                <?php
                    }
                ?>
                  <li class="mt">
                      <a id="bookSearch" href="#">
                          <i class="fa fa-dashboard"></i>
                          <span>도서검색</span>
                      </a>
                  </li>
                  <li>
                      <a id="borrowedBookCheck" href="#">
                          <i class="fa fa-check"></i>
                          <span>대출도서조회</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>스터디룸</span>
                      </a>
                      <ul class="sub">
                          <li><a id="studyRoomReservationCheck" href="#">스터디룸 예약 조회</a></li>
                          <li><a id="studyRoomReserve" href="#">스터디룸 예약</a></li>
                      </ul>
                  </li>

          
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>열람실 좌석</span>
                      </a>
                      <ul class="sub">
                          <li><a id="ReadingRoom_extension" href="#">열람실 좌석 연장</a></li>
                          <li><a id="ReadingRoom_state" href="#">열람실 좌석 조회</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a id = "questionBoard" href="#">
                          <i class="fa fa-tasks"></i>
                          <span>Q&A</span>
                      </a>
                      
                  </li>
                  
                  <?php
                  if($user_number== 'root')
                  {
                      echo "<li class='sub-menu'>
                            <a href='javascript:;' >
                            <i class='fa fa-th'></i>
                            <span>관리자</span>
                            </a>
                            <ul class='sub'>
                            <li><a id = 'doseogwanri' href='#'>도서관리</a></li>
                            </ul>
                            </li>";
                  }
                  else
                  {
                  }
                  ?>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
            <!--<img src="assets/img/ny.jpg" class="img-circle" max-width=100% width=auto height=auto></a>-->
          	<iframe id="contentFrame" src="" marginwidth="0" frameborder="0" max-width="100%" width=100% height=1000 scrolling="auto">
          	</iframe>
          	
          	
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2017 - team 2

          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

    //   $(function(){
    //       $('select.styled').customSelect();
    //   });

  </script>

  </body>
</html>
