@prepend('styles')
@endprepend
<div class="tab-pane " id="tab-attribute">
    <div class="pl-lg-4 row">
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="counter_attribute_tbl">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="sort" data-sort="price">Name</th>
                    <th scope="col" class="sort" data-sort="quantity">Text</th>
                </tr>
                </thead>
                <tbody class="list">
                <tr class="tr_attribute_clone">
                    <td>
                        <select class="form-control select2" name="attributesArray[0][attribute_id]">
                            @foreach($data['attributeArray'] as $key => $value)
                                <optgroup label="{{ $value->AdminProductAttributeGroupDescription->name }}">
                                @foreach($value->adminrelationAttributes as $key1 => $value1)
                                    <option value={{ $value1->id }}>{{ $value1->name }}</option>
                                @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control" name="attributesArray[0][text]" id="attribute_text_0"  rows="4"></textarea>
                    </td>
                    <td>
                        <button class="btn  btn-danger" type="button" id="DeleteAttributeButton" ><icon class="fa fa-minus" /></button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align:right" colspan="5">
                        <button type="button" class="btn btn-primary addRowButton"  ><icon class="fa fa-plus" /></button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
