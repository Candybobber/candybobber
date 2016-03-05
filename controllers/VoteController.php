<?php

/**
 * Class VoteController
 */
class VoteController extends Controller {

  /**
   * Action for page 'Delete vote'
   * @param $id
   */
  public function actionDelete($id) {
    // Checking user for admin rights
    if (User::checkAdmin()) {
      $newsItem = News::getNewsById($id);
      // title and pageTitle for main template
      $title = 'Delete vote' . SEP . SITE_NAME;
      $pageTitle = 'Delete vote';
      // Form processing
      if (isset($_POST['submit'])) {
        News::deleteVote($id);
        header("Location: /news/{$newsItem['id']}");
      }
      // Including view with params
      $this->view->render('vote/delete', ['newsItem' => $newsItem,
                                          'title' => $title,
                                          'pageTitle' => $pageTitle]);
    }
    else Errors::error403();
  }
}
