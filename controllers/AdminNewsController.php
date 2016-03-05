<?php

/**
 * Class AdminNewsController
 * Administration news
 */
class AdminNewsController extends Controller{

  /**
   * Action for page 'Administration panel'
   */
  public function actionIndex() {
    // Checking user for admin rights
    if(User::checkAdmin()) {
      // title and pageTitle for main template
      $title = 'Administration panel' . SEP . SITE_NAME;
      $pageTitle = 'Administration panel';
      // Including view with params
      $this->view->render('admin/index', ['title' => $title,
                                          'pageTitle' => $pageTitle]);
    }
    else Errors::error403();
  }

  /**
   * Action for page 'Administration news'
   */
  public function actionNews() {
    // Checking user for admin rights
    if(User::checkAdmin()) {
      // title and pageTitle for main template
      $title = 'Administration news' . SEP . SITE_NAME;
      $pageTitle = 'Administration news';
      $newsList = News::getNewsList();
      // counter for cycle
      $i = 0;
      // Including view with params
      $this->view->render('admin/news', ['newsList' => $newsList,
                                         'i' => $i,
                                         'title' => $title,
                                         'pageTitle' => $pageTitle,]);
    }
    else Errors::error403();
  }

  /**
   * Action for page 'Delete news'
   * @param $id
   */
  public function actionDelete($id) {
    // Checking user for admin rights
    if(User::checkAdmin()) {
      $newsItem = News::getNewsById($id);
      // title and pageTitle for main template
      $title = 'Delete ' .$newsItem['title'] . SEP . SITE_NAME;
      $pageTitle = 'Delete news';
      // Processing forms
      if (isset($_POST['submit'])) {
        News::deleteNewsById($id);
        header("Location: /admin/news");
      }
      // Including view with params
      $this->view->render('admin/news_delete', ['newsItem' => $newsItem,
                                                'title' => $title,
                                                'pageTitle' => $pageTitle,]);
    }
    else Errors::error403();
  }
}