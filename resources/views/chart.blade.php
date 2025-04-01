
<!DOCTYPE html>
<html lang="en">
<div id="container">

{!! $chart->printScripts() !!}
<script>
    {!! $chart->render("chart") !!}
</script>
</div>
