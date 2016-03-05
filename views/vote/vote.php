<?php if (isset($result) && $result): ?>
  <span class="success"><i class="fa fa-check-square-o"></i>Thank you for your vote</span>
<?php else: ?>
  <?php if (isset($errors) && is_array($errors)): ?>
    <?php foreach ($errors as $error): ?>
      <span><i class="fa fa-star"></i><?php echo $error; ?></span>
    <?php endforeach; ?>
    <?php if (User::checkAdmin()): ?>
      <a href="/vote/delete/<?php echo $newsItem['id']; ?>" type="button" class="btn btn-s"><i class="fa fa-trash"></i> Delete </a>
    <?php endif; ?>
  <?php else: ?>
    <b>Rate this article please</b>
    <form class="" action="#vote" method="post" id="vote">
        <?php $i = 1; ?>
        <?php while ($i <= 5): ?>
          <label class="radio-inline">
            <input type="radio" name="vote" value="<?php echo $i; ?>" required ><?php echo $i; ?>
          </label>
          <?php ++$i; endwhile; ?>
        <input type="submit" name="voting" value="Vote!"><p>
    </form>
  <?php endif; ?>
<?php endif; ?>
