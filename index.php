<htmL>
  <head>
    <title>UBC Course Seat Space Checker</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/grid.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css"/>
  </head>
  <body>
    <div class="grid-25">
      &nbsp
    </div>
    <div class="grid-50 container background">
      <br>
      <p class="title">UBC Course Seat Space Checker</p>
      Type in your course/lab/tutorial information, and we'll let you know if a seat becomes available!<br><br>
        <form method="get" action="new-entry.php">
          <div class="grid-20 tablet-grid-50 left">
            Course
            <input type="text" name="name" placeholder="ex/CPSC" maxlength="4" pattern=".{3,4}"   required title="3 characters minimum">
          </div>
          <div class="grid-20 tablet-grid-50 left">
            Course #
            <input type="text" name="number" placeholder="ex/310" maxlength="4" pattern=".{3,4}"   required title="3 characters minimum">
          </div>
          <div class="grid-20 tablet-grid-50 left">
            Section
            <input type="text" name="section" placeholder="ex/002" maxlength="3" pattern=".{3}"   required title="3 characters">
          </div>
          <div class="grid-40 tablet-grid-50 left">
            Email
            <input type="text" name="email" placeholder="email" pattern=".{4,}"   required title="4 characters minimum">
          </div>
          <br>
          <div class="grid-100">
            <input type="submit" value="Submit">
          </div>
          <br>
          <div class="grid-60">
            &nbsp
          </div>
          <div class="grid-40 count">
            <strong>
            <?php
              $totusers = explode("\n", fread(fopen("total","r"), 34217728));
              echo "Users Emailed: $totusers[0]";
            ?>
            </strong>
          </div>
          <br>
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
