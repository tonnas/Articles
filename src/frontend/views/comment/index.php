
<div class="site-index">
    <div class="body-content">
         <div class="comment-index">

            <?= $this->render('view_comments',[
                'model' => $model,
                'article' => $article,
            ]); ?>

        </div>
    </div>
</div>
