<nav class="w3-sidenav w3-text-white" style="background-color:#BF5142;">
  <div class="w3-large">Meniu</div>
  <a href="main.php">Visi įrašai</a> <a href="new_article.php" style="text-indent:20px;">Naujas įrašas</a>
  <hr noshade>
  <a href="brewers.php">Visi aludariai</a> <a href="new_brewer.php" style="text-indent:20px;">Naujas aludaris</a>
  <hr noshade>
  <a href="beers.php">Visi produktai</a> <a href="new_beer.php" style="text-indent:20px;">Naujas produktas</a>
  <hr noshade>
  <a href="users.php">Visi vartotojai</a> <a href="new_user.php" style="text-indent:20px;">Naujas vartotojas</a><br>
  <hr noshade>
  <a href="edit_user.php?id=<?php echo $_SESSION['user_id']; ?>">Mano paskyra</a> </nav>
