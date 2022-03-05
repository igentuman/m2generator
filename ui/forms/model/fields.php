<input type="text" id="model_{{model_id}}_field_to_add_name" name="MODELS[{{model_id}}][field_name-not-use]" placeholder="name">
<select id="model_{{model_id}}_field_to_add_type" name=MODELS[{{model_id}}][field_type-not-use]>
    <option value="integer">Integer</option>
    <option value="string">String</option>
    <option value="text">Textarea</option>
    <option value="wysiwyg">Wysywig</option>
    <option value="store_ids">Store IDs</option>
    <option value="date">Date</option>
    <option value="datetime">Datetime</option>
    <option value="customer_groups">Customer groups</option>
    <option value="yes_no">Yes / No</option>
</select>
<button type="button" onclick="addField('{{model_id}}');return false" class="btn btn-success"><span class="icon-plus"></span></button>
