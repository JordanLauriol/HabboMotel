<div class="notification-content">
    <?= $this->Html->image('icons/close.gif', ['class' => 'close']); ?>
    <?= $this->Html->image($notification->image, ['align' => 'right', 'style' => 'margin: 10px 5px 0px 5px;']); ?>

    <div class="message-content">
        <?= $notification->message; ?>

        <?php if(isset($message["parameters"]["room_id"])) {
                    echo $notification->follow;
              }
        ?>
        <?php /*
        if($message['packet']['action'] == "UserMentioned" || $message['packet']['action'] == "PromoteRoom") {
            echo sprintf($notification['notification']['message'], $message['user']['username'], $message['chat']['message']);
        } else {
            echo $notification['notification']['message'];
        }
        
        if(isset($message['room'])) {
            echo '<p style="margin-top: 5px;text-align:center;"><a class="followRoom">' . $notification['room']['message'] . '</a></p>';
        }*/
        ?>
    </div>
</div>
