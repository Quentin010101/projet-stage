<?php
if (isset($messages) && !empty($messages)) :
    foreach ($messages as $m) :
        if ($m['code'] == 'flash') :
?>
            <div id="message-flash" class="<?php echo htmlspecialchars($m['type']); ?>" >
                <p><?php echo $m['message']; ?></p>
            </div>
<?php
        endif;
    endforeach;
endif;
?>