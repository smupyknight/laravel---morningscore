<script src="{{ asset('external/viral-loops/main.js') }}"></script>
<script type="text/javascript">
    var campaign = VL.load("{{ config("services.viral_loops.current.campaign_id") }}", {
        autoLoadWidgets: !0
    });
</script>