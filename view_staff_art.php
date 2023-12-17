<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      
        body {
            background-color: #fafafa;
            font-family: Arial, sans-serif;
            background: url(backgrounds/matthieu-comoy-koo_vYrlU_U-unsplash.jpg);
            background-repeat: repeat;
            background-size: 1600px 1000px;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .article {
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .article img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .article-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .article-content {
            font-size: 14px;
            color: #777;
        }

        .head {
            text-align: center;
            color: white;
        }

        .like-icon {
            cursor: pointer;
        }

        .like-icon i {
            color: #ccc;
        }

        .like-icon.filled i {
            color: #ff0000;
        }
    </style>
</head>
<body>
<div class="head">
    <h1>Articles from Student</h1>
    <button onclick="window.location.href='admin_dash.php'">Back</button>
</div>
<div class="container">
    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'cms');
    $query = "SELECT * FROM article";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $articleId = $row['sno'];

        // Check if the article is liked by the user
        $isLiked = isset($_SESSION['liked_articles'][$articleId]) && $_SESSION['liked_articles'][$articleId] == true;

        if (isset($_POST['articleId']) && $_POST['articleId'] == $articleId) {
            if ($isLiked) {
                // Unlike the article
                $likeCount = $row['likes'] - 1;
                $isLiked = false;
                unset($_SESSION['liked_articles'][$articleId]);
            } else {
                // Like the article
                $likeCount = $row['likes'] + 1;
                $isLiked = true;
                $_SESSION['liked_articles'][$articleId] = true;
            }

            // Update the like count in the database
            $updateQuery = "UPDATE images SET likes = $likeCount WHERE sno = $articleId";
            mysqli_query($conn, $updateQuery);
        } else {
            $likeCount = $row['likes'];
        }
        ?>

        <div class="article">
            <img src="<?php echo $row['image_path']; ?>" alt="Article Image">
            <h3 class="card-title"><?php echo $row['id']; ?></h3>
            <p class="card-description"><?php echo $row['name']; ?></p>
            <p class="card-description"><?php echo $row['course']; ?></p>

            <form method="POST" action="">
                <input type="hidden" name="articleId" value="<?php echo $articleId; ?>">
                <div class="like-icon <?php echo ($isLiked) ? 'filled' : ''; ?>" onclick="this.parentNode.submit();">
                    <i class="fas fa-heart"></i>
                    <span class="like-count"><?php echo $likeCount; ?></span>
                </div>
            </form>
        </div>

        <?php
    }

    mysqli_close($conn);
    ?>
</div>

</body>
</html>








