<?php
use libs\Helper\Functions;
?>
<div class="control-group">
    <label class="control-label" for="app_namespace">Enter Name</label>
    <div class="controls">
        <input type="text" id="app_namespace" name="APP[name]" placeholder="Namespace_Mymodule">
    </div>
</div>
<div class="well">
    <h4>Module additional classes and stuff</h4>
    <div class="control-group">
        <label class="control-label" for="app_observer">Add Observer</label>
        <div class="controls">
            <input type="checkbox" id="app_observer" name="APP[observer]">
        </div>
    </div>
    <div class="control-group depends" depends="app_observer">
        <label class="control-label" for="event">Event Name</label>
        <div class="controls">
            <select id="event" name="APP[event]">
                <?php
                foreach (Functions::getEventList() as $id => $name): ?>
                    <option value="<?=$name?>"><?=$name?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="app_cron">Add Cron</label>
        <div class="controls">
            <input type="checkbox" id="app_cron" name="APP[cron]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="app_cli">Add Cli Command</label>
        <div class="controls">
            <input type="checkbox" id="app_cli" name="APP[cli]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="app_frontend_view">Generate Frontend View</label>
        <div class="controls">
            <input type="checkbox" checked="checked" id="app_frontend_view" name="APP[frontend_view]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="app_admin_view">Generate Admin View</label>
        <div class="controls">
            <input type="checkbox" checked="checked" id="app_admin_view" name="APP[admin_view]">
        </div>
    </div>
</div>