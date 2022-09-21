</div>
<?php
?>

<!-- Modal -->
<div id="pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header <?php echo  $data["pop_data"]["class"] ;?>">
                <h4 class="modal-title" id="footer-modal-title"><?php echo $data["pop_data"]["title"];?></h4>
            </div>
            <div class="modal-body">
                <p id="footer-modal-message"><?php echo $data["pop_data"]["message"];?></p>
                <p id="footer-modal-contact"><?php echo $data["pop_data"]["contact"];?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery.validate.min.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>
