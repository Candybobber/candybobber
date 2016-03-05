<div class="container">
  <div class="row">
    <!-- Content start -->
    <div class="col-sm-12">
      <div class="news">
        <div class="items">

          <?php if (!empty($newsList) && is_array($newsList)): ?>
            <?php foreach ($newsList as $newsItem): ?>
              <div class="news row">
                <div class="col-sm-4">
                  <a href="/news/<?php echo $newsItem['id']; ?>">
                    <img src="<?php echo News::getImage($newsItem['id'])?>" alt="<?php echo $newsItem['title']; ?>" class="img-thumbnail">
                  </a>
                </div>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-sm-12">
                      <h3><a href="/news/<?php echo $newsItem['id']; ?>"><?php echo $newsItem['title']; ?></a></h3>
                      <div class="meta">

                        <?php if (User::checkAdmin()): ?>
                          <span><a href="#"><i class="fa fa-user""></i><?php echo $newsItem['author']; ?></a></span>
                        <?php else: ?>
                          <span><i class="fa fa-user""></i><?php echo $newsItem['author']; ?></span>
                        <?php endif; ?>

                        <span><i class="fa fa-calendar"></i><?php echo $newsItem['date']; ?></span>

                        <?php if (!empty($newsItem['vote'])): ?>
                          <span><i class="fa fa-star"></i>Rating: <?php echo $newsItem['vote']; ?> - <?php echo $newsItem['vote_count']; ?> voted</span>
                        <?php endif; ?>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class=""><?php echo $newsItem['short_content']?></p>
                      <a href="/news/<?php echo $newsItem['id']; ?>">Read more<i class="fa fa-angle-right"></i></a>

                      <?php if (!empty($newsItem['comments'])): ?>
                        <a href="/news/<?php echo $newsItem['id']; ?>#comments" class="comment-count">
                          comments <span class="badge"><?php echo $newsItem['comments']; ?></span>
                        </a>
                      <?php endif; ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="alert alert-default text-center" role="alert">
              <h3><i class="fa fa-exclamation"></i> No data for display</h3>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
    <!-- Content end -->
  </div>
</div>
