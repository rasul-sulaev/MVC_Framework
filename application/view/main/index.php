<h1><?=$title?></h1>

<div class="news-list">
<? foreach ($news as $new): ?>
    <div class="new">
        <h3 class="new-title"><?=$new['title']?></h3>
        <p class="new-text"><?=$new['text']?></p>
    </div>
<? endforeach; ?>
</div>
