Canary Singles Contact Message from:
----------------------------------------

<?php echo h($message['name']); ?> 
<?php echo h($message['email']); ?> 

-------------------
<?php echo h($message['subject']); ?> 
-------------------

<?php echo $this->Hpurifier->purify($message['body']); ?> 
