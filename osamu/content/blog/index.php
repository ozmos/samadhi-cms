<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

// ****************************************************************************
// *                          DISPLAY SINGLE ARTICLE                          *
// ****************************************************************************

if (isset($_GET['article'])) {
  $id = $_GET['article'];

  try {
    $sql = 'SELECT `title`, `description`, `date`, `image`.`name` AS "img", `image`.`alt_text` AS "alt", `text`, `author`.`name` AS "author"
          FROM `article` INNER JOIN `author`
          ON `author_id` = `author`.`id`
          LEFT OUTER JOIN `image`
          ON `featured_image` = `image`.`id`
          WHERE `article`.`id` = :id';
      $s = query($pdo, $sql, array(':id' => $id));
  } catch (PDOException $e) {
    errorMsg('Problem fetching article', $e);
  }

  $row = $s->fetch();

  $page = array(
    'id' => $id,
      'title' => $row['title'],
      'img' => $row['img'],
      'alt' => $row['alt'],
      'description' => $row['description'],
      'author' => $row['author'],
      'date' => $row['date'],
      'content' => $row['text']
  );
  
  include $_SERVER['DOCUMENT_ROOT'] . '/templates/article.html.php';
}

// ****************************************************************************
// *                          DISPLAY LATEST ARTICLES                         *
// ****************************************************************************
else {

try
{
  $sql = 'SELECT `article`.`id` AS "id", `title`, `description`, `date`, `text`, `name`
      FROM `article` INNER JOIN `author`
        ON `author_id` = `author`.`id`';
  $result = $pdo->query($sql);
  $page = array(
  'id' => 'articles',
  'title' => 'Latest Articles',
  'description' => 'Latest Articles for Samadhi Journal',
  );
  foreach ($result as $row)
{
  // echo var_dump($row) . '<br>';
  $articles[] = array(
    'id' => $row['id'],
    'title' => $row['title'],
    'description' => $row['description'],
    'author' => $row['name'],
    'date' => $row['date'],
    'content' => $row['text'],
  );
}



include $_SERVER['DOCUMENT_ROOT'] . '/templates/feed.html.php';
// header('Location: .');
exit();
}
catch (PDOException $e)
{
  errorMsg('Error fetching articles', $e);
}
}

 ?>