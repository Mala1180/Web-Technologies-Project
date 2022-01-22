<div class="confirm-modal hidden">
    <h2>Sei sicuro?</h2>
    <div>
        <button id="yes">Sì</button>
        <button id="no">No</button>
    </div>
</div>
<script>
    // This close the modal when user click outside the modal
    $(document).ready(function() {
        $(document).click(function(e) {
            if ($(e.target).closest(".confirm-modal").length === 0) {
                $(".confirm-modal").addClass("hidden");
            }
        });
    });
</script>