<div id="form_container">
    <form action="/form_input" method="post" enctype="multipart/form-data" class="flex j-content-between d-column">
        <label for="img">upload image</label>
        <input type="file" name="img" id="img">
        <div class="image_info">
            <?php /** @var string|bool $error */
            echo $error?'<span class="error_message">'.$error.'</span>':''
            ?>
        </div>
        <input type="submit" value="upload">
    </form>
</div>
<script src="/public/js/form_image.js"></script>

