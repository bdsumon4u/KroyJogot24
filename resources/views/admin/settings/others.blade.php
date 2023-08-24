<div class="tab-pane" id="item-others" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Others</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Products Page</label>
                <div class="row borderr py-2">
                    <div class="col-md-6 pr-0">
                        <label for="products_page-rows">Rows</label>
                        <x-input name="products_page[rows]" id="products_page-rows" :value="$products_page->rows ?? 3" />
                        <x-error field="products_page.rows" />
                    </div>
                    <div class="col-md-6 pl-0">
                        <label for="products_page-cols">Cols (4 or 5)</label>
                        <x-input name="products_page[cols]" id="products_page-cols" :value="$products_page->cols ?? 5" />
                        <x-error field="products_page.cols" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Related Products</label>
                <div class="row borderr py-2">
                    <div class="col-md-6 pr-0">
                        <label for="related_products-rows">Rows</label>
                        <x-input name="related_products[rows]" id="related_products-rows" :value="$related_products->rows ?? 1" />
                        <x-error field="related_products.rows" />
                    </div>
                    <div class="col-md-6 pl-0">
                        <label for="related_products-cols">Cols (4 or 5)</label>
                        <x-input name="related_products[cols]" id="related_products-cols" :value="$related_products->cols ?? 5" />
                        <x-error field="related_products.cols" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Call For Order</label>
                <x-input name="call_for_order" id="call_for_order" :value="$call_for_order ?? null" />
                <x-error field="call_for_order" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Pixel IDs</label>
                <x-input name="pixel_ids" id="pixel_ids" :value="$pixel_ids ?? null" />
                <x-error field="pixel_ids" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Scroll Text</label>
                <x-textarea name="scroll_text" id="scroll-text">{!! $scroll_text ?? '' !!}</x-textarea>
                <x-error field="scroll_text" />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>
