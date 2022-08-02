<!-- alert -->
<div class="container">
  <?php
    if(isset($_GET["fail"])){
      ?>
      <div class="alert alert-danger" id="alert-success">
        <h3 class='errorMessage my-3 text-center'><?php echo $_GET["fail"] ?></h3>
      </div>
    <?php }
    if(isset($_GET["success"])){
      ?>
      <div class="alert alert-success" id = "alert-success">
        <h3 class='successMessage my-3 text-center'><?php echo $_GET["success"] ?></h3>
      </div>
    <?php }
  ?>
</div>