<?php
    $allMessages = $data['messages'];
?>

<form enctype="multipart/form-data" action="blog" method="post">
    <label for="text"><b>Message</b></label>
    <label>
        <input type="text" placeholder="Enter Text" name="text" required>
    </label>
    <label>
        <input name="userfile" type="file"/><br>
    </label>
    <button type="submit" class="registerbtn">Send</button>
</form>

    <ul>
        <? foreach ($allMessages as $message => $inf): ?>
            <li>
                <pre><?= strip_tags($inf["text"]) ?></pre>
                <pre><?= $inf["created_at"] ?></pre>
                <pre><?= $inf["name"] ?></pre>
                    <img src="/images/<?=$inf["id"]?>.jpg" alt="pic">

            </li>
        <? endforeach; ?>
    </ul>

<?php
