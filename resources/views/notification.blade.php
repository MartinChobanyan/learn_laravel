<div role="notification" class="container col bg-success text-white mb-3 pt-2" style="position:fixed;top:10;z-index:9999 !important;opacity:0.84">
    <h5 class="row justify-content-center display-5">{{ $notify_message }}</h5>
</div>
<script>
    $(document).ready(function() {
        $('div[role="notification"]').delay({{ $notify_duration ? $notify_duration : 5000 }}).animate({'top' : "-=60px"}, 'slow');
    });
</script>