<?php


/**
 * Class NewsController
 * Display all news
 */
class NewsController extends Controller {

  /**
   * Action for 'Main page'
   */
  public function actionIndex() {
    // title and pageTitle for main template
    $title = SITE_NAME;
    $pageTitle = 'Main page';

    $newsList = News::getNewsList();
    // Including view with params
    $this->view->render('news/index', ['newsList' => $newsList,
                                       'title' => $title,
                                       'pageTitle' => $pageTitle,]);
  }

  /**
   * Action for page 'News' by id
   *
   * @param $id
   */
  public function actionView($id) {
    $result = FALSE;
    $errors = FALSE;
    $userId = User::checkLogged();
    $user = User::getUserById($userId);
    $newsItem = News::getNewsById($id);
    $newsId = $newsItem['id'];
    // title and pageTitle for main template
    $title = $newsItem['title'] . SEP . SITE_NAME;
    $pageTitle = 'News';

    $name = $user['login'];
    $commentList = News::getComment($newsId);
    $vote = News::getVote($newsId);
      // Checking for isset and pages numeric
      if ($newsItem && is_numeric($id)) {
        // Processing forms
        if (isset($_POST['comment'])) {
          $text = News::CutCommentText($_POST['text']);
          News::addComment($newsId, $name, $text);
          News::getCommentById($id);
          header("Location: " . $_SERVER['REQUEST_URI']);
        }

        if (isset($_POST['voting'])) {
          $options['vote'] = $_POST['vote'];
          $options['news_id'] = $newsId;
          $options['user_id'] = $user['id'];
          // Voting validation
          if (News::checkVote($userId, $newsId))
            $errors[] = "Rating: {$vote['vote']} - {$vote['vote_count']} voted";

          if ($errors == FALSE) {
            $result = News::addVote($options);
          }
        }
        // Including view with params
        $this->view->render('news/view', ['newsItem' => $newsItem,
                                          'commentList' => $commentList,
                                          'user' => $user,
                                          'title' => $title,
                                          'pageTitle' => $pageTitle,
                                          'vote' => $vote,
                                          'result' => $result,
                                          'errors' => $errors]);
      }
    else Errors::error404();
  }

  /**
   * Action for page 'Add news'
   */
  public function actionAdd() {
    // If user logged
    if (User::checkLogged()) {
      $userId = User::checkLogged();
      $user = User::getUserById($userId);
      $author = $user['login'];
      // title and pageTitle for main template
      $title =  'Add news ' . SEP . SITE_NAME;
      $pageTitle = 'Add news';

      // Processing forms
      if (isset($_POST['submit'])) {
        $options['title'] = $_POST['title'];
        $options['author'] = $author;
        $options['short_content'] = $_POST['short_content'];
        $options['content'] = $_POST['content'];
        $id = News::addNew($options);
        News::uploadFile($id);
      }
      // Including view with params
      $this->view->render('news/add', ['title' => $title,
                                       'pageTitle' => $pageTitle]);
    }
    else Errors::error403();
  }

  /**
   * Action for page 'Edit news'
   *
   * @param $id
   */
  public function actionEdit($id) {
    // If user logged
    if (User::checkLogged()) {
      $newsItem = News::getNewsById($id);
      // title and pageTitle for main template
      $title =  'Edit ' . $newsItem['title'] . SEP . SITE_NAME;
      $pageTitle = 'Edit news';

      // Processing forms
      if (isset($_POST['submit'])) {
        $options['title'] = $_POST['title'];
        $options['short_content'] = $_POST['short_content'];
        $options['content'] = $_POST['content'];
        News::editNew($id, $options);
        News::uploadFile($id);
        header("Location: /news/{$newsItem['id']}");
      }
      // Including view with params
      $this->view->render('news/edit', ['newsItem' => $newsItem,
                                        'title' => $title,
                                        'pageTitle' => $pageTitle]);
    }
    else Errors::error403();
  }
}
