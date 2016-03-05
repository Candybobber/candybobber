<?php

/**
 * Class News - model for news
 * Contains static methods with logic for news
 */
class News {

  /**
   * Returns an array of news list by date
   * @return array
   */
  public static function getNewsList() {
    $db = DB::getConnection();
    $newsList = array();
    $sql = "SELECT news.*,
                   (SELECT count(id) FROM comment WHERE news_id = news.id) as comments,
                   (SELECT count(votes.id) FROM votes WHERE news_id = news.id) as vote_count,
                   (SELECT sum(votes.vote) FROM votes WHERE news_id = news.id) as vote_sum
            FROM news
            ORDER BY date DESC";

    $result = $db->prepare($sql);
    $result->execute();

    $i = 0;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $newsList[$i]['id'] = $row['id'];
      $newsList[$i]['title'] = $row['title'];
      $newsList[$i]['author'] = $row['author'];
      $newsList[$i]['short_content'] = $row['short_content'];
      $newsList[$i]['content'] = $row['content'];
      $newsList[$i]['date'] = date("m/d/y - H:i:s", strtotime($row['date']));
      $newsList[$i]['comments'] = $row['comments'];
      $newsList[$i]['vote_count'] = $row['vote_count'];
      if ($newsList[$i]['vote_count'] > 0) {
        $newsList[$i]['vote'] = round($row['vote_sum']/$row['vote_count'], 1);
      }
      $i++;
    }
    return $newsList;
  }

  /**
   * Returns the news with the specified id
   * @param $id
   * @return bool|mixed
   */
  public static function getNewsById($id) {
    $id = intval($id);
    if ($id) {
      $db = DB::getConnection();
      $sql = "SELECT * FROM news WHERE id = :id";
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->execute();
      $newsItem = $result->fetch(PDO::FETCH_ASSOC);
      $newsItem['date'] = date("m/d/y - H:i:s", strtotime($newsItem['date']));
      if (isset($newsItem['id'])) {
        return $newsItem;
      }
      else {
        return FALSE;
      }
    }
  }

  /**
   * Delete news with specified id
   * @param $id
   * @return bool
   */
  public static function deleteNewsById($id) {
    $db = DB::getConnection();
//    $sql = "DELETE news, comment FROM news
//            LEFT JOIN comment ON comment.news_id = news.id
//            WHERE news.id = :id";
    $sql = "START TRANSACTION;
            DELETE FROM news WHERE id = :id ;
            DELETE FROM comment WHERE news_id = :id;
            DELETE FROM votes WHERE news_id = :id;
            COMMIT;";

    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    return $result->execute();
  }

  /**
   * Create a new news
   * @param $options
   * @return int|string
   */
  public static function addNew($options) {
    $db = DB::getConnection();
    $sql = "INSERT INTO news (title, author, short_content, content)
            VALUES (:title, :author, :short_content, :content)";
    $result = $db->prepare($sql);
    $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
    $result->bindParam(':author', $options['author'], PDO::PARAM_STR);
    $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
    $result->bindParam(':content', $options['content'], PDO::PARAM_STR);

    if ($result->execute()) {
      return $db->lastInsertId();
    }
    return 0;
  }

  /**
   * Update news by id
   * @param $id
   * @param $options
   * @return bool
   */
  public static function editNew($id, $options) {
    $db = DB::getConnection();
    $sql = "UPDATE news
                   SET title = :title, short_content = :short_content,
                       content=:content, date = NOW()
            WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
    $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
    $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
    return $result->execute();
  }

  /**
   * Add comments to news
   * @param $news_id
   * @param $name
   * @param $text
   * @return bool
   */
  public static function addComment($news_id, $name, $text) {
    $db = DB::getConnection();
    $sql = "INSERT INTO comment (news_id, name, text)
            VALUES (:news_id, :name, :text)";
    $result = $db->prepare($sql);
    $result->bindParam(':news_id', $news_id, PDO::PARAM_INT);
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':text', $text, PDO::PARAM_STR);
    return $result->execute();
  }

  /**
   * Getting the comments list
   * @param $id
   * @return array
   */
  public static function getComment($id) {
    $db = DB::getConnection();
    $commentList = array();
    $sql = "SELECT * FROM comment WHERE news_id = :id ORDER BY date DESC";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();

    $i = 0;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $commentList[$i]['id'] = $row['id'];
      $commentList[$i]['name'] = $row['name'];
      $commentList[$i]['text'] = $row['text'];
      $commentList[$i]['date'] = date("m/d/y - H:i:s", strtotime($row['date']));
      $i++;
    }
    return $commentList;
  }

  /**
   * Getting the comment in the specified id
   * @param $id
   * @return mixed
   */
  public static function getCommentById($id) {
    $id = intval($id);
    $db = DB::getConnection();

    $sql = "SELECT * FROM comment WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $commentItem = $result->fetch(PDO::FETCH_ASSOC);
    return $commentItem;
  }


  /**
   * Cutting the length of comment
   * @param $text
   * @return string
   */
  public static function CutCommentText($text) {
    if (mb_strlen($text) > 150) {
      $text = mb_substr($text, 0, 147) . '...';
    }
    return $text;
  }

  /**
   * Delete comment with specified id
   * @param $id
   * @return bool
   */
  public static function deleteComment($id) {
    $db = DB::getConnection();
    $sql = "DELETE FROM comment WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    return $result->execute();
  }

  /**
   * Update comment with specified id
   * @param $id
   * @param $text
   * @return bool
   */
  public static function editComment($id, $text) {
    $db = DB::getConnection();
    $sql = "UPDATE comment SET text = :text, date = NOW() WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':text', $text, PDO::PARAM_INT);
    return $result->execute();
  }

  /**
   * Returns the path to the image
   * @param $id
   * @return string
   */
  public static function getImage($id) {
    // Image name
    $noImage = 'no-image.jpg';
    // Path to the folder with images
    $path = '/template/upload/images/news/';
    // Path to the images
    $pathToImage = $path . $id . '.jpg';
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToImage)) {
      // If there is no image
      return $pathToImage;
    }
    // Return path dummy image
    return $path . $noImage;
  }

  /**
   * Upload files(images) on server. Return image identifier
   * @param $id
   * @return mixed
   */
  public static function uploadFile($id) {
    if ($id) {
      // Verify whether through the form was loaded image
      if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
        // If upload, move it to the desired folder, give a new name
        move_uploaded_file($_FILES["image"]["tmp_name"],
          $_SERVER['DOCUMENT_ROOT'] . "/template/upload/images/news/{$id}.jpg");
      }
      return $id;
    }
  }

  /**
   * Adding a vote with news id and users id
   *
   * @param $options
   * @return bool
   */
  public static function addVote($options) {
    $db = DB::getConnection();
    $sql = "INSERT INTO votes (news_id, user_id, vote)
                   VALUES (:news_id, :user_id, :vote)";
    $result = $db->prepare($sql);
    $result->bindParam(':news_id', $options['news_id'], PDO::PARAM_INT);
    $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
    $result->bindParam(':vote', $options['vote'], PDO::PARAM_INT);
    return $result->execute();
  }

  /**
   * Getting the votes in the specified news id
   * @param $id
   * @return bool|mixed
   */
  public static function getVote($id) {
    $db = DB::getConnection();
    $sql = "SELECT id, COUNT(id) AS vote_count, SUM(vote) AS vote_sum FROM votes WHERE news_id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $vote = $result->fetch(PDO::FETCH_ASSOC);
    if ($vote['vote_count'] == 0)
      return FALSE;
    $vote['vote'] = round($vote['vote_sum']/$vote['vote_count'], 1);
    return $vote;
  }

  /**
   * Checking appropriate vote by specific news
   * @param $userId
   * @param $newsId
   * @return bool
   */
  public static function checkVote($userId, $newsId) {
    $db = DB::getConnection();
    $sql = "SELECT COUNT(*) FROM votes WHERE user_id = :userId AND news_id = :newsId";
    $result = $db->prepare($sql);
    $result->bindParam(':userId', $userId, PDO::PARAM_STR);
    $result->bindParam(':newsId', $newsId, PDO::PARAM_STR);
    $result->execute();
    if ($result->fetchColumn())
      return TRUE;
    return FALSE;
  }

  /**
   * Deleting votes by id
   * @param $id
   * @return bool
   */
  public static function deleteVote($id) {
    $db = DB::getConnection();
    $sql = "DELETE FROM votes WHERE news_id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    return $result->execute();
  }
}