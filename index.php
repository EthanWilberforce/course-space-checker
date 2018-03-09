<htmL>
  <head>
    <title>Seat 4 Me</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/grid.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css"/>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div class="grid-25">
      &nbsp
    </div>
    <div class="grid-50 container background">
      <p class="title">UBC Seat For Me</p>
      Type in your course/lab/tutorial information, and we'll let you know if a seat becomes available!<br><br>
        <form method="post" action="new-entry.php">
          <div class="grid-20 tablet-grid-20 mobile-grid-33 left">
            Course<br>
            <input class="inputc" type="text" name="name" placeholder="CPSC" maxlength="4" pattern=".{2,4}"   required title="2 characters minimum">
          </div>
          <div class="grid-20 tablet-grid-20 mobile-grid-33 left">
            Course #<br>
            <input class="inputc" type="text" name="number" placeholder="221" maxlength="4" pattern=".{3,4}"   required title="3 characters minimum">
          </div>
          <div class="grid-20 tablet-grid-20 mobile-grid-33 left">
            Section<br>
            <input class="inputc" type="text" name="section" placeholder="9W1" maxlength="3" pattern=".{3}"   required title="3 characters">
          </div>
          <div class="grid-40 tablet-grid-40 left">
            Email <!-- <small>or</small> Phone--><br>
            <input class="inpute" type="text" name="emailnum" placeholder="x@xx.xxx" pattern=".{4,}"   required title="4 characters minimum">
          </div>
          <br>
          <div class="grid-100">
            <input class="submit" type="submit" value="Submit">
          </div>
          <br>
          <div class="grid-50 tablet-grid-50 mobile-grid-50 left">
            Term<br>
            <select name="term">
              <option value="S2018" selected="selected">Summer 2018</option>
              <option value="W2018">Winter 2018</option>
            </select>
          </div>
          <div class="grid-50 tablet-grid-50 mobile-grid-50">
            <div class="right">Users</div>
            <div class="count">
              <?php
                $totusers = explode("\n", fread(fopen("total","r"), 34217728));
                echo "$totusers[0]";
              ?>
            </div>
          </div>
          <div class="grid-100">
            &nbsp
          </div>
        </form>
    </div>
  </body>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59009734-4', 'auto');
  ga('send', 'pageview');

</script>
</html>
