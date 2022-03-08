<?php $pageScript[] = 'input-file.js' ?>


<div class="container-file">
    <label for="file" id="file-label"><?php echo $label; ?></label>
    <div>
        <input type="file" name="file" id="file">
        <span id='input-file-name'></span>
        <span id='input-file-size'></span>
    </div>
</div>