<div class="well" style="max-width: 400px; margin: 0 auto 10px;">
    <button id="module_add_button" class="btn btn-block btn-primary" type="button"><span class="icon-plus"></span>Add Model</button>
</div>
<div id="models_container">

</div>
<div id="field_template"  style="display: none">
    <div id="field_{{field_id}}" class="added_field">
        <input type="hidden" name="MODELS[{{field_model_id}}][fields][{{field_id}}][name]" value="{{field_name}}"/>
        <input type="hidden" name="MODELS[{{field_model_id}}][fields][{{field_id}}][type]" value="{{field_type}}"/>
        <div id="model_field_{{field_id}}"><span>{{field_name}}</span><button type="button" onclick="removeField('{{field_id}}');return false;" title="Remove" class="btn btn-danger btn-small field_button"><span class="icon-remove" style="vertical-align: top;"></span></button></div>
    </div>
</div>
<div id="model_form_template" style="display: none">
    <div class="well">
        <h5>Model #{{model_id}}</h5>
        <div class="control-group">
            <label class="control-label" for="model_name_{{model_id}}<">Model Name</label>
            <div class="controls">
                <input type="text" id="model_name_{{model_id}}" name="MODELS[{{model_id}}][name]" placeholder="Mymodel">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="model_fields_{{model_id}}<">Add Field</label>
            <div class="controls">
               <?php include('model/fields.php');?>
            </div>
        </div>
        <div class="control-group">
            <h5>Fields</h5>
            <div class="controls" id="model_{{model_id}}_fields">
                <div id="field_{{field_id}}"  class="added_field">
                    <input type="hidden" name="MODELS[{{model_id}}][fields][{{field_id}}][name]" value="id"/>
                    <input type="hidden" name="MODELS[{{model_id}}][fields][{{field_id}}][type]" value="int(10)"/>
                    <div id="model_field_{{field_id}}"><span>id</span><button type="button" title="Remove" class="btn btn-danger btn-small field_button disabled"><span class="icon-remove" style="vertical-align: top;"></span></button></div>
                </div>
            </div>
            <br/>
            <br/>
            <div class="control-group">
                <h5>Custom Fields and Tabs</h5>
                <label class="control-label" for="model_rule_{{model_id}}">Add Rule Conditions Tab</label>
                <div class="controls">
                    <select id="model_rule_{{model_id}}" name="MODELS[{{model_id}}][rule_conditions]">
                        <option value="">No</option>
                        <option value="catalog_rule">Catalog Rule Conditions</option>
                        <option value="cart_rule">Shopping Cart Conditions</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="model_products_grid_{{model_id}}">Add Products Grid Tab</label>
                <div class="controls">
                    <input type="checkbox" id="model_products_grid_{{model_id}}" name="MODELS[{{model_id}}][products_grid]">
                </div>
            </div>
        </div>
        <a onclick="$('#model_{{model_id}}_additional').slideToggle('fast')" style="cursor: pointer;">Additional options</a>
        <div class="model_additional" id="model_{{model_id}}_additional">
            <div class="control-group">
                <label class="control-label" for="model_grid_{{model_id}}">Generate grid</label>
                <div class="controls">
                    <input type="checkbox" checked="checked" id="model_grid_{{model_id}}" name="MODELS[{{model_id}}][grid]">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="model_edit_{{model_id}}">Generate edit page</label>
                <div class="controls">
                    <input type="checkbox" checked="checked" id="model_edit_{{model_id}}" name="MODELS[{{model_id}}][edit]">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="model_frontend_{{model_id}}">Generate frontend pages</label>
                <div class="controls">
                    <input type="checkbox" checked="checked" id="model_frontend_{{model_id}}" name="MODELS[{{model_id}}][frontend]">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
model_id = 1;
field_name = '';
field_type = '';
field_id=1;
model_name = '';
field_model_id = 1;
    function insertParam (param, tpl) {
        while (tpl.indexOf('{{' + param + '}}') > 0) {
            try {
                tpl = tpl.replace('{{' + param + '}}', eval(param));
            } catch (e) {  }
        }
        return tpl;
    }

    function insertVars(tpl,skipVariables) {
        variables = tpl.match(/\{{[a-zA-Z0-9._\[\]]*\}}/g);

        for (k = 0; k < variables.length; k++) {
            somevar = variables[k].replace('{{', '').replace('}}', '');
            if (typeof(skipVariables) != 'undefined') {
                if (skipVariables.indexOf(somevar) > -1) {
                    continue;
                }
            }
            try {
                if (typeof(eval(somevar)) != 'undefined' && eval(somevar) != 'null')
                    tpl = insertParam(somevar,tpl);
            } catch (e) {
                console.log('Variable: ' + somevar + ' was not found');
            }
        }
        return tpl;
    }
    $('#module_add_button').on('click',function(){
        var newTpl = insertVars($('#model_form_template').html());
        $('#models_container').append(newTpl);
        model_id++;
    });

function addField(id) {
    field_id++;
    field_model_id = id;
    model_name = $('#model_name_'+id).val();
    field_name = $('#model_'+id+'_field_to_add_name').val();
    field_type = $('#model_'+id+'_field_to_add_type').val();
    fields_container = $('#model_'+id+'_fields');
    var newItem = insertVars($('#field_template').html());
    fields_container.append(newItem);
    $('#model_'+id+'_field_to_add_name').val(field_name);
    $('#model_'+id+'_field_to_add_type').val(field_type);
    $('#model_name_'+id).val(model_name);
}

    function removeField(id)
    {
        $('#field_'+id).remove();
    }
</script>