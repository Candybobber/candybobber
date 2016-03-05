<?php

/**
 * Class CommentController
 * For comments on site
 */
class CommentController extends Controller {

  /**
   * Action for page 'Edit comment'
   * @param $id
   */
  public function actionEdit($id) {
    // Checking user for admin rights
    if (User::checkAdmin()) {
      $commentItem = News::getCommentById($id);
      // title and pageTitle for main template
      $title = 'Edit comment ' . $commentItem['id'] . SEP . SITE_NAME;
      $pageTitle = 'Edit comment';
      // Processing forms
      if (isset($_POST['submit'])) {
        $text = News::CutCommentText($_POST['text']);
        News::editComment($id, $text);
        header("Location: /news/{$commentItem['news_id']}");
      }
      // Including view with params
      $this->view->render('comment/edit', ['commentItem' => $commentItem,
                                           'title' => $title,
                                           'pageTitle' => $pageTitle]);
    }
    else Errors::error403();

  }

  /**
   * Action for page 'Delete comment'
   * @param $id
   */
  public function actionDelete($id) {
    // Checking user for admin rights
    if (User::checkAdmin()) {
      $commentItem = News::getCommentById($id);
      // title and pageTitle for main template
      $title = 'Delete comment ' . $commentItem['id'] . SEP . SITE_NAME;
      $pageTitle = 'Delete comment';
      // Processing forms
      if (isset($_POST['submit'])) {
        News::deleteComment($id);
        header("Location: /news/{$commentItem['news_id']}");
      }
      // Including view with params
      $this->view->render('comment/delete', ['commentItem' => $commentItem,
                                             'title' => $title,
                                             'pageTitle' => $pageTitle]);
    }
    else Errors::error403();
  }
}

