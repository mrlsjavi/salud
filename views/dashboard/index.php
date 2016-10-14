<div class="col-lg-offset-1 col-lg-10">

<p>Dashboard... Logged in only..</p>
<form id="randomInsert" action="<?php echo URL;?>dashboard/xhrInsert/" method="post">
    <div class="row">
        <div class="col-lg-10">
            <input type="text" name="text" class="form-control"/>
        </div>
        <input type="submit" class="btn btn-primary col-lg-2"/>
    </div>
</form>

<div id="listInserts">

</div>
</div>
