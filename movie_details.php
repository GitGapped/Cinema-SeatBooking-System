<?php
session_start(); 

if(isset($_SESSION['username']))
{
    if($_SESSION['type'] == 1)
    {
        include("header_user.php");
    }   
    else
    {
        include("header_admin.php");    
    }
            
}
else {
   include("header.php");
}

include("connection.php");//connect with database


$qryCarousel = mysqli_query($cinema, "SELECT * FROM movies");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Movie List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa; /* Set a light background color */
      font-family: Arial, sans-serif;
      margin: 0; /* Remove default margin */
       
    }

    

    .container {
      max-width: 900px; /* Adjust the maximum width to your preference */
      margin: auto;
      padding: 20px;
      
    }

    

    /* Style for Movies */
    .movie {
        margin-top: 10%;
      max-width: 90%;
      margin-bottom: 20px;
       /* Set a fixed height for the movie container */
      transition: transform 0.2s ease-in-out; /* Add a subtle transition effect */
      display: flex;
      flex-direction: column;
      overflow: hidden;
      border-radius: 10px; /* Add a border-radius for rounded corners */
    }

    .movie:hover {
      transform: scale(1.05); /* Enlarge the movie container on hover */
    }
    .movie a:hover {
    text-decoration: none; /* Remove underline on hover for movie links */
}

    .movie a {
      display: block;
      text-decoration: none;
    }

    .movie img {
      width: 100%;
      height: 400px; /* Adjust the height to your preference */
      object-fit: cover; /* Ensure images cover the entire container */
    }

    .movie-info {
      padding: 15px;
      text-align: center;
    }

    .movie-title {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .btn-primary {
      width: 100%;
    }
    h2 {
      text-align: center;
      padding-top:12vh;
    }
    
  </style>
</head>
<body>



<div class="container">
    <h2>Now Playing</h2>
  <div class="row">
      
    <?php
    // Reset the query pointer to start from the beginning
    mysqli_data_seek($qryCarousel, 0);
    while ($movie = mysqli_fetch_array($qryCarousel)) {
      $movieImage = "img/" . $movie['movie_image'];
    ?>
      
      <div class="col-12 col-sm-6 col-md-4">
        <div class="movie">
            
          <!-- Wrap the entire movie container with a link -->
          <a href="book_film.php?movie_id=<?php echo $movie['movie_id']; ?>">
            <img src="<?php echo $movieImage; ?>" alt="Movie Image">
            <div class="movie-info">
              <h5 class="movie-title"><?php echo $movie['movie_title']; ?></h5>
            </div>
          </a>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>

</body>
</html>

    <?php include 'footer.php'; ?>



<style>
@media only screen and (max-width: 767px) {
    .movie {
         margin-top: 10%;
      max-width: 90%;
      margin-bottom: 20px;
       /* Set a fixed height for the movie container */
      transition: transform 0.2s ease-in-out; /* Add a subtle transition effect */
      display: flex;
      flex-direction: column;
      overflow: hidden;
      border-radius: 10px; /* Add a border-radius for rounded corners */
    }

    .movie img {
        height: 100%; /* Maintain aspect ratio */
         width: 100%;
      height: 400px; /* Adjust the height to your preference */
      object-fit: cover; /* Ensure images cover the entire container */
    }
}

  </style>



<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
also trying to make all the movies appear and not just one of them
-->

<!--<style type="text/css">
    html,
body,
div,
span,
applet,
object,
iframe,
h1,
h2,
h3,
h4,
h5,
h6,
p,
blockquote,
pre,
a,
abbr,
acronym,
address,
big,
cite,
code,
del,
dfn,
em,
img,
ins,
kbd,
q,
s,
samp,
small,
strike,
strong,
sub,
sup,
tt,
var,
b,
u,
i,
dl,
dt,
dd,
ol,
nav ul,
nav li,
fieldset,
form,
label,
legend,
table,
caption,
tbody,
tfoot,
thead,
tr,
th,
td,
article,
aside,
canvas,
details,
embed,
figure,
figcaption,
footer,
header,
hgroup,
menu,
nav,
output,
ruby,
section,
summary,
time,
mark,
audio,
video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
  font-family: "Roboto Condensed", sans-serif;
}
article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
menu,
nav,
section {
  display: block;
}
ol,
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
blockquote,
q {
  quotes: none;
}
blockquote:before,
blockquote:after,
q:before,
q:after {
  content: "";
  content: none;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}
/* start editing from here */
a {
  text-decoration: none;
}
.txt-rt {
  text-align: right;
} /* text align right */
.txt-lt {
  text-align: left;
} /* text align left */
.txt-center {
  text-align: center;
} /* text align center */
.float-rt {
  float: right;
} /* float right */
.float-lt {
  float: left;
} /* float left */
.clear {
  clear: both;
} /* clear float */
.pos-relative {
  position: relative;
} /* Position Relative */
.pos-absolute {
  position: absolute;
} /* Position Absolute */
.vertical-base {
  vertical-align: baseline;
} /* vertical align baseline */
.vertical-top {
  vertical-align: top;
} /* vertical align top */
.underline {
  padding-bottom: 5px;
  border-bottom: 1px solid #eee;
  margin: 0 0 20px 0;
} /* Add 5px bottom padding and a underline */
nav.vertical ul li {
  display: block;
} /* vertical menu */
nav.horizontal ul li {
  display: inline-block;
} /* horizontal menu */
img {
  max-width: 100%;
}
/*end reset*/
@font-face {
  font-family: "AmbleRegular";
  src: url(../fonts/Amble-Light-webfont.ttf) format("truetype");
}
body {
  font-family: "AmbleRegular";
  background: #fff;
}
.header {
  background: url(../images/hd-bg.png);
}
.header-top {
  border-bottom: 2px ridge #333;
}
.wrap {
  width: 80%;
  margin: 0 auto;
}
.banner-no {
  float: left;
}
/*--menu--*/
header {
  padding: 100px 0 0 0;
  display: block;
}
header h1 {
  width: 960px;
  margin: 0 auto;
}
a:hover {
  color: white;
}
.nav-wrap {
  float: right;
  width: 67%;
  margin: 50px auto;
}
.nav-wrap ul {
  float: right;
}
/* Clearfix */
.group:after {
  visibility: hidden;
  display: block;
  content: "";
  clear: both;
  height: 0;
}
*:first-child + html .group {
  zoom: 1;
}
/* Example One */
#example-one {
  margin: 0 auto;
  list-style: none;
  position: relative;
}
#example-one li {
  display: inline-block;
  margin-right: 20px;
}
#example-one a {
  color: #aaa;
  font-size: 16px;
  float: left;
  padding: 6px 10px 4px 10px;
  text-decoration: none;
  text-transform: uppercase;
}
#example-one a:hover {
  color: #db9603;
}
#magic-line {
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 10px;
  height: 2px;
  background: #db9603;
}
.ie6 #example-one li,
.ie7 #example-one li {
  display: inline;
}
.ie6 #magic-line {
  bottom: -3px;
}
.h-logo {
  float: left;
}
/*--banner--*/
.main img {
  display: block;
}
.block {
  margin-top: 20px;
}
#reservation-form {
  float: right;
  margin-top: 6px;
}
#reservation-form .field {
  float: left;
}
#reservation-form .field1 {
  float: left;
}
#reservation-form .field {
  display: block;
  height: 20px;
  font-size: 13px;
  color: #fac9a9;
  margin-bottom: 10px;
}
#reservation-form select {
  border: 1px solid #5d3825;
  background: #db9603;
  color: #fff;
  outline: none;
  padding: 5px;
  float: left;
}
#reservation-form select.select1 {
  width: 200px;
  margin-right: 10px;
}
#reservation-form select.select2 {
  width: 200px;
  margin-right: 10px;
}
#reservation-form label {
  display: block;
  padding-bottom: 4px;
  font-size: 13px;
  color: #aaa;
}
/*--Content--*/
.content {
  background: #fff;
  padding: 20px 0;
}
/*  GRID OF THREE   ============================================================================= */
.listview_1_of_3 {
  display: block;
  float: left;
  margin: 0% 0 0% 1.6%;
}
.listview_1_of_3 h3 {
  color: #fcac03;
  font-size: 2em;
  margin-bottom: 5%;
}
.extra-wrap {
  overflow: hidden;
}
.data {
  color: #989898;
  margin-bottom: 1px;
}
.color {
  color: #1344b0;
  text-decoration: underline;
  line-height: 1.8em;
  font-size: 13px;
}
a:hover {
  text-decoration: none;
  color: #1344b0;
}
.text-top {
  padding-top: 6px;
  display: inline-block;
  font-size: 13px;
  line-height: 1.8em;
  color: #888;
}
.listimg {
  display: block;
  float: left;
}
.listimg1 {
  width: 47%;
  float: left;
  margin-right: 6%;
}
.listimg1 img,
.listimg2 img {
  margin-bottom: 3%;
}
.listimg2 {
  width: 47%;
  float: left;
  margin-right: 0;
}
.link {
  font-size: 12px;
  line-height: 20px;
  color: #313131;
  font-weight: bold;
  text-decoration: underline;
  line-height: 1.8em;
}
.link:hover {
  text-decoration: none;
  color: #313131;
}
.link2 {
  font-size: 14px;
  line-height: 20px;
  color: #fcac03;
  font-weight: bold;
  background: url(../images/s-icon.png) 55px 6px no-repeat;
  padding-right: 15px;
  display: inline-block;
  margin-bottom: 10%;
}
.link2:hover {
  text-decoration: underline;
  color: #fcac03;
}
.middle-list {
  margin-bottom: 5%;
}
.text {
  display: block;
  float: left;
  margin: 0% 0 7% 3.6%;
}
.listview_1_of_3:first-child {
  margin-left: 0;
}

.images_1_of_3 {
  width: 29.2%;
  padding: 1.5%;
}
.listimg_1_of_2 {
  width: 28.2%;
}
.list_1_of_2 {
  width: 68.2%;
}
.images_1_of_3 img {
  max-width: 100%;
  display: block;
}
.list_1_of_2 h3 {
  color: #c94848;
  margin-bottom: 0.2em;
  margin-top: 0;
  font-size: 1em;
  font-family: MuseoSlab300, "lucida sans unicode", "lucida grande",
    "Trebuchet MS", verdana, arial, helvetica, helve, sans-serif;
  font-weight: normal;
  letter-spacing: -1px;
}
.list_1_of_2 p {
  font-size: 0.8125em;
  color: #333;
  line-height: 1.5em;
  font-family: verdana, arial, helvetica, helve, sans-serif;
  padding: 0;
}
/***** Media Quries *****/
@media only screen and (max-width: 1024px) {
  .wrap {
    width: 90%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 640 PIXELS */
@media only screen and (max-width: 640px) {
  .wrap {
    width: 95%;
  }
  .listview_1_of_3 {
    margin: 2% 0 2% 0%;
  }
  .text {
    margin: 0;
  }
  .images_1_of_3 {
    width: 94%;
    padding: 3%;
  }
  .listimg_1_of_2 {
    width: 100%;
  }
  .list_1_of_2 {
    width: 100%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 480 PIXELS */
@media only screen and (max-width: 480px) {
  .wrap {
    width: 95%;
  }
  .listview_1_of_3 {
    margin: 2% 0 2% 0%;
  }
  .text {
    margin: 0;
  }
  .images_1_of_3 {
    width: 92%;
    padding: 4%;
  }
  .listimg_1_of_2 {
    width: 100%;
  }
  .list_1_of_2 {
    width: 100%;
  }
}
p.s-img a:hover {
  opacity: 0.5;
}
.link4 {
  font-weight: bold;
  color: #e3480b;
  display: inline-block;
  font-size: 13px;
  margin-bottom: 4%;
  text-decoration: underline;
}
.link4:hover {
  text-decoration: none;
  color: #e3480b;
}
.color1 {
  color: #989898;
  font-size: 13px;
}
.link-top {
  margin-top: 11px;
  display: inline-block;
}
.color2 {
  text-decoration: underline;
  font-size: 13px;
  line-height: 1.8em;
  color: #1344b0;
}
/*--Footer--*/
.footer {
  background: #222;
}
.footer-top {
  padding: 20px 0;
}
/*  GRID OF FOUR   ============================================================================= */
.col_1_of_4 {
  display: block;
  float: left;
}
.col_1_of_4:first-child {
  margin-left: 0;
}
.span_1_of_4 {
  width: 22%;
  padding: 1.5%;
}
.social img:hover {
  opacity: 0.7;
}
.span_1_of_4 p {
  font-size: 0.8125em;
  color: #666;
  line-height: 1.8em;
}
p.txt_4 {
  color: #666;
  margin-top: 2%;
  font-size: 2em;
}
.content-top h3 {
  color: #fcac03;
  font-size: 2em;
  padding: 1.5%;
}
/***** Media Quries *****/
@media only screen and (max-width: 1024px) {
  .wrap {
    width: 95%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 640 PIXELS */
@media only screen and (max-width: 640px) and (min-width: 480px) {
  .wrap {
    width: 95%;
  }
  .col_1_of_4 {
    margin: 1% 0 1% 0%;
  }
  .span_1_of_4 {
    width: 94%;
    padding: 3%;
  }
}

/*  GO FULL WIDTH AT LESS THAN 480 PIXELS */
@media only screen and (max-width: 480px) {
  .wrap {
    width: 95%;
  }
  .col_1_of_4 {
    margin: 1% 0 1% 0%;
  }
  .span_1_of_4 {
    width: 92%;
    padding: 4%;
  }
}
.footer-nav li {
  list-style-image: url(../images/f-icon.png);
  margin: 0 0 5px 20px;
}
.footer-nav li a {
  font-size: 13px;
  color: #666;
  vertical-align: top;
  line-height: 21px;
}
.footer-nav li a:hover {
  color: #888;
}
.footer-bottom {
  background: #111;
  padding: 20px;
}
.copy {
  text-align: center;
}
.copy p {
  color: #666;
  font-size: 13px;
}
.copy p a {
  color: #fcac03;
}
.copy p a:hover {
  text-decoration: underline;
}
/*--About--*/
/*  GRID OF Content With Image and Sidebar   ============================================================================= */
.about {
  display: block;
  float: left;
}
.rightsidebar {
  display: block;
  float: left;
  margin: 0% 0 0% 1.6%;
}
.about:first-child {
  margin-left: 0;
}
.desc {
  display: block;
  float: left;
  margin: 0% 0 0% 2.6%;
}
.span_1_of_2 {
  width: 67.1%;
  padding: 1.5%;
}
.images_3_of_2 {
  width: 45.2%;
  float: left;
}
.span_3_of_2 {
  width: 52.2%;
}
.span_3_of_1 {
  width: 25.2%;
  padding: 1.5%;
}
.images_3_of_2 img {
  max-width: 100%;
  display: block;
}
.span_3_of_2 h3 {
  color: #c94848;
  margin-bottom: 0.3em;
  font-size: 1.5em;
  font-weight: normal;
  margin-top: 0px;
  letter-spacing: -1px;
}
.span_3_of_2 p {
  font-size: 0.8125em;
  padding: 0.3em 0;
  color: #888;
  line-height: 1.8em;
}
.span_3_of_1 p {
  font-size: 0.8125em;
  padding: 0.42em 0;
  color: #333;
  line-height: 1.6em;
}
/***** Media Quries *****/
@media only screen and (max-width: 1024px) {
  .wrap {
    width: 90%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 640 PIXELS */
@media only screen and (max-width: 640px) {
  .wrap {
    width: 95%;
  }
  .grid {
    margin: 0;
  }
  .about {
    margin: 2% 0 2% 0%;
  }
  .rightsidebar {
    margin: 0;
  }
  .image {
    padding: 3%;
  }
  .desc {
    margin: 0;
  }
  .span_1_of_2 {
    width: 94%;
    padding: 3%;
  }
  .span_3_of_2 {
    width: 100%;
  }
  .images_3_of_2 {
    width: 100%;
  }
  .span_3_of_1 {
    width: 94%;
    padding: 3%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 480 PIXELS */
@media only screen and (max-width: 480px) {
  .wrap {
    width: 95%;
  }
  .about {
    margin: 2% 0 2% 0%;
  }
  .rightsidebar {
    margin: 0;
  }
  .grid {
    margin: 0;
  }
  .image {
    padding: 4%;
  }
  .desc {
    margin: 0;
  }
  .span_1_of_2 {
    width: 92%;
    padding: 4%;
  }
  .span_3_of_2 {
    width: 100%;
  }
  .images_3_of_2 {
    width: 100%;
  }
  .span_3_of_1 {
    width: 92%;
    padding: 4%;
  }
}
.watch_but {
  display: inline-block;
  background: #db9603;
  position: relative;
  border-radius: 2px;
  font-size: 13px;
  line-height: 11px;
  color: #fff;
  border-bottom: 1px solid #db9603;
  border-right: 1px solid #db9603;
  margin: 15px 0 0;
  padding: 12px 14px 9px 10px;
}
.span_3_of_2 h4 {
  color: #888;
  font-size: 1.5em;
  margin-bottom: 2%;
}
.link1 {
  color: #1344b0;
  text-decoration: underline;
  font-size: 13px;
  margin-bottom: 2%;
}
.about-top {
  margin-bottom: 5%;
}
.small_box {
  margin-bottom: 11px;
}
.premier .col {
  float: left;
  width: 30%;
  margin-left: 3.3%;
}
a {
  color: #888;
  font-size: 13px;
  line-height: 1.5em;
}
.button {
  display: inline-block;
  background: #db9603;
  position: relative;
  border-radius: 2px;
  font-size: 13px;
  line-height: 11px;
  color: #fff;
  border-bottom: 1px solid #db9603;
  border-right: 1px solid #db9603;
  margin: 20px 0;
  padding: 12px 14px 9px 10px;
}
.latest_news {
  margin: -1px 5px 0 -1px;
}
.latest_news li {
  margin-bottom: 18px;
}
.date {
  background: #f0f0f0;
  color: #888;
  margin: 0 1px 10px 0;
  display: inline-block;
  border-radius: 2px;
  padding: 5px;
}
.span_3_of_1 h3 {
  color: #fcac03;
  font-size: 1.5em;
  margin-bottom: 9%;
  background: #f0f0f0;
  padding: 8px;
}
.span_1_of_2 h3 {
  color: #fcac03;
  font-size: 1.5em;
  margin-bottom: 4%;
  background: #f0f0f0;
  padding: 8px;
}
li.m_bottom {
  margin-bottom: 0px;
}
h4.h-text a {
  color: #db9603;
  font-size: 1.2em;
}
h4.h-text a:hover {
  color: #888;
}
/*--404 page--*/
.pnot {
  padding: 30px 0;
}
.pnot h1 {
  font-size: 15em;
  color: #f0f0f0;
  text-align: center;
  text-shadow: 1px 1px 6px #555;
  -moz-text-shadow: 1px 1px 6px #555;
  -webkit-text-shadow: 1px 1px 6px #555;
  -o-text-shadow: 1px 1px 6px #555;
}
/*--Contact--*/
/*  Contact Form  ============================================================================= */
.col {
  display: block;
  float: left;
  margin: 1% 0 1% 1.6%;
}
.col:first-child {
  margin-left: 0;
}
.span_2_of_3 {
  width: 63.1%;
  padding: 1.5%;
}
.span_1_of_3 {
  width: 29.2%;
  padding: 1.5%;
}
.span_2_of_3 h3,
.span_1_of_3 h3 {
  color: #fcac03;
  margin-bottom: 0.5em;
  font-size: 1.5em;
  line-height: 1.2;
  font-weight: normal;
  margin-top: 0px;
  letter-spacing: -1px;
}
.contact-form {
  position: relative;
  padding-bottom: 30px;
}
.contact-form div {
  padding: 5px 0;
}
.contact-form span {
  display: block;
  font-size: 0.8125em;
  color: #333;
  padding-bottom: 5px;
}
.contact-form input[type="text"],
.contact-form textarea {
  padding: 8px;
  display: block;
  width: 98%;
  background: #fcfcfc;
  border: none;
  outline: none;
  color: #464646;
  font-size: 0.8125em;
  font-family: Arial, Helvetica, sans-serif;
  box-shadow: inset 0px 0px 3px #999;
  -webkit-box-shadow: inset 0px 0px 3px #999;
  -moz-box-shadow: inset 0px 0px 3px #999;
  -o-box-shadow: inset 0px 0px 3px #999;
  -webkit-appearance: none;
}
.contact-form textarea {
  resize: none;
  height: 120px;
}
.contact-form input[type="submit"] {
  padding: 7px 20px;
  color: #fff;
  cursor: pointer;
  background: #db9603 url(../images/large-button-overlay.png);
  border: 1px solid rgba(0, 0, 0, 0.25);
  text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.25);
  -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
  -webkit-border-radius: 5px;
  border-radius: 2px;
  position: absolute;
  right: 0;
}
.contact-form input[type="submit"]:hover {
  background-color: #111;
}
.contact-form input[type="submit"]:active {
  background-color: #db9603;
}
.company_address {
  padding-top: 26px;
}
.company_address p {
  font-size: 0.8125em;
  color: #888;
  line-height: 1.8em;
}
.company_address p span {
  text-decoration: underline;
  color: #333;
  cursor: pointer;
}
.map {
  border: 1px solid #c7c7c7;
  margin-bottom: 15px;
}

/***** Media Quries *****/
@media only screen and (max-width: 1024px) {
  .wrap {
    width: 95%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 800 PIXELS */

@media only screen and (max-width: 800px) {
  .wrap {
    width: 95%;
  }
  .span_2_of_3 {
    width: 94%;
    padding: 3%;
  }
  .col {
    margin: 1% 0 1% 0%;
  }
  .span_1_of_3 {
    width: 94%;
    padding: 3%;
  }
}

/*  GO FULL WIDTH AT LESS THAN 640 PIXELS */

@media only screen and (max-width: 640px) and (min-width: 480px) {
  .wrap {
    width: 95%;
  }
  .span_2_of_3 {
    width: 94%;
    padding: 3%;
  }
  .col {
    margin: 1% 0 1% 0%;
  }
  .span_1_of_3 {
    width: 94%;
    padding: 3%;
  }

  .contact-form input[type="text"],
  .contact-form textarea {
    width: 97%;
  }
}
/*  GO FULL WIDTH AT LESS THAN 480 PIXELS */

@media only screen and (max-width: 480px) {
  .wrap {
    width: 95%;
  }
  .span_2_of_3 {
    width: 90%;
    padding: 5%;
  }
  .col {
    margin: 1% 0 1% 0%;
  }
  .span_1_of_3 {
    width: 90%;
    padding: 5%;
  }
  .contact-form input[type="text"],
  .contact-form textarea {
    width: 92%;
  }
}
/*--Media Queries--*/
@media only screen and (max-width: 1366px) and (min-width: 1280px) {
  .wrap {
    width: 90%;
  }
}
@media only screen and (max-width: 1280px) and (min-width: 1024px) {
  .wrap {
    width: 90%;
  }
}
@media only screen and (max-width: 1024px) and (min-width: 800px) {
  .wrap {
    width: 90%;
  }
  p.txt_4 {
    font-size: 1.5em;
  }
}
@media only screen and (max-width: 800px) and (min-width: 640px) {
  .wrap {
    width: 90%;
  }
  p.txt_4 {
    font-size: 1.5em;
  }
}
@media only screen and (max-width: 640px) and (min-width: 480px) {
  .wrap {
    width: 90%;
  }
  p.txt_4 {
    font-size: 1.5em;
  }
  #example-one a {
    padding: 0px;
  }
  .h-logo {
    width: 30%;
  }
  #reservation-form {
    width: 65%;
  }
  #reservation-form select.select1 {
    width: 150px;
  }
  #reservation-form select.select2 {
    width: 170px;
  }
  .link2 {
    margin-bottom: 0px;
  }
}
@media only screen and (max-width: 480px) and (min-width: 320px) {
  .wrap {
    width: 90%;
  }
  p.txt_4 {
    font-size: 1.5em;
  }
  #example-one a {
    padding: 0px;
  }
  .h-logo {
    width: 100%;
    float: none;
    text-align: center;
  }
  #reservation-form {
    width: 100%;
    float: none;
  }
  #reservation-form select.select1 {
    width: 150px;
  }
  #reservation-form select.select2 {
    width: 170px;
  }
  .link2 {
    margin-bottom: 0px;
  }
  .banner-no {
    float: none;
    display: none;
  }
  .nav-wrap {
    width: 100%;
    margin: 30px auto;
  }
}
@media only screen and (max-width: 320px) and (min-width: 240px) {
  .wrap {
    width: 90%;
  }
  p.txt_4 {
    font-size: 1.5em;
  }
  #example-one a {
    padding: 0px;
  }
  .h-logo {
    width: 100%;
    float: none;
    text-align: center;
  }
  #reservation-form {
    width: 100%;
    float: none;
  }
  #reservation-form select.select1 {
    width: 150px;
  }
  #reservation-form select.select2 {
    width: 170px;
  }
  .link2 {
    margin-bottom: 0px;
  }
  .banner-no {
    float: none;
    display: none;
  }
  .nav-wrap {
    width: 100%;
    margin: 30px auto;
  }
}


/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
  

    </style>-->