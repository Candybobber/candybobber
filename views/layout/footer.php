<a href="#" class="scrollUpButton"><span class="glyphicon glyphicon-chevron-up"></span></a>
</div>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        My Site © 2016
      </div>
      <div class="col-sm-4 text-right">
        <a href="mailto:"><i class="fa fa-envelope fa-lg"></i></a>
        <a href=""><i class="fa fa-vk fa-lg"></i></a>
        <a href=""><i class="fa fa-facebook fa-lg"></i></a>
        <a href=""><i class="fa fa-twitter fa-lg"></i></a>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/scrollUpButton.js"></script>

<script>
  $(document).ready(function(){
    $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
        $('.scrollUpButton').fadeIn();
      } else {
        $('.scrollUpButton').fadeOut();
      }
    });
    $('.scrollUpButton').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 500);
      return false;
    });
  });
</script>

</body>
</html>